<?php
/**
 * Created by PhpStorm.
 * User: ChengH
 * Date: 2018/1/11
 * Time: 19:50
 */

class ResponseUtils {
    public static function doResponse($json_data) {
        $response_body = array();

        $response = new Yaf_Response_Http();
        $response->setHeader('Content-Type', 'application/json;charset=utf-8');
        $response->setBody(json_encode($json_data));

        $response->response();
    }
}