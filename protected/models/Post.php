<?php

/**
 * This is the model class for table "posts".
 *
 * The followings are the available columns in table 'posts':
 * @property integer $id
 * @property string $body
 * @property string $title
 * @property string $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $published
 * @property string $img_path
 * @property User $user1
 */
class Post extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	const PUBLISHED_FALSE = 0;
	const PUBLISHED_TRUE = 1;

	public $id;
	public $body;
	public $title;
	public $created_at;
	public $updated_at;
	public $user_id;
	private $published;
	public $img_path;


	public function tableName()
	{
		return 'posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('body, title, user_id', 'required'),
			array('title, img_path', 'length', 'max' => 127),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, body, title, created_at, updated_at, user_id', 'safe', 'on' => 'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),//имя => [тип связи, Модель, связывающая колонка ]
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'body' => 'Body',
			'title' => 'Title',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'user_id' => 'User',
			'published' => 'Published',
			'img_path' => 'Img Path',
		);
	}

	public function defaultScope()
	{
		return array(
			'order' => 't.id DESC'
		);
	}

	public function published()
	{
		$c = $this->getDbCriteria();
		$c->addColumnCondition(array(
			$this->getTableAlias() . '.published' => '1',
		));

		return $this;
	}

	public function hotNews()
	{
		$c = $this->getDbCriteria();
		//SELECT * FROM `posts` WHERE created_at BETWEEN Now()-interval 5 hour AND Now()
		//$c->addCondition($this->getTableAlias() . '.created_-at', new CDbExpression('Now()-interval 5 hour'),new CDbExpression('Now()'));
		$c->addCondition($this->getTableAlias().'.created_at BETWEEN Now()-interval 3 hour AND Now()');
		return $this;
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('published', $this->published);
		$criteria->compare('img_path', $this->img_path, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
