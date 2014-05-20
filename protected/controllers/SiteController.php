<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$criteria = Post::model()->published()->with('user')->getDbCriteria();
		$pages = new CPagination(Post::model()->count($criteria));
		$pages->pageSize = 5;
		$pages->applyLimit($criteria);
		$all_posts = Post::model()->findAll($criteria);
		$this->render('index', array('posts' => $all_posts, 'pages' => $pages));
	}

	public function actionView($id)
	{
		$model = new Comment('add');
		if ($model->attributes = Yii::app()->request->getPost('Comment')) {
			$model->post_id = $id;
			$model->save();
		}

		/** @var Post $post_with_pid */
		$post_with_pid = Post::model()->with('user', 'comments:orderHierarchy')->findByPk($id);
		if ($post_with_pid) {
			if ($post_with_pid->published != 0) {
				$this->render('post', array('post' => $post_with_pid));
			} else {
				$this->render('error', array('message'=>'Post with id ' . $id . ' not published','code'=>404));
			}
		} else {
			$this->render('error', array('message'=>'Post with id ' . $id . ' not found','code'=>404));
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->user->returnUrl);
		}
		$model = new User('login');

		if ($model->attributes = Yii::app()->request->getPost('User')) {

			if ($model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegistration()
	{
		if(!Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->user->returnUrl);
		}
		$model = new User('registration');

		if ($model->attributes = Yii::app()->request->getPost('User')) {
			if (!Yii::app()->params['aproveUser']) {
				$model->approved = 1;
			}
			if ($model->save()) {
				$model->afterReg();
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('registration', array('model' => $model));
	}
}