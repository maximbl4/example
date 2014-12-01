<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initRouter()
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $admin = new Zend_Controller_Router_Route_Hostname(
            'admin.'. $this->getOption('website'),
            array(
            'module'=>'admin',
            )
        );
        
        $adminIndex = new Zend_Controller_Router_Route(
            ':module/:controller/:action/*',
            array(
                'module' => 'admin',
                'controller' => 'index',
                'action' => 'index'
            )
        );
       $cart = new Zend_Controller_Router_Route(
            'cart/addd/:id',
            array(
                'controller' => 'cart',
                'action' => 'add'
            )
        );
        
        $router->addRoutes(array(
            'adminModule' => $admin->chain($adminIndex),
            'cart' => $cart,
        )); 
    }
    
    protected function _initPlugin()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Application_Plugin_SetLayout());
    }
    
    protected function _initNavigation()
    {
        $publicMenuArray = array(
            array(
                'label' => 'Мужские футболки',
                'controller' => 'index',
                'action' => 'viewtshirtm',
                'module' => 'shop'
            ),
            array(
                'label' => 'Женские футболки',
                'controller' => 'index',
                'action' => 'viewtshirtf',
                'module' => 'shop',
            ),
            array(
                'label' => 'Предложить рисунок на футболку',
                'controller' => 'index',
                'action' => 'offertshirt',
                'module' => 'shop',
                'route' => 'default',
                'id' => 'm2'
                ),
            array(
                'label' => 'Корзина',
                'controller' => 'cart',
                'action' => 'index',
                'module' => 'shop',
                'route' => 'default',
                'id'     => 'cart_menu'
            )
        );
        
        $adminMenuArray = array(
        
        array(
                'label' => 'Редактирование товаров',
                'controller' => 'index',
                'action' => 'edit',
                'module' => 'admin',
                //'route' => 'default',
                'resource' => 'admin:index',
                'privilege' => 'edit'
        ),
        
        array(
                'label' => 'Заказы',
                'controller' => 'index',
                'action' => 'vieworder',
                'module' => 'admin',
                //'route' => 'default',
                'resource' => 'admin:index',
                'privilege' => 'vieworder'
        ),
        array(
                'label' => 'Предложения',
                'controller' => 'index',
                'action' => 'viewoffer',
                'module' => 'admin',
                'route' => 'default',
                'resource' => 'admin:index',
                'privilege' => 'viewoffer'
        ),
        array(
                'label' => 'Выход из системы',
                'controller' => 'auth',
                'action' => 'logout',
                'module' => 'admin',
                'route' => 'default',
                'resource' => 'admin:auth',
                'privilege' => 'logout'
        )
        );
        $adminMenu = new Zend_Navigation($adminMenuArray);
        $publicMenu = new Zend_Navigation($publicMenuArray);
        Zend_Registry::set('publicMenu', $publicMenu);
        Zend_Registry::set('adminMenu', $adminMenu);
        
    }
    
    protected function _initHelpers()
    {
        $view = $this->bootstrap('layout')->getResource('layout')->getView();
        $view->addHelperPath(
                APPLICATION_PATH . "/modules/shop/views/helpers",
                'Application_Shop_View_Helper'
        );
    }
    
    protected function _initAcl()
    {
    	$acl = new Zend_Acl();
    	
    	$acl->addRole('guest');
    	$acl->addRole('admin', 'guest');
    	
    	$acl->addResource('index');
    	$acl->addResource('cart');
    	$acl->addResource('error');
    	
    	$acl->addResource('admin');
    	$acl->addResource('admin:index', 'admin');
    	$acl->addResource('admin:auth', 'admin');
    	
    	$acl->allow('guest', 'index');
    	$acl->allow('guest', 'cart');
    	$acl->deny('guest', 'admin');
    	$acl->allow('guest', 'admin:index', array('index'));
    	$acl->allow('guest', 'admin:auth', array('index'));
    	
    	$acl->allow('admin', 'admin');
    	$acl->allow('admin', 'error');
    	$acl->deny('admin', 'admin:auth', array('index'));
    	
    	Zend_Registry::set('acl', $acl);
    	
    	$front = Zend_Controller_Front::getInstance();
    	$front->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
    }
}

