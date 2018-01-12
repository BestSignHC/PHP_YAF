<?php
/**
 * 引导程序. 它是Yaf提供的一个全局配置的入口, 在Bootstrap中, 你可以做很多全局自定义的工作.

 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */

class Bootstrap extends Yaf_Bootstrap_Abstract{

    public function _initNoView(Yaf_Dispatcher $dispatcher) {
        $dispatcher->disableView();
    }

    /**
     * 注册签名检查插件
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initPlugin(Yaf_Dispatcher $dispatcher) {
        $checkSignPlugin = new CheckSignPlugin();
        $dispatcher->registerPlugin($checkSignPlugin);
    }

    /**
     * 配置路由
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initRoute(Yaf_Dispatcher $dispatcher) {
        $router = Yaf_Dispatcher::getInstance()->getRouter();
        $route = new Yaf_Route_Rewrite('open/regUser.json',array('module'=>'','controller' => 'RegUser','action' => 'reg'));
        $router->addRoute('product', $route);
    }

}