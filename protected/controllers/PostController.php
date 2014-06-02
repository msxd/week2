<?php

Yii::import('application.extensions.image.Image');

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
				'roles' => array(User::ROLE_USER),
			),
			array('deny',
				'actions' => array('index'),
				'users' => array('*'),
			),

		);
	}

	//get model(get)
	public function loadModel($id)
	{
		$model = (Yii::app()->user->checkAccess('editPost')) ? Post::model()->findByPk($id) : Post::model()->ownPosts()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	//show errors(get)
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (!Yii::app()->request->isAjaxRequest)
				$this->render('error', $error);
		}
	}

	//show posts(get)
	public function actionIndex()
	{
		$this->render('shows');
	}

	//add post(set)
	public function actionAdd()
	{ //todo перенести в модель

		$model = new Post();
		if ($model->attributes = Yii::app()->request->getPost('Post')) {


			if ((CUploadedFile::getInstance($model, 'image') != null)) {
				$image = CUploadedFile::getInstance($model, 'image');
				$name = time() . '.' . $image->getExtensionName();
				$image->saveAs(Yii::getPathOfAlias('webroot.images') . DIRECTORY_SEPARATOR . $name);
				$model->img_path = (Yii::getPathOfAlias('webroot.images') . DIRECTORY_SEPARATOR . $name);
			}
			if ($model->save()) {
				$this->redirect(array('/site'));
			} else {
//				dbug::dumpArray($model->getErrors());
				$this->render('add', array('errors' => $model->getErrors()));
			}
		} else {
			$this->render('add', array('model' => $model));
		}
	}

	//edit post(set)
	public function actionEdit($id)
	{
		//todo перенести в модель
		/** @var Post $model */
		$model = null;


		$model = $this->loadModel($id);
		if ($model === null) {
			throw new CHttpException(404, 'post with id ' . $id . ' is not found');
		}
		if ($model->attributes = Yii::app()->request->getPost('Post')) {
			if (CUploadedFile::getInstance($model, 'image') != null) {
				$image = CUploadedFile::getInstance($model, 'image');
				$name = time() . '.' . $image->getExtensionName();
				$image->saveAs(Yii::getPathOfAlias('webroot.images') . DIRECTORY_SEPARATOR . $name);
				$model->img_path = (Yii::getPathOfAlias('webroot.images') . DIRECTORY_SEPARATOR . $name);
			}

			if ((!empty($model->img_path)) && $model->remove_img == 1) {
				if (file_exists($model->img_path))
					unlink($model->img_path);
				$prev = $model->getPreviewPath($model->img_path);

				if (file_exists($prev))
					unlink($model->getPreviewPath($model->img_path));
				$model->img_path = '';
			}

			if ($model->save()) {
				$this->redirect(array('/site'));
			} else {
				$this->render('index', array('errors' => $model->getErrors()));
			}
		} else {
			$this->render('index', array('model' => $model));
		}

	}

	//edit post status(set)
	public function actionHide($id, $val)
	{
		$model = $this->loadModel($id);
		if ($val == 'f')
			$model->published = 1;
		else
			$model->published = 0;

		$model->update();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
}