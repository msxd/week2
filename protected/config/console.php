<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Work Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=week3',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '0000',
			'charset' => 'utf8',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);