<?php

namespace Vendor\Module\Plugin;

use Vendor\Module\Controller\Cart\Index;
use Vendor\Module\Block\PopupBlock;

/**
 * Class CartAdd
 * @package Vendor\Module\Plugin
 */
class CartAdd
{
    /**
     * @var Index
     */
    protected $product;

    public function __construct(
        Index $product,
        PopupBlock $block
    ) {
        $this->product = $product;
        $this->block = $block;
    }

    /**
     * @param \Magento\Checkout\Controller\Cart\Add $subject
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeExecute(
        \Magento\Checkout\Controller\Cart\Add $subject
    ) {

//        $block = $this->getLayout()->createBlock('Vendor\Module\Block\PopupBlock');
//        $block->setTemplate('Vendor_Module::popupHtml.phtml');
        $this->product->execute();
        //Your plugin code
        return [];
    }
}