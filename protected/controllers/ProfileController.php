<?php

class ProfileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('index', 'edit', 'change'), //edit - profile, change - password
				'users' => array('@'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit()
	{
		$model = $this->loadModel();


		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			if ($model->save())
				$this->redirect(array('edit', 'id' => $model->id));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}


	public function actionChange()
	{
		$model = $this->loadModel();
		$model->setScenario('change');

		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			if ($model->save())
				$this->redirect(array('change', 'id' => $model->id));
		}

		$this->render('change', array(
			'model' => $model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('User', array('criteria' => array('condition' => 'id = ' . Yii::app()->user->id)));
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel()
	{
		$model = User::model()->findByPk(Yii::app()->user->id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
}
