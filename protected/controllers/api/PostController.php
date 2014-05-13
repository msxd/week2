<?php

class PostController extends ApiController
{

	// Actions
	public function actionList()
	{
		/** @var Post $models */
		$models = Post::model()->with('user')->published()->findAll();
		$this->_sendResponse(200, $models);
	}

	public function actionView($id)
	{

		$model = Post::model()->getNew($id)->with('user', 'comments:orderHierarchy')->find();
		if (!isset($model))
			$this->_sendResponse(404, array('errors' => array('post with id ' . $id . ' is not found')), false);


		$this->_sendResponse(
			200,
			array(
				'post' => $model,
				'author' => $model->user->getData(),
				'comments' => $model->comments
			),true
		);
	}

	public function actionCreate()
	{
		if (!Yii::app()->user->checkAccess(User::ROLE_USER))
			$this->_sendResponse(200, array('You don\'t have premissions to do this'), false);
		$model = new Post();
		$model->attributes = $_POST;
		$model->user_id = Yii::app()->user->id;
		$model->published = Yii::app()->params['defaultPublished'];
		if ($model->save()) {
			$this->_sendResponse(200, $model, true);
		} else {
			$this->_sendResponse(200, array('errors' => $model->getErrors()), false);
		}
	}
}