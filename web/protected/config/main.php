<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>"Unattended Server",

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.vendor.*',
		'application.helpers.*',
		'application.components.*',
		'application.components.enums.*',
		'application.components.structs.*',
		'application.extensions.YiiMailer.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'unattended',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
			'class'=>'WebUser',
		),
		'request'=>array(
			'class'=>'application.components.HttpRequest',
            'enableCsrfValidation'=>true,
            'noCsrfValidationRoutes'=>array('update/process', 'update/checkUt4'),
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'/' => 'update/process',
				'login' => 'site/login',
				'logout' => 'site/logout',
				'manage' => 'manage/index',
				'install' => 'install/install',
				'install/<step:\d+>' => 'install/install',
				'update/ut4-check' => 'update/checkUt4',
				'update/ut4-versionmap' => 'update/versionMap',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=unattended',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
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
			),
		),
	),
	'params'=>array(
		'PAGE_SIZE' => 20,
		'BCRYPT_COST' => 12,
		'UPDATE_SERVER' => 'unattendedserver.local'
	),
);
