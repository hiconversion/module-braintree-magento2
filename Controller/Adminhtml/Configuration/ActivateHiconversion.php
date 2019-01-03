<?php

namespace Magento\Braintree\Controller\Adminhtml\Configuration;

use Magento\Braintree\Model\Hic\HicApi;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class ActivateHiconversion
 */
class ActivateHiconversion extends \Magento\Backend\App\Action
{
    
    private $logger;

    /**
     * @var \Magento\Framework\App\Config\Storage\WriterInterface;
     */
    private $configWriter;

    /**
     * @var Magento\Braintree\Model\Hic\HicApi;
     */
    private $hicApi;

    /**
     * Validate constructor.
     *
     * @param Action\Context  $context
     * @param WriterInterface $configWriter
     * @param HicApi $hicApi
     */
    public function __construct(
        Action\Context $context,
        WriterInterface $configWriter,
        HicApi $hicApi,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->configWriter = $configWriter;
        $this->hicApi = $hicApi;

        $this->logger = $logger;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $request = $this->getRequest();
        $siteUrl = $request->getParam("site_url");
        $email = $request->getParam("email");
        $pw = $request->getParam("password");
        $storeId = $request->getParam("storeId", 0);

        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        try {
            $result = $this->hicApi->activateHicAccount($siteUrl, $email, $pw, $storeId);

            $this->logger->debug("HIC SIGNUP RESULTS:" . print_r($result, true));
            
            if (isset($result) && isset($result['result']) == "success") {
                $siteId = $this->hicApi->getHicSiteId($siteUrl, $email);

                if (isset($siteId)) {
                    $this->configWriter->
                        save(
                            'hiconversion/configuration/site_id',
                            $siteId,
                            ScopeConfigInterface::SCOPE_TYPE_DEFAULT
                        );

                       $response->setData($siteId);
                }

                $response->setHttpResponseCode(200);
            } else {
                $response->setData($result);
                $response->setHttpResponseCode(400);
            }
        } catch (\Exception $e) {
            $response->setHttpResponseCode(400);
        }

        return $response;
    }
}
