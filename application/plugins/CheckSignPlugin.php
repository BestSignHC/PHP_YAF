<?php
/**
 * 验证签名插件
 * User: ChengH
 * Date: 2018/1/11
 * Time: 11:48
 */

class CheckSignPlugin extends Yaf_Plugin_Abstract {

    private static $mid_public = array(
        'E0000000000000000008' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCMlltRED0klP8JAPYkA6eSN4d4GUcfT/ywvcIiEv+SCvhGAlczHWOnI+zZ67APmRTr5SjLodnlfzNt0gbmVm6sXDIcGXwDc1mL4BI0A5spFlDMqMISBtvGNjBFAi1WfIMgRdNy+pYwTiUelYP2HTH5dhS2TP/z4v3lWw0ZN4FqdwIDAQAB'
    );

    //do check sign
    public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
        //get headers
        $http_headers = getallheaders();

        $sign = @$http_headers['sign'];
        if (null == $sign || strlen($sign) < 1) {
            throw new Exception("no sign", 110007);
        }

        $mid = @$http_headers['mid'];
        if (null == $mid || strlen($mid) < 1) {
            throw new Exception("no mid", 110001);
        }

        //get action
        $request_uri = $_SERVER['REQUEST_URI'];
        $index = strrpos($request_uri, "/");
        $action = substr($request_uri, $index + 1);

        //get body
        $request_body = file_get_contents("php://input");
        $request_body_md5 = md5($request_body);

        $this->checkSign($action, $mid, $request_body_md5, $sign);

    }

    private function checkSign($action, $mid, $requestBodyMd5, $sign) {
        $sign_params = array();
        $sign_params[] = $action;
        $sign_params[] = $mid;
        $sign_params[] = $requestBodyMd5;


        $signature_string = join("\n", $sign_params);

        $public_key = self::$mid_public[$mid];
        if (null == $public_key || strlen($public_key) < 1) {
            throw new Exception("forbidden", 100001);
        }

        $public_key_id = openssl_pkey_get_public($this->formatPublic($public_key));

        $sign = urldecode($sign);
        $is_sign_pass = (bool)openssl_verify($signature_string, base64_decode($sign), $public_key_id);

        if (!$is_sign_pass) {
            throw new Exception("sign err", 110007);
        }
    }

    private function formatPublic($public_key) {
        $public_key = chunk_split($public_key, 64, "\n");
        $public_key = "-----BEGIN PUBLIC KEY-----\n$public_key-----END PUBLIC KEY-----\n";
        return $public_key;
    }
}