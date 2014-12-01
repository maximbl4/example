<?php

class Application_Model_DbTable_Offer extends Zend_Db_Table_Abstract
{

    protected $_name = 'offer';
    
    public function addOffer($data)
    {
        $this->insert($data);
    }
    
    public function getAllOffer()
    {
        return $this->fetchAll()->toArray();
    }
    public function getOfferById($id)
    {
        $where = $this->getDefaultAdapter()->quoteInto('id = ?', $id);
        return $this->fetchRow($where)->toArray();
    }
    
    public function resetOffer($id)
	{
		$where = $this->getDefaultAdapter()->quoteInto('id = ?', $id);
		$data = array('new' => '0');
		$this->update($data, $where);
	}
    
}

