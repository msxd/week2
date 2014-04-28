<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Work Console Application',

	// preloading 'log' component
	'preload' => array('log'),

	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
	),


	// application components
	'components' => array(
		'authManager' => array(
			'class' => 'CPhpAuthManager',
		),

		'db'=>require('db.php'),

		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),
);