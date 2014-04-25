<?php

class m140425_073636_users extends CDbMigration
{
	public function up()
	{
		/*

		CREATE TABLE IF NOT EXISTS `users` (

  `facebook_id` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '0 - user 1-moderator 2-admin',
  `deleted` tinyint(8) DEFAULT '0' COMMENT '0- work 1-del',
  `approved` tinyint(8) NOT NULL DEFAULT '0',

		*/


		$this->createTable('comments', array(
			'id' => "pk",
			'facebook_id' => "varchar(50) DEFAULT NULL",
			'email' => " varchar(255) NOT NULL",
			'hashed_password' => "varchar(255) NOT NULL",
			'phone' => "varchar(255) DEFAULT NULL",
			'first_name' => "varchar(255) NOT NULL",
			'last_name' => "varchar(255) NOT NULL",
			'role_id' => "tinyint NOT NULL 0 COMMENT '0 - user 1-moderator 2-admin'",
			'deleted' => "tinyint NOT NULL 0 COMMENT '0- work 1-del'",
			'approved' => "tinyint DEFAULT 0",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');


		//$this->addForeignKey('fk_comments_parent_id', 'comments', 'parent_id', 'comments', 'id', 'cascade', 'cascade');
		//$this->addForeignKey('fk_comments_post_id', 'comments', 'post_id', 'posts', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		echo "m140425_073636_users does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}