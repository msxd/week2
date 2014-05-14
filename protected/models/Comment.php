<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $id
 * @property string $body
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property integer $parent_id
 * @property integer $post_id
 *
 * The followings are the available model relations:
 * @property Comment $parent
 * @property Comment[] $comments
 * @property Post $post
 */
class Comment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('body, email, post_id', 'required'),//parent_id
			array('created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('parent_id, post_id', 'numerical', 'integerOnly' => true),
			array('email', 'length', 'max' => 255),
			array('updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, body, email, created_at, updated_at, parent_id, post_id', 'safe', 'on' => 'search'),
		);
	}

	public function behaviors()
	{
		return array(
			'hierarchy' => array(
				'class' => 'application.behaviors.HierarchyBehavior',
				//'property1'=>'value1',
				//'property2'=>'value2',
			),
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
			'parent' => array(self::BELONGS_TO, 'Comment', 'parent_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'parent_id'),
			'post' => array(self::BELONGS_TO, 'Posts', 'post_id'),
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
			'email' => 'Email',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'parent_id' => 'Parent',
			'post_id' => 'Post',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);
		$criteria->compare('parent_id', $this->parent_id);
		$criteria->compare('post_id', $this->post_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function actionAddComment()
	{
		$model = new Comment('add');

		if (isset($_POST['Comment'])) {
			$model->attributes = $_POST['Comment'];
			if ($model->validate()) {
				// form inputs are valid, do something here
				$model->save();
				return true;
			}
		}
		return false;
	}
}
