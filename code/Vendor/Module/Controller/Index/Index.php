<?php
namespace Vendor\Module\Controller\Index;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_product;
    protected $resultJsonFactory;
    protected $_productCollectionFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productFactory,
        \Vendor\Module\Model\Product $product
    )
    {
        $this->_product = $product;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_pageFactory = $pageFactory;
        $this->_productCollectionFactory = $productFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        if ($this->getRequest()->isAjax())
        {

            $test = $this->getRequest()->getPost();
            $array =  (array) $test;
            $keys = array_keys($array);
            foreach ($keys as $key){
                return $this->_productCollectionFactory->addAttributeToFilter('sku', array('like' => $key.'%'));
            }
               return $result->setData($test);
        }
        return $this->_pageFactory->create();
    }
}
