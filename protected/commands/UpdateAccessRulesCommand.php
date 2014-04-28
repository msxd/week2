<?php
class UpdateAccessRulesCommand extends CConsoleCommand
{
	public function run($args)
	{
		$auth = Yii::app()->authManager;
		$auth->clearAll();

		$auth->createOperation('editComment');
		$auth->createOperation('editPost');
		$auth->createOperation('editUser');
		$auth->createOperation('editUserStatus');

		$auth->createTask('editOwnComment', '', 'return Yii::app()->user->id == $params["model"]->user_id;')
			->addChild('editComment');

		$auth->createTask('editOwnPost', '', 'return Yii::app()->user->id == $params["model"]->user_id;')
			->addChild('editPost');

		$auth->createTask('editOwnUser','','return Yii::app()->user->id == $params["$model"]->user_id')
			->addChild('editUser');

		$role = $auth->createRole(User::ROLE_USER);
		$role->addChild('editOwnComment');
		$role->addChild('editOwnPost');
		$role->addChild('editOwnUser');

		$role =$auth->createRole(User::ROLE_MODER);
		$role->addChild(User::ROLE_USER);
		$role->addChild('editComment');
		$role->addChild('editPost');
		$role->addChild('editUserStatus');

		$role=$auth->createRole(User::ROLE_ADMIN);
		$role->addChild(User::ROLE_MODER);
		$role->addChild('editUser');


		$auth->save();
	}
}