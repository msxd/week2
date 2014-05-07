<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex($pid = '-')
	{
// renders the view file 'protected/views/site/index.php'
// using the default layout 'protected/views/layouts/main.php'
		if ($pid == '-') {
			$all_posts = Post::model()->published()->with('user')->findAll();
			$this->render('index', array('posts' => $all_posts));
		} else {
			/** @var Post[] $post_with_pid */

			//$post_with_pid = Post::model()->getNew($pid)->with(array('user', 'comments'))->findAll();
			$post_with_pid = Post::model()->getNew($pid)->with('user', 'comments')->findAll();

			if ($post_with_pid[0]->published != 0) {
				$this->render('index', array('posts' => $post_with_pid));
			} else {
				//$this->redirect(Yii::app()->user->returnUrl);
				$this->render('index', array('errors' => array('Post not found')));

			}
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
		$model = new User('login');

		if ($model->attributes = Yii::app()->request->getPost('User')) {

			if ($model->login()) {
				// form inputs are valid, do something here
				$this->redirect(Yii::app()->user->returnUrl);
				return;
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
		$model = new User('registration');

		if ($model->attributes = Yii::app()->request->getPost('User')) {
			if (!Yii::app()->params['aproveUser']) {
				$model->approved = 1;
			}
			if ($model->save()) {
				// form inputs are valid, do something here
				$model->afterReg();
				$this->redirect(Yii::app()->user->returnUrl);


			}
		}

		$this->render('registration', array('model' => $model));
	}
}