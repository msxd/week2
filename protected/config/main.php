<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/booster');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Work app',


	// preloading 'log' component
	'preload' => array('log', 'bootstrap'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
	),

	'modules' => array(
		// uncomment the following to enable the Gii tool

		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),

	),

	// application components
	'components' => array(

		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
			'coreCss' => false,
			'bootstrapCss' => false,
			'enableJS' => false,

		),
		'authManager' => array(
			'class' => 'CPhpAuthManager',
		),
		'mailer' => array(
			'class' => 'application.extensions.mailer.EMailer',
			'From' => 'no-reply@testproject.ru',
			'FromName' => '',
			'CharSet' => 'UTF-8',
			'ContentType' => 'text/html',
		),
		'user' => array(
			'class' => 'WebUser',
			'allowAutoLogin' => true, // enable cookie-based authentication
			'loginUrl' => array('site/login'),
		),
		// uncomment the following to enable URLs in path-format

		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => true,
			'rules' => array(
				'post/hide/<id:\d+>/<val:\w+>' => 'post/hide',
				'post/update/<id:\d+>' => 'post/edit',
				'user/delete/<id:\d+>/<del:\w+>' => 'user/delete',
				'user/approve/<id:\d+>/<approve:\w+>' => 'user/approve',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),

		'image' => array(
			'class' => 'application.extensions.image.CImageComponent',
			'driver' => 'GD',
			'params' => array('directory' => '/opt/local/bin'),
		),

		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database

		'db' => require('db.php'),

		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		'aproveUser' => true, //true - не логинить не подтвержденных пользователей
		'defaultPublished' => 1, //1-published or 0 moderation
		'adminEmail' => 'valikov.ids@gmail.com',
		'fromEmail' => 'no-reply@testproject.ru',
	),
);