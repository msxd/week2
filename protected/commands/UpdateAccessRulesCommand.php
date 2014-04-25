<?
class UpdateAccessRulesCommand extends CConsoleCommand
{
	public function run($args)
	{
		$auth = Yii::app()->authManager;
		$auth->clearAll();

		$auth->createOperation('editComment');
		$auth->createOperation('editPost');
		$auth->createOperation('editPage');

		$auth->createOperation('complainComment', '', 'return Yii::app()->user->id != $params["model"]->user_id;');
		$auth->createOperation('complainLook', '', 'return Yii::app()->user->id != $params["model"]->user_id;');
		$auth->createOperation('complainUser', '', 'return true;');

		$auth->createTask('editOwnComment', '', 'return Yii::app()->user->id == $params["model"]->user_id;')
			->addChild('editComment');

		$auth->createTask('editOwnLook', '', 'return Yii::app()->user->id == $params["model"]->user_id;')
			->addChild('editLook');

		$role = $auth->createRole(User::ROLE_USER);
		$role->addChild('editOwnComment');
		$role->addChild('editOwnLook');
		$role->addChild('complainComment');
		$role->addChild('complainLook');
		$role->addChild('complainUser');

		$role =$auth->createRole(User::ROLE_MODERATOR);
		$role->addChild(User::ROLE_USER);
		$role->addChild('editComment');
		$role->addChild('editLook');

		$role=$auth->createRole(User::ROLE_ADMIN);
		$role->addChild(User::ROLE_MODERATOR);
		$role->addChild('editBanner');
		$role->addChild('editPage');

		$auth->save();
	}
}