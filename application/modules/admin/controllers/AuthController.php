<?php

class Admin_AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $loginForm = new Application_Form_Login();
        
        if($this->_request->getPost() && $loginForm->isValid($this->_request->getPost()))
        {
            $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
            $authAdapter-> setTableName('users')
                        ->setIdentityColumn('username')
                        ->setCredentialColumn('password')
                        ->setCredentialTreatment('MD5(CONCAT(salt,?))');
            
            $authAdapter->setIdentity($this->_request->getPost('username'))
                        ->setCredential($this->_request->getPost('password'));
                        
            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($authAdapter);
            
            if($result->isValid()){
                $identity = $authAdapter->getResultRowObject();
                $authStorage = $auth->getStorage();
                $authStorage->write($identity);
                $this->_helper->redirector('index','index','admin');
            } else {
                 $this->view->message ='Erorr';
            }                  
        
        }
        
        $this->view->loginForm = $loginForm;
    
    }
    
   public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'index', 'admin');
    }


}

