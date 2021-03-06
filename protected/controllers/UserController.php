<?php

class UserController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
			array('allow', // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view', 'create', 'admin', 'delete', 'udelete', 'update', 'approve', 'dapprove'),
				'roles' => array(User::ROLE_ADMIN),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	//get
	public function loadModel($id)
	{
		$model = User::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Lists all models.
	 */
	//get
	public function actionIndex()
	{
		$this->forward('user/admin');
	}

	/**
	 * Manages all models.
	 */
	//get
	public function actionAdmin()
	{
		$model = new User('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['User']))
			$model->attributes = $_GET['User'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	//get
	public function actionView($id)
	{
		$this->forward('user/update/' . $id);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	//set
	public function actionCreate()
	{
		$model = new User;
		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}
		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	//set
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$old_role = $model->role_id;

		if (isset($_POST['User'])) {
			$model->scenario = 'adminUpdate';
			$model->attributes = $_POST['User'];
			if ($model->update()) {
				$auth = Yii::app()->authManager;
				$auth->revoke($old_role, $model->id);
				if ($auth->assign($model->role_id, $model->id)) {
					Yii::app()->authManager->save();
				}

				$this->redirect(array('view', 'id' => $model->id));
			}

		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	//set
	public function actionDelete($id, $del)
	{

		$model = $this->loadModel($id);
		if ($del)
			$model->deleted = 1;
		else
			$model->deleted = 0;
		$model->update();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	//set
	public function actionApprove($id, $approve)
	{
		$model = $this->loadModel($id);
		if ($approve)
			$model->approved = 1;
		else
			$model->approved = 0;

		$model->update();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

}
