<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'English school',
	'language' => 'ru',
	'sourceLanguage' => 'ru',

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
			'password'=>'stirlic',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
		'admin',
		'teacher',
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// auth manager
		'authManager' => array(
			'class' => 'PhpAuthManager',
			'defaultRoles' => array('guest'),
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'/'=>'common/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=93.183.203.82;dbname=english_school',
			'emulatePrepare' => true,
			'username' => 'english_school',
			'password' => 'Q2VQKxL5xH2njuHP',
			'charset' => 'utf8',
			//'enableProfiling'=>true,
		    'enableParamLogging'=>true,
		),
		
		'errorHandler'=>array(
			// use 'common/error' action to display errors
            'errorAction'=>'common/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				/*
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				 */
				array(
					'class'=>'CWebLogRoute',
					'categories'=>'system.db.*',
					//'showInFireBug' => true,
				),
			),
		),
	),

	/*
	 * You must login for work with site
	 */
	/*
	'onBeginRequest' => create_function('$event', '
		if (Yii::app()->user->getIsGuest() && !strpos(Yii::app()->getRequest()->getUrl(), "common/login" )) {
			Yii::app()->user->loginRequired();
		}
	'),
	 */

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);