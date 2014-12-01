<?php

class Application_Model_DbTable_Orders extends Zend_Db_Table_Abstract
{

    protected $_name = 'orders';
    public function addOrder($data)
    {
        $data['date'] = date('Y-m-d H:i:s');
        $data['new'] = 1;
        $this->insert($data);
    }
    
    public function getAllOrders()
    {
        return $this->fetchAll()->toArray();
    }
    
    public function getOrderById($id)
    {
        $where = $this->getDefaultAdapter()->quoteInto('id = ?', $id);
        return $this->fetchRow($where)->toArray();
    }

    public function resetOrder($id)
	{
		$where = $this->getDefaultAdapter()->quoteInto('id = ?', $id);
		$data = array('new' => '0');
		$this->update($data, $where);
	}
}

