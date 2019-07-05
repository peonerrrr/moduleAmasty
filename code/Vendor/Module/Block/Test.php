<?php
namespace Vendor\Module\Block;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\Product;

class Test extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_messageManager;
    protected $formKey;
    protected $cart;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        FormKey $formKey,
        Cart $cart,
        array $data = []
    )
    {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_messageManager = $messageManager;
        $this->formKey = $formKey;
        $this->cart = $cart;
        parent::__construct($context, $data);
    }



    public function getProductSku()
    {
        $sku = $this->getRequest()->getPost('sku');

        $products = $this->_productCollectionFactory->create();
        $products->addAttributeToSelect('sku');

        $message = 'Не существует товара с таким SKU';



        foreach ($products as $product){
            if ($sku == $product->getData('sku')){

                $params = array(
                    'form_key' => $this->formKey->getFormKey(),
                    'product' => $product->getData('entity_id'),
                    'qty'   =>1
                );

                $this->cart->addProduct($product, $params);
                $this->cart->save();

                return 'true';
            }
        }
        return $this->_messageManager->addError($message);
    }

}
?>