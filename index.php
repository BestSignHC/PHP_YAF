<?php
/**
 * Created by PhpStorm.
 * User: ChengH
 * Date: 2018/1/11
 * Time: 10:10
 */

define("APPLICATION_PATH",  dirname(__FILE__));
define("APPLICATION_CONF_DIR", APPLICATION_PATH. DIRECTORY_SEPARATOR .'conf');
define("APPLICATION_PLUGIN_DIR", APPLICATION_PATH . DIRECTORY_SEPARATOR. 'plugins');

require(__DIR__ . DIRECTORY_SEPARATOR . 'autoLoad.php');

AutoLoad::registerAutoload();

$app  = new Yaf_Application(APPLICATION_CONF_DIR. DIRECTORY_SEPARATOR. 'application.ini');
$app->bootstrap();  //可选操作
$app->run();