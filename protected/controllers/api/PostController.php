<?php

class PostController extends ApiController
{

	public function actionList()
	{
		/** @var Post $models */
		$models = Post::model()->published()->findAll();
		if(empty($models)){
			die(
				$this->_sendEResponse(
					404,
					array(
						'errors' =>
							array(
								array(
									'New post is coming soon'
								)
							)
					),
					false
				)
			);
		}
		$this->_sendResponse(200, array($models),true);
	}

	public function actionView($id)
	{
		$model = Post::model()->getNew($id)->published()->with('user', 'comments:orderHierarchy')->find();
		if (!$model) {
			die(
				$this->_sendEResponse(
					404,
					array(
						'errors' =>
							array(
								array(
									'post with id ' . $id . ' is not found or not published'
								)
							)
					),
					false
				)
			);
		}

		$this->_sendResponse(
			200,
			array(
				'post' => $model,
				'author' => $model->user->getData(),
				'comments' => $model->comments
			), true
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
			$this->_sendEResponse(400, array('errors' => $model->getErrors()), false);
		}
	}
}