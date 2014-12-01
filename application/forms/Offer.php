<?php 
    class Application_Form_Offer extends Zend_Form
    {
    
        public function init()
        {
            //this->setAttrib('enctype',)
            $id = new Zend_Form_Element_Hidden('id');
            
            $model = new Zend_Form_Element_Text('title');
            $model->setLabel('Name of your tshirt')
                    ->setRequired(true)
                    ->addValidator('NotEmpty',true, array(
                        'messages' => array('isEmpty' =>'Enter the name of Tshirt')
                        ));
            
                                      
           $image = new Zend_Form_Element_File('small_image');
            $image->setLabel('Designe of your tshirt')
                       ->setDestination('images');
            
            $submit = new Zend_Form_Element_Submit('submit');
            $submit->setLabel('Save');
            
            $this->addElements(array($id,$model, $image,$submit));
                        
        }
    
    
    }
