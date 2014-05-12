<?php

class UserController extends Controller
{
	/** @var  User $user */
	private $user;


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

	public function beforeAction($action)
	{
		$model = new User();
		$headers = apache_request_headers();
		$rows = array();
		$rows['errors'] = 'smt went wrong';
		$rows['code'] = 200;
		if (Yii::app()->controller->action->id != 'signup')
			if (isset($headers['Authorization'])) {
				if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
					$email = $_SERVER['PHP_AUTH_USER'];
					$pass = $_SERVER['PHP_AUTH_PW'];
					$rows = array();
					$rows['errors'] = '';
					$rows['code'] = 200;
					$rows['success'] = true;
					$rows['token'] = $model->tokenGenerator($email, $pass);
					if (empty($rows['token'])) {
						unset($rows['token']);
						$this->_sendResponse(200, CJSON::encode($model->getErrors()));
						return false;
					} else {
						if (Yii::app()->controller->action->id == 'auth')
							$this->_sendResponse(200, CJSON::encode($rows));
						return true;
					}
				} else {
					$head = explode(':', base64_decode($headers['Authorization']));
					if (count($head) < 2) {
						$this->_sendResponse(200, 'Error ' . __LINE__);
						return false;
					}
					$h_pass = $head[0];
					$mail = $head[1];
					$model->email = $mail;
					$model->pass = $h_pass;
					if ($model->login(true)) {
						$this->user = $model->findByMail($mail)->find();
						if (Yii::app()->controller->action->id == 'auth')
							$this->_sendResponse(200, CJSON::encode($this->user));
						return true;
					} else {

						$this->_sendResponse(200, CJSON::encode($model->getErrors()));
					}
				}

			}


		if (Yii::app()->controller->action->id != 'signup') {
			$this->_sendResponse(200, CJSON::encode($rows));
			return false;
		} else {
			return true;
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
	private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
		// and the content type
		header('Content-type: ' . $content_type);

		if ($body != '') {
			echo $body;
		} else {

			$message = '';


			switch ($status) {
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}

			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

			$body = '
					<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
					<html>
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
						<title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
					</head>
					<body>
						<h1>' . $this->_getStatusCodeMessage($status) . '</h1>
						<p>' . $message . '</p>
						<hr />
						<address>' . $signature . '</address>
					</body>
				</html>';

			echo $body;
		}
		Yii::app()->end();
	}

	private function _getStatusCodeMessage($status)
	{

		$codes = Array(
			200 => 'OK',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
		);
		return (isset($codes[$status])) ? $codes[$status] : '';
	}
}