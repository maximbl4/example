<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $productsModel = new Application_Model_DbTable_Products();
        $paginator = new Zend_Paginator($productsModel->getAllProductsForPaginator());
        $paginator->setItemCountPerPage(3)
                  ->setCurrentPageNumber($this->_request->getParam('page',1))
                  ->setPageRange(11);
        $this->view->products = $paginator;
        }
    
    public function viewtshirtmAction()
    {
        $productsModel = new Application_Model_DbTable_Products();
        $paginator = new Zend_Paginator($productsModel->gettProductsByFm(1));
        $paginator->setItemCountPerPage(3)
                  ->setCurrentPageNumber($this->_request->getParam('page',1))
                  ->setPageRange(11);
        $this->view->products = $paginator;
    }
    
    public function viewtshirtfAction()
    {
        $productsModel = new Application_Model_DbTable_Products();
        $paginator = new Zend_Paginator($productsModel->gettProductsByFm(2));
        $paginator->setItemCountPerPage(3)
                  ->setCurrentPageNumber($this->_request->getParam('page',1))
                  ->setPageRange(11);
        $this->view->products = $paginator;
        
    }
        
    public function makeOrderAction()
    {
        $orderForm = new Application_Form_Orders();
        if($this->_request->isPost() && $orderForm->isValid($this->_request->getPost()))
        {
           $data = array(
              'client' =>  serialize(array(
                                'fname' =>$this->_request->getPost('fname'),
                                'lname' =>$this->_request->getPost('lname'),
                                'phone' =>$this->_request->getPost('phone'),
                                'address' =>$this->_request->getPost('address')
                            )),
            //'products' => serialize(array())
            'products' => '1'
            );
         }
         $ordersModel = new Application_Model_DbTable_Orders();
         $ordersModel->addOrder($data);
         $this->view->message = "All right";
         $orderForm->reset();
        
        $this->view->orderForm = $orderForm;
    }
    
    public function viewoneAction()
    {
        $id = $this->_request->getParam('id');
        $productModel = new Application_Model_DbTable_Products();
        $product = $productModel->gettProductsById($id);
        $this->view->product = $product;   
    }
    
    public function offertshirtAction()
    {
        $orderForm = new Application_Form_Offer();
        if($this->_request->isPost() && $orderForm->isValid($this->_request->getPost()))
        {
            if(!is_null($orderForm->getValue('small_image')) && $orderForm->small_image->receive())
             {
                $newName = "images/" . md5(date('Y-m-d H:i')) . '_' . $orderForm->getValue('small_image');
                rename ('images/' . $orderForm->getValue('small_image'), $newName);
                $temp = md5(date('Y-m-d H:i')) . '_' . $orderForm->getValue('small_image');
                
            $date['title'] = $this->_request->getPost('title');
            $data = array('title' => $this->_request->getPost('title'), 'small_image' => $temp);
            $modelOffer = new Application_Model_DbTable_Offer();
            $modelOffer->addOffer($data);
            $url = $this->view->url(array('controller' => 'index', 'action' => 'index', 'module' => 'shop'),'default');
            $this->_helper->redirector->gotoUrl($url);                           
            }
        }
        $form = new Application_Form_Offer();
        $this->view->form = $form;
    }


}

