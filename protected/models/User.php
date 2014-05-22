<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $facebook_id
 * @property string $email
 * @property string $pass
 * @property string $r_pass
 * @property string $hashed_password
 * @property string $phone
 * @property string $first_name
 * @property string $last_name
 * @property integer $role_id
 * @property integer $deleted
 * @property integer $approved
 * @property Post[] $posts
 */
class User extends CActiveRecord
{
	const ROLE_USER = 0;
	const ROLE_MODER = 1;
	const ROLE_ADMIN = 2;

	const DEL_FALSE = 0;
	const DEL_TRUE = 1;

	const APPROVE_FALSE = 0;
	const APPROVE_TRUE = 1;

	public $pass;
	public $r_pass;
	public $old_pass;
	private $_identity;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		//
		return array(
			array('email, pass', 'required', 'on' => array('login', 'registration')),
			array('email', 'required', 'on' => 'update'),
			//registration
			array('email', 'unique', 'except' => 'login'),
			array('r_pass, first_name, last_name', 'required', 'on' => 'registration'),
			//change pass
			array('r_pass, pass, old_pass', 'required', 'on' => 'change'),
			array('pass', 'compare', 'compareAttribute' => 'r_pass', 'on' => 'change'),
			array('old_pass', 'checkPassw', 'on' => 'change'),
			//all
			array('first_name, last_name', 'required', 'on'=>'editUserInfo'),
			array('facebook_id', 'length', 'max' => 50, 'min' => 2),
			array('email, hashed_password, phone, first_name, last_name', 'length', 'max' => 127),
			array('first_name, last_name', 'length', 'min' => 2),
			array('email', 'length', 'min' => 2),
			array('role_id', 'numerical', 'integerOnly' => true),
			array('deleted, approved', 'safe','on'=>'adminUpdate'),
			// The following rule is used by search().
			array('hashed_password', 'unsafe'),
			// @todo Please remove those attributes that should not be searched.
			array('id, facebook_id, email, phone, first_name, last_name', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'post' => array(self::HAS_MANY, 'Post', 'user_id') // имя => [self::has..., Model, связующая колонка в таблице модели]
		);
	}

	public function checkPassw($atr)
	{
		if ($this->cryptPass($this->old_pass) != $this->hashed_password)
			$this->addError($atr, 'Не верный текущий пароль');
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'facebook_id' => 'Facebook id',
			'email' => 'E-mail',
			'phone' => 'Phone',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'role_id' => 'Role',
			'deleted' => 'Deleted',
			'approved' => 'Approved',
			'pass' => 'Password',
			'r_pass' => 'Password again',
			'old_pass' => 'Old password'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function findByMail($email)
	{
		$cr = $this->getDbCriteria();
		$cr->addColumnCondition(array(
			$this->getTableAlias() . '.email' => $email,
		));
		return $this;
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('facebook_id', $this->facebook_id, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('role_id', $this->role_id);
		$criteria->compare('deleted', $this->deleted);
		$criteria->compare('approved', $this->approved);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function authenticate($attribute, $params)
	{
		$this->_identity = new UserIdentity($this->username, $this->hashed_password);
		if (!$this->_identity->authenticate())
			$this->addError('password', 'Неправильное имя пользователя или пароль.');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */

	public function login($isUrl = false)
	{
		$model = $this;
		$model->setScenario('login');

		if ($this->email) {
			if (!$isUrl) {
				if ($model = self::findByAttributes(array('email' => $this->email))) {
					if (!$model->validatePassword($this->pass)) {
						$this->addError('password', 'Wrong login or password');
						return false;
					}
				} else {
					$this->addError('password', 'Wrong login or password');
					return false;
				}
			} else {
				if ($model = self::findByAttributes(array('email' => $this->email))) {
					if (!$model->validateHashPassword($this->pass)) {
						$this->addError('password', 'Wrong login or password');
						return false;
					}
				} else {
					$this->addError('password', 'Wrong login or password');
					return false;
				}
			}
		}

		if (!$model->id) {
			$this->addError('email', 'User not found');
			return false;
		}

		if ($model->approved != 1 && Yii::app()->params['aproveUser']) {
			$this->addError('aprove', 'Please aprove your email adress');
			return false;
		}
		if ($model->deleted == 1) {
			$this->addError('banned', 'You are deleted, please contact with administrator, or moderator');
			return false;
		}
		$identity = new UserIdentity($model);
		$identity->authenticate();
		Yii::app()->user->login($identity, 3600 * 24 * 365 * 5); // 5 лет
		return true;
	}

	public function validateHashPassword($pass)
	{
		return $pass == $this->hashed_password;
	}

	public function validatePassword($pass)
	{
		return $this->cryptPass($pass) == $this->hashed_password;
	}


	public function beforeSave()
	{
		//На случай редактирования пользователя предусмотреть, что пароль не обязателен при редактировании
		if (!parent::beforeSave()) return false;
		if (($this->scenario != 'approve' || $this->scenario != 'recovery') && $this->pass) {
			$this->hashed_password = $this->cryptPass($this->pass);
		}
		return true;
	}

	public function cryptPass($str)
	{
		return md5($str);
	}

	public function getRole()
	{
		return $this->role_id;
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/** @var User $user */
	public function genAproveUrl()
	{
		if ($this->approved == 0) {
			return $this->sendMail('Copy and past it ' . Yii::app()->controller->createAbsoluteUrl(
					'/mailur/aprove?url=' . str_replace('=', '', base64_encode('aprove_email:1:' . $this->hashed_password . ':' . $this->email . ':' . $this->last_name . ':' . $this->first_name))), 'Pleace, <a href="' . (Yii::app()->controller->createAbsoluteUrl(
					'/mailur/aprove?url=' . str_replace('=', '', base64_encode('aprove_email:1:' . $this->hashed_password . ':' . $this->email . ':' . $this->last_name . ':' . $this->first_name)))) . '">Click here</a>');
		} else {
			return 'Something went wrong. Please contact with administrator <a href="mailto:' . Yii::app()->params['adminEmail'] . '';
		}
	}

	public function sendMail($alt, $text)
	{
		$message = "Message sent!";
		$mail = Yii::app()->mailer;
		$mail->AddAddress($this->email, $this->first_name);
		$mail->IsHTML(true); // set email format to HTML
		$mail->Subject = "From my site";
		$mail->Body = $text;
		$mail->AltBody = $alt;
		if (!$mail->Send()) {
			$message = "Message could not be sent. <p>";
			$message = "Mailer Error: " . $mail->ErrorInfo;
			return false;
		}
		return true;
	}

	public function aproveMe($url)
	{

		$data = explode(':', base64_decode($url));
		if (count($data) != 6) {
			return false;
		}
		if ($data[0] != 'aprove_email' && $data[1] != '1') {
			return false;
		}
		$me = $this->findByMail($data[3])->find();
		/** @var User $me */
		$me->approved = 1;
		$me->scenario = 'approve';
		return $me->save();
	}

	public function afterReg()
	{
		$this->genAproveUrl();
	}

	/**
	 * @param User $user
	 * @return string
	 */
	public function passRecovery()
	{
		$str = '<a href="' . Yii::app()->controller->createAbsoluteUrl(
				'/mailur/check?url=' . str_replace('=', '', base64_encode(base64_encode('recover') . ':' . base64_encode($this->hashed_password) . ':' . base64_encode(time()) . ':' . base64_encode($this->email) . ':' . base64_encode($this->last_name) . ':' . base64_encode($this->first_name)))) . '">url to recovery password</a>';
		$alt = 'Copy and past this url in u browser and create new password '. Yii::app()->controller->createAbsoluteUrl(
				'/mailur/check?url=' . str_replace('=', '', base64_encode(base64_encode('recover') . ':' . base64_encode($this->hashed_password) . ':' . base64_encode(time()) . ':' . base64_encode($this->email) . ':' . base64_encode($this->last_name) . ':' . base64_encode($this->first_name))));
		return self::sendMail($alt, $str);
	}

	/**
	 * @param bool $recover
	 * @param string $url
	 * @param string $oldPass
	 * @param string $newPass
	 * @param string $newPassRep
	 * @param User $user
	 */
	public function changePass($recover, $url = 0, $oldPass = 0, $newPass = 0, $newPassRep = 0, $user = 0)
	{

		if ($recover) {
			$datas = explode(':', base64_decode($url));
			$i = 0;
			foreach ($datas as $val) {
				$res[$i] = base64_decode($val);
				$i += 1;
			}
		}
		if (($res[2] - time()) < (24 * 60 * 60)) {
			/** @var User $me */
			$this->setScenario('recovery');
			$me = $this->findByMail($res[3])->find();
			$me->setScenario('recovery');
			if ($me->hashed_password == $res[1]) {
				$me->pass = Yii::app()->getSecurityManager()->generateRandomString(8);
				//$me->r_pass =  Yii::app()->getSecurityManager()->generateRandomString(8);
				$me->save();
				$me->sendMail('Your new password is: ' . $me->pass, 'Your new password is: ' . $me->pass);
			} else {
				echo 'smt went wrong';
			}
		} else {
			return 'Просрочено';
		}
		return 'lol';
	}


	public function allUsers($admin = false)
	{
		$c = $this->getDbCriteria();
		if ($admin) {
			$c->addCondition($this->getTableAlias() . '.id > -1');
		} else {
			$c->addCondition($this->getTableAlias() . '.role_id = 0');
		}

		return $this;
	}

	public function tokenGenerator($email, $pass)
	{
		$this->email = $email;
		$this->pass = $pass;
		$token = '';
		if ($this->login()) {
			$token = base64_encode($this->cryptPass($this->pass) . ':' . $this->email);
		}
		return $token;
	}

	public function getData()
	{
		$user = array(
			'email' => $this->email,
			"id" => $this->id,
			"facebook_id" => $this->facebook_id,
			"phone" => $this->phone,
			"first_name" => $this->first_name,
			"last_name" => $this->last_name,
		);
		return $user;
	}
}
