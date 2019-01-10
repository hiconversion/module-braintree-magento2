<?php

namespace Magento\Braintree\Block\Hic;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use Magento\Braintree\Helper\HicHelper;

/**
 * Class MiniCartTestData
 */
class MiniCartTestData extends Template
{

    /**
     * @var \Magento\Braintree\Helper\HicHelper
     */
    private $helper;


    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        HicHelper $helper,
        array $data = []
    ) {
        $this->helper = $helper;

        parent::__construct($context, $data);
    }

    /**
     * is paypal express test enabled
     *
     * @return boolean
     */
    public function isPaypalExpressTestEnabled()
    {
        return $this->helper->isMiniCartPaypalExpressTestEnabled();
    }

    /**
     * is paypal express disabled
     *
     * @return boolean
     */
    public function isPaypalExpressDisabled()
    {
        return $this->helper->isMiniCartPaypalExpressDisabled();
    }

    /**
     * is paypal credit test enabled
     *
     * @return boolean
     */
    public function isPaypalCreditTestEnabled()
    {
        return $this->helper->isMiniCartPaypalCreditTestEnabled();
    }
    
    /**
     * is paypal credit disabled
     *
     * @return boolean
     */
    public function isPaypalCreditDisabled()
    {
        return $this->helper->isMiniCartPaypalCreditDisabled();
    }

    /**
     * is apple pay test enabled
     *
     * @return boolean
     */
    public function isApplePayTestEnabled()
    {
        return $this->helper->isMiniCartApplePayTestEnabled();
    }

    /**
     * is apple pay disabled
     *
     * @return boolean
     */
    public function isApplePayDisabled()
    {
        return $this->helper->isMiniCartApplePayDisabled();
    }

    /**
     * is google pay test enabled
     *
     * @return boolean
     */
    public function isGooglePayTestEnabled()
    {
        return $this->helper->isMiniCartGooglePayTestEnabled();
    }

    /**
     * is google pay disabled
     *
     * @return boolean
     */
    public function isGooglePayDisabled()
    {
        return $this->helper->isMiniCartGooglePayDisabled();
    }
}
