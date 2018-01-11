<?php
/**
 * Created by PhpStorm.
 * User: ChengH
 * Date: 2018/1/11
 * Time: 10:18
 */

class RegUserController extends Yaf_Controller_Abstract {
    public function regAction() {
        $request_uri = $_SERVER['REQUEST_URI'];
        $this->getView()->assign("request_uri", $request_uri);

        $request_body = file_get_contents("php://input");

        $request_body = @json_decode($request_body);
        if (null == $request_body) {
            print "empty/invalid requestBody";
            return;
        }

        $content = $request_body->request->content;
        if (null == $content) {
            print "empty/invalid content";
        }

        $email = $content->email;
        $mobile = $content->mobile;
        $name = $content->name;
        $userType = $content->userType;

        $response_body = array();
        $response_body['email'] = $email;
        $response_body['name'] = $name;
        $response_body['userType'] = $userType;
        $response_body['mobile'] = $mobile;

        ResponseUtils::doResponse($response_body);
    }
}