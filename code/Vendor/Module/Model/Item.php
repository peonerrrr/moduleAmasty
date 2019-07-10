<?php
namespace Vendor\Module\Model;
class Item extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'vendor_module_item';

    protected function _construct()
    {
        $this->_init('Vendor\Module\Model\ResourceModel\Item');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}