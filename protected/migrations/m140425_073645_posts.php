<?php

class m140425_073645_posts extends CDbMigration
{
	public function up()
	{
		$this->createTable('posts',array(
			'id'=>"pk",
			'body' => "text NOT NULL",
			'title' => "varchar (255) NOT NULL DEFAULT ''",
			'created_at' => "timestamp NULL",
			'updated_at' => "timestamp NULL",
			'user_id' => "integer NOT NULL",
			'published' => "integer",
			'img_path' => "varchar (255) NULL",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		$this->addForeignKey('fk_post_user_id', 'posts', 'user_id', 'users', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		echo "m140425_073645_posts does not support migration down.\n";
		return false;
	}

}