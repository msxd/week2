<?php

class PostController extends ApiController
{

	public function actionList($limit = 20, $offset = 0)
	{
		/** @var Post[] $models */
		$models = Post::model()->with('user')->published()->findAll(array('limit' => $limit, 'offset' => $offset));
		if (empty($models)) {

			$this->_sendEResponse(
				404,
				array(
					'errors' =>
						array(
							array('New post is coming soon')
						)
				),
				false
			);
		}
		$results = array();
		foreach ($models as $post) {
			$results[] = $post->toJSON();
		}
		$this->_sendResponse(200, $results, true);
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

		$this->_sendResponse(200, $model->toJSON(), true);
	}

	public function actionCreate()
	{
		if (!Yii::app()->user->checkAccess(User::ROLE_USER))
			$this->_sendResponse(403, array('You don\'t have premissions to do this'), false);
		$model = new Post();
		$model->attributes = $_POST;
		if ($model->save()) {
			$this->_sendResponse(200, $model, true);
		} else {
			$this->_sendEResponse(400, array('errors' => $model->getErrors()), false);
		}
	}

	public function actionRebuild()
	{

//        Comment::model()->hierarchy->rebuildPaths();
		$this->_sendResponse(418, 'lol', Comment::model()->hierarchy->rebuildPaths());
	}
}