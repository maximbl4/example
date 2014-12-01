<?php
class Application_Shop_View_Helper_Cart extends Zend_View_Helper_Abstract
{
    public function cart()
    {
        $count = 0;
        $cart = new Zend_Session_Namespace('cart');
        
        if(count($cart->products)>0)
        {
            foreach($cart->products as $product)
            {
                $count+= $product['count'];
            }
        }
        
        return $count;
    }
}