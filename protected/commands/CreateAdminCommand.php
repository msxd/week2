<?php

class CreateAdminCommand extends CConsoleCommand
{
	public function actionIndex($email='admini@stradm.in', $first_name='administrator', $last_name='admininstfxvc',
								$phone='1231231234', $password='admin', $repeat_password='admin')
	{
		$model = new User();
		$model->role_id = User::ROLE_ADMIN;
		$model->email = $email;
		$model->first_name = $first_name;
		$model->last_name = $last_name;
		$model->pass = $password;
		$model->r_pass = $repeat_password;
		$model->phone = $phone;
		$model->approved = User::APPROVE_TRUE;

		if ($model->save())
			die('Success!\n');
	}
}