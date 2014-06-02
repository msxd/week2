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
	//public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $var = "controller";
	public $menu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	//public $breadcrumbs=array();
	protected $user;

	public function _sendResponse($status = 200, $body = '', $success = false, $content_type = 'text/html')
	{
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
		// and the content type
		header('Content-type: ' . $content_type);

		if ($body != '') {
			echo CJSON::encode(array('result' => $body, 'is_success' => $success, 'status' => $status));
		} else {
			echo CJSON::encode(array('errors' => 'smt went wrong, try again later.', 'is_success' => $success, 'status' => $status));
		}
		Yii::app()->end();
	}

	public function _sendEResponse($status = 400, $body = '', $success = false, $content_type = 'text/html')
	{
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
		header('Content-type: ' . $content_type);
		//print_r($body);
		$errors = array();
		foreach ($body['errors'] as $val) {
			$errors[] = $val[0];
		}
		die($this->_sendResponse(400, array('errors' => $errors), false));
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
			418 => 'I\'m teapot',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
		);
		return (isset($codes[$status])) ? $codes[$status] : '';
	}

	public function beforeAction($action)
	{
		$postData = json_decode(file_get_contents('php://input'), true);
		if ($postData)
			$_POST = array_merge_recursive($_POST, $postData);

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
					$rows['success'] = true;
					$rows['token'] = $model->tokenGenerator($email, $pass);
					if (empty($rows['token'])) {
						unset($rows['token']);
						die($this->_sendEResponse(200, array('errors' => $model->getErrors())));
						return false;
					} else {
						if (Yii::app()->controller->action->id == 'auth')
							die($this->_sendResponse(200, $rows, true));
						return true;
					}
				} else {
					$head = explode(':', base64_decode($headers['Authorization']));
					if (count($head) < 2) {
						die($this->_sendEResponse(200, array('errors' => array(array('Error ' . __LINE__)))));
						return false;
					}
					$h_pass = $head[0];
					$mail = $head[1];
					$model->email = $mail;
					$model->pass = $h_pass;
					if ($model->login(true)) {
						$this->user = $model->findByMail($mail)->find();
						if (Yii::app()->controller->action->id == 'auth')
							die($this->_sendResponse(200, $this->user->getData()));
						return true;
					} else {

						die($this->_sendEResponse(200, ($model->getErrors())));
					}
				}

			}


		if (Yii::app()->controller->action->id != 'signup') {
			$this->_sendEResponse(
				404,
				array(
					'errors' =>
						array(
							array(
								'Auth error, email and password is required'
							)
						)
				),
				false
			);
			return false;
		} else {
			return true;
		}
	}

}