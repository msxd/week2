<?php

class UserController extends ApiController
{
	/** @var  User $user */

	public function actionList()
	{
		$models = User::model()->findAll();
		$rows = array();
		foreach ($models as $model)
			$rows[] = $model->attributes;
		// Send the response
		$this->_sendResponse(200, CJSON::encode($rows));
	}

	public function actionView()
	{
		$this->_sendResponse(200, CJSON::encode($this->user));
	}

	public function actionUpdate()
	{
		unset($_POST['approved']);
		unset($_POST['deleted']);
		unset($_POST['role_id']);
		unset($_POST['pass']);
		unset($_POST['r_pass']);
		unset($_POST['role_id']);
		$this->user->attributes = $_POST;
		if ($this->user->save())
			$this->_sendResponse(200, CJSON::encode($this->user));
		else
			$this->_sendResponse(200, CJSON::encode($this->user->getErrors()));
	}

	public function actionChange()
	{
		$model = $this->user;
		$model->setScenario('change');

		if (isset($_POST)) {
			$model->attributes = $_POST;
			if ($model->save())
				$this->_sendResponse(200, CJSON::encode('ok'));
			else
				$this->_sendResponse(200, CJSON::encode($model->getErrors()));
		} else {
			$this->_sendResponse(200, CJSON::encode(array('error' => array('old_pass is incorrect', 'pass is required', 'r_pass is required'))));
		}

	}

	public function actionAuth()
	{

	}

	public function actionSignup()
	{
		$model = new User('registration');
		if ($model->attributes = $_POST) {
			if (!Yii::app()->params['aproveUser']) {
				$model->approved = 1;
			}
			if ($model->save()) {
				// form inputs are valid, do something here
				$model->afterReg();
				$this->_sendResponse(200, CJSON::encode($model->getErrors()));
			}
			$this->_sendResponse(200, CJSON::encode($model->getErrors()));
		}
		$this->_sendResponse(200, CJSON::encode(array('errors' =>
					array(
						'email' =>
							'E-mail cannot be blank',
						"pass" =>
							"Password cannot be blank.",
						"r_pass" =>
							"Password again cannot be blank.",
						"first_name" =>
							"First Name cannot be blank.",
						"last_name" =>
							"Last Name cannot be blank."
					)
				)
			)
		);
		echo(Yii::app()->user->id);
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->_sendResponse();
	}
}