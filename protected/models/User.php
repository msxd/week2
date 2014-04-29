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

	private $_identity;

	public $pass;
	public $r_pass;

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
			array('email, pass', 'required', 'on'=>array('login','registration')),
			//registration
			array('email', 'unique', 'except' => 'login'),
			array('r_pass, first_name, last_name', 'required', 'on' => 'registration'),
			//all
			array('facebook_id', 'length', 'max' => 50, 'min' => 2),
			array('email, hashed_password, phone, first_name, last_name', 'length', 'max' => 127),
			array('first_name, last_name', 'length', 'min' => 2),
			array('email', 'length', 'min' => 2),
			array('phone', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().

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
		return $pass == $this->hashed_password;
	}


	public function beforeSave()
	{
		//На случай редактирования пользователя предусмотреть, что пароль не обязателен при редактировании
		if (!parent::beforeSave()) return false;
		$this->hashed_password = $this->pass;
		return true;
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
	public function genAproveUrl($user)
	{
		if(!Yii::app()->user->isGuest)
			if($user->approved==0)
				return '<a href="'.(Yii::app()->controller->createAbsoluteUrl(
					'/mailur/aprove?url='.str_replace('=', '', base64_encode('aprove_email:1:' . $user->hashed_password .
						':' . $user->email . ':' . $user->last_name . ':' . $user->first_name)))).'">Confirm email</a>';
				//return ''.(Yii::app()->controller->createUrl('/mailur/aprove?url='.str_replace('=', '', base64_encode('aprove_email:1:' . $user->hashed_password . ':' . $user->email . ':' . $user->last_name . ':' . $user->first_name))));
		else
			return 'U r aprroved';
		else
			return 'Please sign up';
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


		if($me->save())
			return true;
		else
			return false;
	}
}
