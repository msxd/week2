<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/** @var User $_user */
	private $_user;

	public $email;

	public function __construct($user)
	{
		$this->_user = $user;
	}

	public function authenticate()
	{
		// если есть модель, авторизуемся
		if ($this->_user) {
			$user = $this->_user;
			$this->_id = $user->id;
			$this->email = $user->email;

			// RBAC

			$auth = Yii::app()->authManager;
			if (!$auth->isAssigned($user->role_id, $user->id)) {
				if ($auth->assign($user->role_id, $user->id)) {
					Yii::app()->authManager->save();
				}
			}
		}

		return $this->errorCode == self::ERROR_NONE;
	}

	public function getId()
	{
		return $this->_id;
	}

}
