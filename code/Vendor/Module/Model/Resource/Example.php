<?php
/**
 * @author Slava Yurthev
 */
namespace Vendor\Module\Model\Resource;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Example extends AbstractDb {
    protected function _construct() {
        $this->_init('example_table', 'id');
    }
}
?>