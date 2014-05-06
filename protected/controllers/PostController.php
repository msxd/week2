<?php

/*
 *
 *
 */

class PostController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('index'),
				'roles' => array(User::ROLE_ADMIN, User::ROLE_MODER, User::ROLE_USER),
			),
			array('deny',
				'actions' => array('index'),
				'users' => array('*'),
			),

		);
	}


	public function actionIndex($id = null)
	{
		/** @var Post $model */
		if ($id != null) {
			$model = $this->loadModel($id);

			if ($model->attributes = Yii::app()->request->getPost(get_class($model))) {
				if (!$model->edit($id, $_REQUEST['Post'])) {
					throw new CDbException('Error in request, try again later');
				}
			}


			$this->render('index', array('model' => $model));
		} else {

			if (Yii::app()->user->checkAccess(User::ROLE_USER)) {
				$model = Post::model()->with('user')->ownPosts(Yii::app()->user->id)->findAll();
				$this->render('shows', array('model' => $model));
			}

			if (Yii::app()->user->checkAccess(User::ROLE_MODER)) {
				$model = Post::model()->with('user')->findAll();
				$this->render('shows', array('model' => $model));
			}

		}
	}

	public function loadModel($id)
	{
		$model = null;
		if (Yii::app()->user->checkAccess(User::ROLE_USER)) {
			$model = Post::model()->ownPosts(Yii::app()->user->id)->findByPk($id);
			if ($model === null) {
				throw new CHttpException(404, 'post with id ' . $id . ' not found');
			}
		}
		if (Yii::app()->user->checkAccess(User::ROLE_MODER)) {
			$model = Post::model()->findByPk($id);
			if ($model === null) {
				throw new CHttpException(404, 'post with id ' . $id . ' not found');
			}
		}
		return $model;
	}

	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionAdd()
	{
		$model = new Post();
		if (isset($_POST['Post'])) {
			$model->attributes = $_POST['Post'];
			$model->user_id = Yii::app()->user->id;
			if ($model->save()) {
				$this->redirect(array('/site'));
			} else {
				dbug::dumpArray($model->getErrors());
			}
		} else {
			$this->render('add', array('model' => $model));
		}
	}
}