<?php

class UserController extends Controller
{
	// Members
	/**
	 * Key which has to be in HTTP USERNAME and PASSWORD headers
	 */
	Const APPLICATION_ID = 'ASCCPE';

	/**
	 * Default response format
	 * either 'json' or 'xml'
	 */
	private $format = 'json';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array();
	}

	// Actions
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

	}

	public function actionCreate()
	{

	}

	public function actionUpdate()
	{
	}

	public function actionDelete()
	{
	}


	public function beforeAction($action)
	{
		$model = new User();
		$headers = apache_request_headers();
		$rows = array();
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
						$rows['errors'] = 'Email or password incorrect';
						return false;
					} else {
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
						$this->_sendResponse(200, CJSON::encode($model->findByMail($mail)->find()));
						return true;
					} else {
						$rows['errors'] = 'Email or password incorrect';
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
		print_r($_REQUEST);
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