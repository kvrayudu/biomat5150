<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Biomaterial Database',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'password',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		
		//'db'=>array(
		//	'connectionString' => 'mysql:host=127.0.0.1'/*.$_ENV['OPENSHIFT_MYSQL_DB_HOST']*/ . ';dbname=5150',
		//  'emulatePrepare' => true,
		//	'username' => 'admind5cGH9i'/*$_ENV['OPENSHIFT_MYSQL_DB_USERNAME']*/,
		//	'password' => 'Ucx6G8jn7JPG'/*$_ENV['OPENSHIFT_MYSQL_DB_PASSWORD']*/,
		//	'charset' => 'utf8',
		//),
		
		//'db'=>array(
			//'connectionString' => 'mysql:host=' .$_ENV['OPENSHIFT_MYSQL_DB_HOST']  . ';dbname=5150',
			//'emulatePrepare' => true,
			//'username' => $_ENV['OPENSHIFT_MYSQL_DB_USERNAME'],
			//'password' => $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD'],
			//'charset' => 'utf8',
		//),

		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1:3306;dbname=5150',
			'username' => 'root',
			'password' => 'root',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				// array(
				// 	'class'=>'CWebLogRoute',
				// ),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
