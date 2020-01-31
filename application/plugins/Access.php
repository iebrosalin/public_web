<?php

class Application_Plugin_Access extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $acl=Zend_Registry::get('acl');

        $controller= $request->getControllerName();

        $action=$request->getActionName();
        $role='guest';

        Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl($acl);
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole($role);
//        if(!$acl->isAllowed($role,$controller,$action)){
//           $request->setControllerName('index')
//               ->setActionName('index');
//        }
    }
}