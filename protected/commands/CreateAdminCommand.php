<?php

class CreateAdminCommand extends CConsoleCommand
{
	public function actionIndex($email='admin@adm.in', $first_name='admin', $last_name='admin', $phone='1230011223', $password='admin', $repeat_password='admin')
	{
		$model = new User();
		$model->role_id = User::ROLE_ADMIN;
		$model->email = $email;
		$model->first_name = $first_name;
		$model->last_name = $last_name;
		$model->pass = $password;
		$model->r_pass = $repeat_password;
		$model->phone = $phone;
		$model->approved = '1';

		if ($model->save())
			die('Success!');
	}
}