<?php
class Application_Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{
	private $_acl = null;
	private $_auth = null;
	
	public function __construct(Zend_Acl $acl, Zend_Auth $auth)
	{
		$this->_acl = $acl;
		$this->_auth = $auth;
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$module = $request->getModuleName();
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		
		if ($module == 'admin') {
			$resource = 'admin:' . $controller;
		} else {
			$resource = $controller;
		}
		
		$identity = $this->_auth->getStorage()->read();
		
		if (!empty($identity->role)) {
			$role = $identity->role;
		} else {
			$role = 'guest';
		}
		
		if (!$this->_acl->isAllowed($role, $resource, $action)) {
			$request->setControllerName('index')
			        ->setActionName('index')
			        ->setModuleName($module);
		}
	}
}