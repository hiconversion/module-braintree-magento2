<?php

namespace Magento\Braintree\Block\GooglePay\Shortcut;

use Magento\Braintree\Block\GooglePay\AbstractButton;
use Magento\Checkout\Model\Session;
use Magento\Catalog\Block\ShortcutInterface;
use Magento\Checkout\Model\DefaultConfigProvider;
use Magento\Framework\View\Element\Template\Context;
use Magento\Payment\Model\MethodInterface;

/**
 * Class Button
 * @package Magento\Braintree\Model\GooglePay\Shortcut
 * @author Aidan Threadgold <aidan@gene.co.uk>
 */
class Button extends AbstractButton implements ShortcutInterface
{
    const ALIAS_ELEMENT_INDEX = 'alias';

    const BUTTON_ELEMENT_INDEX = 'button_id';

    /**
     * @var DefaultConfigProvider
     */
    private $defaultConfigProvider;

    /**
     * Button constructor.
     * @param Context $context
     * @param Session $checkoutSession
     * @param MethodInterface $payment
     * @param \Magento\Braintree\Model\GooglePay\Auth $auth
     * @param DefaultConfigProvider $defaultConfigProvider
     * @param array $data
     */
    public function __construct(
        Context $context,
        Session $checkoutSession,
        MethodInterface $payment,
        \Magento\Braintree\Model\GooglePay\Auth $auth,
        DefaultConfigProvider $defaultConfigProvider,
        array $data = []
    ) {
        parent::__construct($context, $checkoutSession, $payment, $auth, $data);
        $this->defaultConfigProvider = $defaultConfigProvider;
    }

    /**
     * @inheritdoc
     */
    public function getAlias()
    {
        return $this->getData(self::ALIAS_ELEMENT_INDEX);
    }

    /**
     * @return string
     */
    public function getContainerId()
    {
        return $this->getData(self::BUTTON_ELEMENT_INDEX);
    }
}
