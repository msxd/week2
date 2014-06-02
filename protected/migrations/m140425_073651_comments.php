<?php

class m140425_073651_comments extends CDbMigration
{
	public function up()
	{
		$this->createTable('comments', array(
			'id' => "pk",
			'body' => "text NOT NULL DEFAULT ''",
			'email' => "varchar (255) NOT NULL DEFAULT ''",
			'created_at' => "timestamp NULL",
			'updated_at' => "timestamp NULL",
			'parent_id' => "integer",
			'path' => "varchar (255) NOT NULL DEFAULT '000'",
			'post_id' => "integer NOT NULL",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');


		$this->addForeignKey('fk_comments_parent_id', 'comments', 'parent_id', 'comments', 'id', 'cascade', 'cascade');
		$this->addForeignKey('fk_comments_post_id', 'comments', 'post_id', 'posts', 'id', 'cascade', 'cascade');
	}


	public function down()
	{
		echo "m140425_073651_comments does not support migration down.\n";
		return false;
	}
}