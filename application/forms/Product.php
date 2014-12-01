<?php 
    class Application_Form_Product extends Zend_Form
    {
    
        public function init()
        {
            //this->setAttrib('enctype',)
            $id = new Zend_Form_Element_Hidden('id');
            
            $model = new Zend_Form_Element_Text('title');
            $model->setLabel('Name of Tshirt')
                    ->setRequired(true)
                    ->addValidator('NotEmpty',true, array(
                        'messages' => array('isEmpty' =>'Enter the name of Tshirt')
                        ));
            
            $desc = new Zend_Form_Element_Text('discription');
            $desc->setLabel('Description of Tshirt')
                    ->setRequired(true)
                    ->addValidator('NotEmpty',true, array(
                        'messages' => array('isEmpty' =>'Enter the description of Tshirt')
                        ));                          
           $image = new Zend_Form_Element_File('small_image');
            $image->setLabel('Image')
                       ->setDestination('images');           
            $fm = new Zend_Form_Element_Text('fm');
            $fm->setLabel('Male/Female 1/2')
                    ->setRequired(true)
                    ->addValidator('NotEmpty',true, array(
                        'messages' => array('isEmpty' =>'Enter the description of Tshirt')
                        ));  
            $price = new Zend_Form_Element_Text('price');
            $price->setLabel('Price ')
                    ->setRequired(true)
                    ->addValidator('NotEmpty',true, array(
                        'messages' => array('isEmpty' =>'Enter the price')
                        ));
            
            $submit = new Zend_Form_Element_Submit('submit');
            $submit->setLabel('Save');
            
            $this->addElements(array($id, $model, $image,$desc,$fm, $price,$submit));
                        
        }
    
    
    }
