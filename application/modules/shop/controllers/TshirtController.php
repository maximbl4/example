<?php

class TshirtController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->message = "�����������, ������ ������ ���������
                                ��� ��������� ���� ������ ����� ���, � � ������� ��� �����
                                ��������� �� ����� ����� ��� �������</br>
                                ��� ����� ����� ��������� ������� �����</br>";
        
        $form = new Application_Form_Tshirt();
        if($this->_request->isPost() && $form->isValid($this->_request->getPost()))
        {
                $uploadedData = $form->getValue('fimage');
                $fullFilePath = $form->fimage->getFilename();
            
        } $this->view->form = $form;                       
                                
    }
    
}

