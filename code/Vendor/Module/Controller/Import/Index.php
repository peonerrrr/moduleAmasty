<?php
namespace Vendor\Module\Controller\Import;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Vendor\Module\Model\Product;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    /**
     * @var Product
     */
    protected $_product;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param Product $product
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        Product $product
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_product = $product;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->_product->importProductToCart();
        return $this->_pageFactory->create();
    }
}
