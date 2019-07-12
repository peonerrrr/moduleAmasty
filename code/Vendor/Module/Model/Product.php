<?php

namespace Vendor\Module\Model;

use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;



class Product extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var FormKey
     */
    protected $formKey;
    /**
     * @var Cart
     */
    protected $cart;
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;
    /**
     * @var Http
     */
    protected $request;
    /**
     * @var ManagerInterface
     */
    protected $message;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;
    /**
     * @var CsvImportHandler
     */
    protected $import;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Vendor\Module\Model\CsvImportHandler $import,
        Cart $cart,
        FormKey $formKey,
        Http $request,
        ManagerInterface $message,
        array $data = [],
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null
    ) {
        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->import = $import;
        $this->message = $message;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->request = $request;
        $this->productRepository = $productRepository;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * setParamsBeforeAddToCartProduct
     */
    public function setParamsBeforeAddToCartProduct($resource)
    {
        if($this->request->getPost('sku')) {
            $sku = $this->request->getPost('sku');
            $url = $this->request->getPost('url');
            try {
                $product = $this->productRepository->get($sku);
                $idProduct = $product->getId();
                $productType = $product->getTypeId();

                if ($productType == 'simple') {
                    $params = [
                        'product' => $idProduct,
                        'qty' => 1
                    ];
                    if($url != ''){
                        $resource->setName($sku);
                        $resource->save();
                    }
                    $this->request->setParams($params);
                } else {
                    $this->message->addWarningMessage(__("Warning"));
                    $this->request->setParam('product', null);
                }
            } catch (\Exception $e) {
                $this->message->addErrorMessage(__("Error"));
            }
        }
    }

    /**
     * getCollectionProducts
     */
    public function getCollectionProducts()
    {
        $sku = $this->request->getPost('sku');
        $this->productCollectionFactory->addAttributeToFilter('sku', array('like' => $sku . '%'));
    }

    /**
     * importProductToCart
     */
    public function importProductToCart()
    {
        $file = $this->request->getFiles('csv');
        $arrayImportProduct = $this->import->importFromCsvFile($file);
        array_shift($arrayImportProduct);
        foreach ($arrayImportProduct as $item) {
            try {
                $product = $this->productRepository->get($item[0]);
                $idProduct = $product->getId();
                $productType = $product->getTypeId();

                if ($productType == 'simple') {
                    $params = [
                        'product' => $idProduct,
                        'qty' => $item[1]
                    ];
                    $this->cart->addProduct($product, $params);
                    $this->message->addSuccessMessage(__($item[0] . ' Товар добавлен в карзину, в количестве: ' . $item[1]));

                } else {
                    $this->message->addWarningMessage(__("Warning"));
                    $this->request->setParam('product', null);
                }
            } catch (\Exception $e) {
                $this->message->addErrorMessage(__($item[0] . ' Такого товара нет'));
            }
        }
        $this->cart->save();
    }

    /**
     * addProductMyTable
     */
}
