<?php

class Application_Form_Orders extends Zend_Form
{

    public function init()
    {
        $fname = new Zend_Form_Element_Text('fname');
        $fname->setLabel('Name:')
                ->setRequired(true)
                ->addValidator('NotEmpty',true,array(
                    'messages' =>array('isEmpty' =>'¬ведите им€')
                ));
               
         $lname = new Zend_Form_Element_Text('lname');
        $lname->setLabel('Sername:')
                ->setRequired(true)
                ->addValidator('NotEmpty',true,array(
                    'messages' =>array('isEmpty' =>'¬ведите фамилию')
                ));
          
         $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Telephone:')
                ->setRequired(true)
                ->addValidator('NotEmpty',true,array(
                    'messages' =>array('isEmpty' =>'¬ведите телефон')
                ));
                
        $address = new Zend_Form_Element_Textarea('address');
        $address->setLabel('Adress:')
                ->setAttribs(array('cols' => 10, 'rows' => 5))
                ->setRequired(true)
                ->addValidator('NotEmpty',true,array(
                    'messages' =>array('isEmpty' =>'¬ведите адрес')
                ));
                
         $submit = new Zend_Form_Element_Submit('submit');
         $submit->setLabel('MakeOrder');
         
         $this->addElements(array($fname,$lname,$phone,$address,$submit));               
    }


}

