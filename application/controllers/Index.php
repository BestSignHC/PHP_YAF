<?php
/**
 * Created by PhpStorm.
 * User: ChengH
 * Date: 2018/1/11
 * Time: 10:18
 */

class IndexController extends Yaf_Controller_Abstract {
    public function indexAction() {
        $response_body = array();
        $response_body['content'] = "hello yaf";

        ResponseUtils::doResponse($response_body);
    }
}