<?php

class UserController extends ApiController
{
	/** @var  User[] $user */

	public function actionList($limit = 20, $offset = 0)
	{
		$models = User::model()->findAll(array('limit' => $limit, 'offset' => $offset));
		if (empty($models)) {
			die(
			$this->_sendEResponse(
				404,
				array(
					'errors' =>
						array(
							array(
								'You don\'t have premissions'
							)
						)
				),
				false
			)
			);
		}
		$rows = array();
		foreach ($models as $model)
			/** @var User $model */
			$rows[] = $model->getData();
		// Send the response
		$this->_sendResponse(200, $rows);
	}

	public function actionView()
	{
		$this->_sendResponse(200, $this->user->getData(), true);
	}

	public function actionUpdate()
	{
		$this->user->scenario = 'editUserInfo';
		$this->user->attributes = $_POST;
		if ($this->user->save())
			$this->_sendResponse(200, ($this->user->getData()));
		else
			$this->_sendEResponse(400, array('errors' => $this->user->getErrors()));
	}

	public function actionChange()
	{
		$model = $this->user;
		$model->setScenario('change');

		if (isset($_POST)) {
			$model->attributes = $_POST;
			if ($model->save())
				$this->_sendResponse(200, $this->user->getData());
			else
				$this->_sendEResponse(400, array('errors' => $model->getErrors()));
		} else {
			$this->_sendEResponse(400, (array('errors' => array('old_pass is incorrect, pass is required, r_pass is required'))));
		}

	}

	public function actionAuth()
	{
		$this->_sendResponse(200, $this->user);
	}

	public function actionSignup()
	{
		$model = new User('registration');
		if ($model->attributes = $_POST) {
			if (!Yii::app()->params['aproveUser']) {
				$model->approved = 1;
			}
			if ($model->save()) {
				$this->_sendResponse(200, $model->getData(), true);
			} else {
				die($this->_sendEResponse(400, array('errors' => $model->getErrors())));
			}
		}
		$model->validate();
		$this->_sendEResponse(400, array('errors' => $model->getErrors()));
	}

}