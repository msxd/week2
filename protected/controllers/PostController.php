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
				'roles' => array(User::ROLE_ADMIN, User::ROLE_MODER),
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

				if ($model->attributes = Yii::app()->request->getPost(get_class($model)))
				{
					if (!$model->edit($id,$_REQUEST['Post']))
					{
						throw new CDbException('Error in request, try again later');
					}
				}



			$this->render('index', array('model' => $model));
		} else {
			$model = Post::model()->with('user')->findAll();
			$this->render('shows', array('model' => $model));
		}

	}

	public function loadModel($id)
	{
		$model = Post::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'post with id ' . $id . ' not found');
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
}