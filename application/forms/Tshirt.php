<?php

class Application_Form_Tshirt extends Zend_Form
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
          
                
      $fimage = new Zend_Form_Element_File('fimage');
      $fimage->setLabel("Designe of tshirt")
             ->setDestination(APPLICATION_PATH ."/data")
             ->setRequired(true)
             ->addValidator('NotEmpty',true,array(
                    'messages' =>array('isEmpty' =>'¬ведите им€')));
      
                
         $submit = new Zend_Form_Element_Submit('submit');
         $submit->setLabel('MakeOrder');
         
         $this->addElements(array($fname,$lname,$fimage,$submit));               
    }


}

