<?php

namespace Magento\Braintree\Block\Hic;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

use Magento\Braintree\Helper\HicHelper;

/**
 * Class MiniCartTests
 */
class MiniCartTests extends Template
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
        return $this->helper->getTestMiniCartPaypalExpressState();
    }

    public function getPaypalCreditState()
    {
        return $this->helper->getTestMiniCartPaypalCreditState();
    }

    public function getApplePayState()
    {
        return $this->helper->getTestMiniCartApplePayState();
    }

    public function getGooglePayState()
    {
        return $this->helper->getTestMiniCartGooglePayState();
    }
}
