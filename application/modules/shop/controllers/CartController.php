<?php

class CartController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $cart = new Zend_Session_Namespace('cart');
        $this->view->products = $cart->products;
    }
    
    public function addAction()
    {
        $id = $this->_request->getParam('id');
    	
    	if (is_null($id))
    	    $this->_helper->redirector('index', 'cart');
    	    
    	$cart = new Zend_Session_Namespace('cart');
    	
    	if (array_key_exists($id, $cart->products)) {
    		$cart->products[$id]['count'] += 1;
    	} else {
    		$productsModel = new Application_Model_DbTable_Products();
    		$product = $productsModel->gettProductsById($id);
    		$product['count'] = 1;
    		$cart->products[$id] = $product;
    	}
    	
    	$this->_helper->redirector('index', 'cart');
    }
    
    
    public function plusAction()
    {
        $id = $this->_request->getParam('id');
        
        if (is_null($id))
        {
            $this->_helper->redirector('index','cart');
        }
        $cart = new Zend_Session_Namespace('cart');
        
        if(array_key_exists($id,$cart->products))
        {
            $cart->products[$id]['count'] +=1;
            $this->_helper->redirector('index','cart');
        }
        
    }
    public function minusAction()
    {
        $id = $this->_request->getParam('id');
        
        if (is_null($id))
        {
            $this->_helper->redirector('index','cart');
        }
        $cart = new Zend_Session_Namespace('cart');
        
        if(array_key_exists($id,$cart->products))
        {
            $cart->products[$id]['count'] -=1;
            if($cart->products[$id]['count']<1)
            {
                unset($cart->products[$id]);
            }
        }
        $this->_helper->redirector('index','cart');
        
    }
    public function removeAction()
    {
        $id = $this->_request->getParam('id');
        
        if (is_null($id))
        {
            $this->_helper->redirector('index','cart');
        }
        $cart = new Zend_Session_Namespace('cart');
        
                unset($cart->products[$id]);
        $this->_helper->redirector('index','cart');
        
    }
    
    public function makeOrderAction()
    {
        $cart = new Zend_Session_Namespace('cart');
        if(is_null($cart)) $this->_helper->redirector('index', 'cart');   
        $orederForm = new Application_Form_Orders();
        
        if($this->_request->isPost() && $orederForm->isValid($this->_request->getPost()))
        {
            $data = array(
                'client' => serialize(array(
                                    'fname' => $this->_request->getPost('fname'),
                                    'lname' => $this->_request->getPost('lname'),
                                    'phone' => $this->_request->getPost('phone'),
                                    'address' => $this->_request->getPost('address'),
                                     )),
                'products' => serialize($cart->products)
            );
            $orderModel = new Application_Model_DbTable_Orders();
            $orderModel->addOrder($data);
            $this->view->message ="Спасибо! Ваш заказ принят. Скоро мы с Вами свяжемся";
            Zend_Session::namespaceUnset('cart');
        }
        $this->view->orderForm = $orederForm;
    }
    
}

