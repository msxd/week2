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
	public function actionIndex()
	{
// renders the view file 'protected/views/site/index.php'
// using the default layout 'protected/views/layouts/main.php'
		$pid = isset($_GET['pid']) ? $_GET['pid'] : '-';
		if ($pid === '-') {
			//	$all_posts = Post::model()->hotNews()->with('user')->findAll();
			$all_posts = Post::model()->published()->with('user')->findAll();
			$this->render('index', array('posts' => $all_posts));
		} else {
			$post_with_pid = Post::model()->getNew($pid)->with('comments')->with('user')->findAll();
			if ($post_with_pid[0]['published'] != 0) {
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$this->render('index');
	}

	/**
	 * Displays the login page
	 *
	 * public function actionLogin()
	 * {
	 * $model=new LoginForm;
	 *
	 * // if it is ajax validation request
	 * if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
	 * {
	 * echo CActiveForm::validate($model);
	 * Yii::app()->end();
	 * }
	 *
	 * // collect user input data
	 * if(isset($_POST['LoginForm']))
	 * {
	 * $model->attributes=$_POST['LoginForm'];
	 * // validate user input and redirect to the previous page if valid
	 * if($model->validate() && $model->login())
	 * $this->redirect(Yii::app()->user->returnUrl);
	 * }
	 * // display the login form
	 * $this->render('login',array('model'=>$model));
	 * }*/

	public function actionLogin()
	{
		$model = new User('login');

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			if ($model->validate()) {
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
		$this->render('registration', array('model' => $model));
	}
}