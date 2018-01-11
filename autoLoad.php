<?php
/**
 * Created by PhpStorm.
 * User: ChengH
 * Date: 2018/1/11
 * Time: 15:28
 */

class AutoLoad {
    public static function registerAutoload() {
        spl_autoload_register(__CLASS__ . '::autoLoader');
    }

    public static function autoLoader() {
        require(__DIR__ . DIRECTORY_SEPARATOR .'application' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'CheckSignPlugin.php');
        require(__DIR__ . DIRECTORY_SEPARATOR .'application' . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'ResponseUtils.php');
    }
}