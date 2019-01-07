<?php

namespace Magento\Braintree\Block\Hic;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use Magento\Braintree\Helper\HicHelper;

/**
 * Class CartTests
 */
class CartTests extends Template
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

    public function getPaypalExpressState()
    {
        return $this->helper->getTestCartPaypalExpressState();
    }

    public function getPaypalCreditState()
    {
        return $this->helper->getTestCartPaypalCreditState();
    }

    public function getApplePayState()
    {
        return $this->helper->getTestCartApplePayState();
    }

    public function getGooglePayState()
    {
        return $this->helper->getTestCartGooglePayState();
    }
}
