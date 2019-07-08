<?php
namespace Vendor\Module\Model;

use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;


class Product extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{

    protected $formKey;
    protected $cart;
    protected $productRepository;
    protected $request;
    protected $message;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        Cart $cart,
        FormKey $formKey,
        Http $request,
        ManagerInterface $message,
        array $data = []
    )
    {
        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->message = $message;
        $this->request = $request;
        $this->productRepository = $productRepository;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }


    public function setParamsBeforeAddToCartProduct()
    {
        $sku = $this->request->getPost('sku');
        try{
            $product = $this->productRepository->get($sku);
            $idProduct = $product->getId();

            $productType = $product->getTypeId();

            if($productType == 'simple'){
                $params = [
                    'product' => $idProduct,
                    'qty' => 1
                ];
                $this->request->setParams($params);
            }else {
                $this->message->addWarningMessage(__("Warning"));
                $this->request->setParam('product', null);
            }
        } catch (\Exception $e){
            $this->message->addErrorMessage(__("Error"));
        }
    }
    public function getCollectionProducts()
    {
        echo 'dasfas';
    }
}
