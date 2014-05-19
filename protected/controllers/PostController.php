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
				'roles' => array(User::ROLE_ADMIN, User::ROLE_MODER, User::ROLE_USER),
			),
			array('deny',
				'actions' => array('index'),
				'users' => array('*'),
			),

		);
	}


	public function actionIndex()
	{
		$model = null;
		/** @var Post $model */
		if (Yii::app()->user->checkAccess(User::ROLE_USER)) {
			$model = Post::model()->with('user')->ownPosts()->findAll();
		}
		if (Yii::app()->user->checkAccess(User::ROLE_MODER)) {
			$model = Post::model()->with('user')->findAll();
		}
		$this->render('shows', array('model' => $model));
	}


	public function actionEdit($id)
	{
		//todo перенести в модель
		/** @var Post $model */
		$model = null;

		if ((!Yii::app()->user->checkAccess(User::ROLE_MODER)) && Yii::app()->user->checkAccess(User::ROLE_USER)) {
			$model = Post::model()->ownPosts()->findByPk($id);
			if ($model === null) {
				throw new CHttpException(404, 'post with id ' . $id . ' is not found');
			}
		}

		if (Yii::app()->user->checkAccess(User::ROLE_MODER)) {
			$model = Post::model()->findByPk($id);
			if ($model === null) {
				throw new CHttpException(404, 'post with id ' . $id . ' is not found');
			}
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
	{//todo перенести в модель

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
}