<?php

class m140425_073636_users extends CDbMigration
{
	public function up()
	{
		$this->createTable('users', array(
			'id' => "pk",
			'facebook_id' => "varchar(50) DEFAULT NULL",
			'email' => " varchar(255) NOT NULL",
			'hashed_password' => "varchar(255) NOT NULL",
			'phone' => "varchar(255) DEFAULT NULL",
			'first_name' => "varchar(255) NOT NULL",
			'last_name' => "varchar(255) NOT NULL",
			'role_id' => "tinyint DEFAULT 0", //COMMENT '0 - user 1-moderator 2-admin'
			'deleted' => "tinyint DEFAULT 0", //COMMENT '0- work 1-del'
			'approved' => "tinyint DEFAULT 0",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		echo "m140425_073636_users does not support migration down.\n";

		return false;
	}

}