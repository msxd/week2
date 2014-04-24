<?

class CActiveRecord extends CActiveRecord{

	public $errors = array();
	public $scenario = '';
	public $attributes = array();
	/** @var CList */
	public $validatorList;
}



class CWebApplication{

	/** @var PHPMailer */
	public $mailer;

	/** @var Bootstrap */
	public $bootstrap;

	/** @var CHttpRequest */
	public $request;

	/** @var CController */
	public $controller;

	public $params = array();

	/** @var CDbConnection */
	public $db;

	/** @var CWebUser */
	public $user;

	public $homeUrl = '';

	/** @var EAuth */
	public $eauth;

	/** @var CPhpAuthManager */
	public $authManager;

	/** @var Image */
	public $image;
}

class Yii{

	/**
	 * @static
	 * @return CWebApplication
	 */
	static function app(){return new CWebApplication;}
}