<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('UserName:')
                ->setRequired(true)
                ->addValidator('NotEmpty',true,array(
                    'messages' =>array('isEmpty' =>'¬ведите им€')
                ));
               
         $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
                ->setRequired(true)
                ->addValidator('NotEmpty',true,array(
                    'messages' =>array('isEmpty' =>'¬ведите фамилию')
                ));
          
         
                
         $submit = new Zend_Form_Element_Submit('submit');
         $submit->setLabel('Enter');
         
         $this->addElements(array($username,$password,$submit));               
    }


}

