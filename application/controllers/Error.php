<?php
/**
 * 处理未捕获异常
 * User: ChengH
 * Date: 2018/1/11
 * Time: 19:37
 */
class ErrorController extends Yaf_Controller_Abstract {

    public function errorAction($exception) {
        $response_body = array();
        $response_body['code'] = $exception->getCode();
        $response_body['message'] = $exception->getMessage();

        ResponseUtils::doResponse($response_body);
    }
}