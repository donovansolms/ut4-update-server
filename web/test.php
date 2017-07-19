<?php
/*
// change the following paths if necessary
$yii=dirname(__FILE__).'/../../../../Users/Donovan/Development/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/test.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
*/

function launch_codeception_yii_bridge() {
    Yii::setPathOfAlias('codeception-yii',__DIR__);
    Yii::import('codeception-yii.test.CTestCase');
    Yii::import('codeception-yii.protected.vendor.CodeceptionHttpRequest');
    Yii::import('system.test.CDbTestCase');
    Yii::import('system.test.CWebTestCase');
}

// Definitions
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// Load Yii and Composer extensions
require_once __DIR__.DS.'framework'.DS.'yii.php';
//require_once __DIR__.DS.'protected'.DS.'vendor'.DS.'autoload.php';
// Load the config files
$config = require __DIR__.DS.'protected'.DS.'config'.DS.'test.php';

// Return for Codeception
return array(
    'class' => 'CWebApplication',
    'config' => $config,
);
