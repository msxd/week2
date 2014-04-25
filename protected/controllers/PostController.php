<?php

class PostController extends Controller
{
	public function actionIndex($id)
	{
		var_dump($_POST);
		/** @var Post $model */
		$model = $this->loadModel($id);

		if(isset($_POST['some'])){
			$model->body = $_POST['some'];
			if($model->save()){
				echo 'OK!';
			}else{
				echo 'FAIL:(';
			}
		}
		$this->render('index',array('model'=>$model));
	}
	public function loadModel($id)
	{
		$model = Post::model()->findByPk($id);
		if ($model === null)
		{
			throw new CHttpException(404, 'post not found');
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