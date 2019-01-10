<?php

namespace Magento\Braintree\Block\Hic;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use Magento\Braintree\Helper\HicHelper;

/**
 * Class CartTestData
 */
class CartTestData extends Template
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
        return $this->helper->isCartPaypalExpressTestEnabled();
    }

    /**
     * is paypal express disabled
     *
     * @return boolean
     */
    public function isPaypalExpressDisabled()
    {
        return $this->helper->isCartPaypalExpressDisabled();
    }

    /**
     * is paypal credit test enabled
     *
     * @return boolean
     */
    public function isPaypalCreditTestEnabled()
    {
        return $this->helper->isCartPaypalCreditTestEnabled();
    }
    
    /**
     * is paypal credit disabled
     *
     * @return boolean
     */
    public function isPaypalCreditDisabled()
    {
        return $this->helper->isCartPaypalCreditDisabled();
    }

    /**
     * is apple pay test enabled
     *
     * @return boolean
     */
    public function isApplePayTestEnabled()
    {
        return $this->helper->isCartApplePayTestEnabled();
    }

    /**
     * is apple pay disabled
     *
     * @return boolean
     */
    public function isApplePayDisabled()
    {
        return $this->helper->isCartApplePayDisabled();
    }

    /**
     * is google pay test enabled
     *
     * @return boolean
     */
    public function isGooglePayTestEnabled()
    {
        return $this->helper->isCartGooglePayTestEnabled();
    }

    /**
     * is google pay disabled
     *
     * @return boolean
     */
    public function isGooglePayDisabled()
    {
        return $this->helper->isCartGooglePayDisabled();
    }
}
