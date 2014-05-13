<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ApiController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $var = "controller";
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	protected $user;

	public function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
		// and the content type
		header('Content-type: ' . $content_type);

		if ($body != '') {
			echo CJSON::encode($body);
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

}