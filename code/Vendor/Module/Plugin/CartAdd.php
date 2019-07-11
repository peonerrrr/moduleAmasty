<?php

namespace Vendor\Module\Plugin;

use Vendor\Module\Controller\Cart\Index;

/**
 * Class CartAdd
 * @package Vendor\Module\Plugin
 */
class CartAdd
{
    protected $product;

    public function __construct(
        Index $product
    ) {
        $this->product = $product;
    }

    public function beforeExecute(
        \Magento\Checkout\Controller\Cart\Add $subject
    ) {
        $this->product->execute();
        //Your plugin code
        return [];
    }
}