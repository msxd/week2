<?php

/*
 *
 *
 */

class PostController extends Controller
{


	public function actionIndex($id = null)
	{
		/** @var Post $model */
		if ($id != null) {
			$model = $this->loadModel($id);

				if ($model->attributes = Yii::app()->request->getPost(get_class($model)))
				{
					if ($model->save())
					{

					} else {
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

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}