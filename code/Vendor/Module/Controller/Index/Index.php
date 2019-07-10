<?php

namespace Vendor\Module\Controller\Index;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;

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

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->pageFactory = $pageFactory;
        $this->productCollectionFactory = $productFactory;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        if ($this->getRequest()->isAjax()) {

            $test = $this->getRequest()->getPost();
            $array = (array)$test;
            $keys = array_keys($array);
            foreach ($keys as $key) {
                return $this->productCollectionFactory->addAttributeToFilter('sku', array('like' => $key . '%'));
            }

            return $result->setData($test);
        }

        return $this->pageFactory->create();
    }
}
