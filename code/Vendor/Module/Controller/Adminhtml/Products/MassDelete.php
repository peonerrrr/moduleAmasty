<?php

namespace Vendor\Module\Controller\Adminhtml\Products;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Vendor\Module\Model\ItemFactory;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, ItemFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $select = $this->getRequest()->getPost('selected');
        $collection = $this->collectionFactory->create()->getCollection();
        $count = 0;
        foreach ($collection as $item) {
            if($select[$count] == $item->getId()){
                $count++;
                $deleteItem = $this->_objectManager->get('Vendor\Module\Model\Item')->load($item->getId());
                $deleteItem->delete();
            }
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $count + 1));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}