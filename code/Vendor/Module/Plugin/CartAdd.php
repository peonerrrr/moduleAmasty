<?php

namespace Vendor\Module\Plugin;

use Vendor\Module\Model\Product;

class CartAdd
{
    protected $product;

    public function __construct(
        Product $product
    ) {
        $this->product = $product;
    }

    public function beforeExecute(
        \Magento\Checkout\Controller\Cart\Add $subject
    ) {
        $this->product->setParamsBeforeAddToCartProduct();
        //Your plugin code

        return [];
    }
}