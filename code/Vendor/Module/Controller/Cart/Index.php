<?php

namespace Vendor\Module\Controller\Cart;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Vendor\Module\Model\Product;
use Vendor\Module\Model\ItemFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $pageFactory;
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;
    /**
     * @var Product
     */
    protected $model;
    /**
     * @var ItemFactory
     */
    private $itemFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        Product $model,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productFactory,
        ItemFactory $itemFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->pageFactory = $pageFactory;
        $this->model = $model;
        $this->productCollectionFactory = $productFactory;
        parent::__construct($context);
        $this->itemFactory = $itemFactory;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $item = $this->itemFactory->create();
//        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//        $resource = $objectManager->create('Vendor\Module\Model\Item');
        $this->model->setParamsBeforeAddToCartProduct($item);
        return $this->pageFactory->create();
    }
}
