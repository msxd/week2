<?php

class PostController extends Controller
{

	private $rows = array();


	// Actions
	public function actionList()
	{
		$models = Post::model()->published()->findAll();
		foreach ($models as $model)
			$rows[] = $model->attributes;
		// Send the response
		$rows['status'] = '200';
		$this->_sendResponse(200, CJSON::encode($models));
		unset($rows);
	}

	public function actionView()
	{

	}

	public function actionCreate()
	{
		if (!Yii::app()->user->checkAccess(User::ROLE_USER))
			$this->_sendResponse(200, CJSON::encode('You don\'t have premissions to do this'));


		$model = new Post();
		$model->attributes = $_POST;
		$model->user_id = Yii::app()->user->id;
		$model->published = Yii::app()->params['defaultPublished'];
		if ($model->save()) {
			$this->_sendResponse(200, CJSON::encode($model));
		} else {
			$this->_sendResponse(200, CJSON::encode($model->getErrors()));
		}


	}

	public function actionUpdate()
	{

	}

	public function actionDelete()
	{

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