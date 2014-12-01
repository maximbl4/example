<?php

class Application_Model_DbTable_Products extends Zend_Db_Table_Abstract
{

    protected $_name = 'products';
    
    public function deleteProductById($id)
    {
        $this->delete("id = $id");
    }
    public function getAllproducts()
    {
        return $this->fetchAll()->toArray();
    }
    public function getAllProductsForPaginator()
    {
        $select = $this->select();
        return new Zend_Paginator_Adapter_DbSelect($select);
    }
    public function gettProductsByFm($fm)
    {
        $select = $this->select()->where("fm = $fm");
        return new Zend_Paginator_Adapter_DbSelect($select);
    }
    
    public function gettProductsById($id)
    {
        $where = $this->getDefaultAdapter()->quoteInto('id = ?', $id);
        return $this->fetchRow($where)->toArray();
    }
    
    public function addProduct($data)
    {
        $this->insert($data);
    }
    
    public function editProduct($data, $id)
    {
        $where = $this->getDefaultAdapter()->quoteInto('id = ?', $id);
        $this->update($data,$where);
    }


}

