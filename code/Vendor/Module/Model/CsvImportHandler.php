<?php

namespace Vendor\Module\Model;

use Zend_Debug;

class CsvImportHandler
{
    /**
     * CSV Processor
     *
     * @var \Magento\Framework\File\Csv
     */
    protected $csvProcessor;

    public function __construct(
        \Magento\Framework\File\Csv $csvProcessor
    )
    {
        $this->csvProcessor = $csvProcessor;
    }
    public function importFromCsvFile($file)
    {
        if (!isset($file['tmp_name'])) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Invalid file upload attempt.'));
        }
        $importProductRawData = $this->csvProcessor->getData($file['tmp_name']);
        $arrayProduct = [];
        foreach ($importProductRawData as $indexRow => $dataRow) {
            array_push($arrayProduct, $dataRow);
        }
    }
}