<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if(Zend_Auth::getInstance()->hasIdentity()) echo "OK";
    }
    
    public function editAction()
    {
        $modelProducts = new Application_Model_DbTable_Products();
        $productsArray = $modelProducts->getAllproducts();
        
        $this->view->products = $productsArray;
    }
    
    public function deleteAction()
    {
        $id = $this->_request->getParam('id');
        $modelProducts = new Application_Model_DbTable_Products();
        $product = $modelProducts->gettProductsById($id);
        	if ($product['image_small'] == '') {
    		unlink('images/' . $product['image_small']);
    	}
    	
   		if ($product['image_big'] == '') {
    		unlink('images/' . $product['image_big']);
    	}

        $productsArray = $modelProducts->deleteProductById($id);
        $url = $this->view->url(array('controller' => 'index', 'action' => 'edit', 'module' => 'admin'),'default');
            $this->_helper->redirector->gotoUrl($url);
    }
    
    public function addAction()
    {
        $productForm = new Application_Form_Product();
        if($this->_request->isPost() && $productForm->isValid($this->_request->getPost()))
        {
            $data = array(
                'title' => $this->_request->getPost('title'),
                'discription' => $this->_request->getPost('discription'),
                'price' => $this->_request->getPost('price'),
                'fm' => $this->_request->getPost('fm')
        );
        if(!is_null($productForm->getValue('small_image')) && $productForm->small_image->receive())
        {
            $newName = "images/" . md5(date('Y-m-d H:i')) . '_' . $productForm->getValue('small_image');
            rename ('images/' . $productForm->getValue('small_image'), $newName);
            $data['small_image'] = md5(date('Y-m-d H:i')) . '_' . $productForm->getValue('small_image');
        }
            $modelProducts = new Application_Model_DbTable_Products();
            $modelProducts->addProduct($data);
            $this->view->message ="Товар добавлен";
            //http://admin.tshirt/admin/index/edit
            $url = $this->view->url(array('controller' => 'index', 'action' => 'edit', 'module' => 'admin'),'default');
            $this->_helper->redirector->gotoUrl($url);
        }
        $this->view->orderForm = $productForm;
    }
    
    public function vieworderAction()
    {
        $modelOrders = new Application_Model_DbTable_Orders();
        $ordersArray = $modelOrders->getAllOrders();
        $this->view->orders = $ordersArray;
    }
    
    public function viewoneorderAction()
    {
        $id = $this->_request->getParam('id');
        $orderModel = new Application_Model_DbTable_Orders();
        $order = $orderModel->getOrderById($id);
        $this->view->product = unserialize($order['products']);
        $this->view->client = unserialize($order['client']);
        $this->view->id = $id;
    }
    
    public function oldAction()
    {
        $id = $this->_request->getParam('id');
        $modelOrders = new Application_Model_DbTable_Orders();
        $ordersArray = $modelOrders->resetOrder($id);
        $url = $this->view->url(array('controller' => 'index', 'action' => 'vieworder', 'module' => 'admin'),'default');
            $this->_helper->redirector->gotoUrl($url);
    }
    
    public function editoneAction()
    {
         $productForm = new Application_Form_Product();
         $productsModel = new Application_Model_DbTable_Products();
         
         if($this->_request->isPost() && $productForm->isValid($this->_request->getPost()))
         {
            $data = array(
                'title' => $this->_request->getPost('title'),
                'discription' => $this->_request->getPost('discription'),
                'price' => $this->_request->getPost('price'),
                'fm' => $this->_request->getPost('fm')
                );
             if(!is_null($productForm->getValue('small_image')) && $productForm->small_image->receive())
             {
            $newName = "images/" . md5(date('Y-m-d H:i')) . '_' . $productForm->getValue('small_image');
            rename ('images/' . $productForm->getValue('small_image'), $newName);
            $data['small_image'] = md5(date('Y-m-d H:i')) . '_' . $productForm->getValue('small_image');
            $product = $productsModel->gettProductsById($this->_request->getParam('id'));
            unlink('images/' . $product['image_small']);
             $productsModel->editProduct($data,$this->_request->getParam('id'));
                 $url = $this->view->url(array('controller' => 'index', 'action' => 'edit', 'module' => 'admin'),'default');
            $this->_helper->redirector->gotoUrl($url);
             }
        } else 
         {
            $id = $this->_request->getParam('id');
            $productForm->populate($productsModel->gettProductsById($id));
         }
         $this->view->productForm = $productForm; 
    }
    public function viewofferAction()
    {
        $modelOffer = new Application_Model_DbTable_Offer();
        $allOffer = $modelOffer->getAllOffer();
        $this->view->alloffer = $allOffer;
    }
    
    public function viewoneofferAction()
    {
        $id = $this->_request->getParam('id');
        $offerModel = new Application_Model_DbTable_Offer();
        $product = $offerModel->getOfferById($id);
        $this->view->product = $product;   
    }
    
    public function oldofferAction()
    {
        $id = $this->_request->getParam('id');
        $modelOrders = new Application_Model_DbTable_Offer();
        $ordersArray = $modelOrders->resetOffer($id);
        $url = $this->view->url(array('controller' => 'index', 'action' => 'viewoffer', 'module' => 'admin'),'default');
            $this->_helper->redirector->gotoUrl($url);
    }
    
}
    
    