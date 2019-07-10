<?php
namespace Vendor\Module\Model\ResourceModel;
class Item extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
     protected function _construct()
    {
        $this->_init('quote_item','quote_item_item_id');
    }
}