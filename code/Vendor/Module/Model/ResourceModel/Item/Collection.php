<?php
namespace Vendor\Module\Model\ResourceModel\Item;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Vendor\Module\Model\Item','Vendor\Module\Model\ResourceModel\Item');
    }

}