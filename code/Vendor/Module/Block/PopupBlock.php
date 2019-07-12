<?php
namespace Vendor\Module\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;


class PopupBlock extends \Magento\Framework\View\Element\Template
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
    public function getHtmlBlock(){
        echo 'Привет я блок';
    }
}
