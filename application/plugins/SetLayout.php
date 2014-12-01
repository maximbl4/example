<?php
class Application_Plugin_SetLayout extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');
        $view = $layout->getView();
        switch ($request->getModuleName())
        {
            case 'admin':
                $layout->setLayoutPath(APPLICATION_PATH . '/modules/admin/layouts');
                $view->headTitle('Интернет Магазин')
                     ->setSeparator("-");
            break;
            
            default:

                $layout->setLayoutPath(APPLICATION_PATH . '/modules/shop/layouts');
                 $view->headTitle('Интернет Магазин')
                     ->setSeparator("-");
                
            break;
        }
                $view->doctype('XHTML1_TRANSITIONAL');
                $view->headMeta()->appendHttpEquiv('Content-Type','text/html; charset= utf-8');
                $view->headLink()->appendStylesheet('/stylesheet/960.css' , 'all')
                                 ->appendStylesheet('/stylesheet/screen.css' , 'screen')
                                 ->appendStylesheet('/stylesheet/color.css' , 'screen')
                                 ->appendStylesheet('/stylesheet/ie.css' , 'screen', 'IE');
    }
}