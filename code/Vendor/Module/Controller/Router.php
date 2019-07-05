<?php
namespace Vendor\Module\Controller;

use Vendor\Module\Helper\Data;

class Router implements \Magento\Framework\App\RouterInterface
{
    protected $actionFactory;
    protected $_response;
    protected $helperData;
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\ResponseInterface $response,
        Data $helperData
    ) {
        $this->actionFactory = $actionFactory;
        $this->_response = $response;
        $this->helperData = $helperData;
    }
    public function match(\Magento\Framework\App\RequestInterface $request)
    {

        $url = $this->helperData->getGeneralConfig('custom_url');
        $identifier = trim($request->getPathInfo(), '/');


        if($identifier == $url
        && $request->getModuleName() != 'vendormodule') {

            $request->setModuleName('vendormodule')-> //module name
            setControllerName('index')-> //controller name
            setActionName('index'); //action name


        } else {
            return false;
        }

        return $this->actionFactory->create(
            'Magento\Framework\App\Action\Forward',
            ['request' => $request]
        );

    }
}