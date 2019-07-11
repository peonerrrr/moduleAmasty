<?php
namespace Vendor\Module\Model\ResourceModel;
class Item extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
     protected function _construct()
    {
        $this->_init('vendor_module_items','post_id');
    }
}