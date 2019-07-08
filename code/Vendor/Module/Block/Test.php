<?php
namespace Vendor\Module\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;


class Test extends \Magento\Framework\View\Element\Template
{
    protected $_scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Context $context,
        array $data = []
    )
    {
       $this->_scopeConfig = $scopeConfig;
       parent::__construct($context, $data);
    }

    public function getFormUrl() {
        return $this->_scopeConfig->getValue("module/general/custom_url");
    }

}
