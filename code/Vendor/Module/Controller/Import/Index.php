<?php
namespace Vendor\Module\Controller\Import;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_product;
    protected $_import;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Vendor\Module\Model\CsvImportHandler $import
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_import = $import;
        return parent::__construct($context);
    }

    public function execute()
    {
        $file = $this->getRequest()->getFiles('csv');
        $arrayImportProduct = $this->_import->importFromCsvFile($file);
        return $this->_pageFactory->create();
    }
}
