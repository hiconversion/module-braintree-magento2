<?php
/**
 * HiConversion
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * [http://opensource.org/licenses/MIT]
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @Copyright © 2015 HiConversion, Inc. All rights reserved.
 * @license [http://opensource.org/licenses/MIT] MIT License
 */

namespace Magento\Braintree\Helper;

use Magento\Braintree\Model\Hic\Data;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ProductMetadata;
use Magento\Store\Model\ScopeInterface;

/**
 * Integration data helper
 *
 * @author HiConversion <support@hiconversion.com>
 */
class HicHelper extends AbstractHelper
{

    const CONFIG_BASE = 'hiconversion/configuration/';
    const KEY_ENABLED = 'enabled';
    const KEY_SITE_ID = 'site_id';
    const KEY_BN_CODE = 'bn_code';
    const KEY_TEST_CART_PAYPAL_EXPRESS = 'test_cart_paypal';
    const KEY_TEST_CART_PAYPAL_CREDIT = 'test_cart_paypal_credit';
    const KEY_TEST_CART_APPLE_PAY = 'test_cart_apple_pay';
    const KEY_TEST_CART_GOOGLE_PAY = 'test_cart_google_pay';
    const KEY_TEST_MINICART_PAYPAL_EXPRESS = 'test_minicart_paypal';
    const KEY_TEST_MINICART_PAYPAL_CREDIT = 'test_minicart_paypal_credit';
    const KEY_TEST_MINICART_APPLE_PAY = 'test_minicart_apple_pay';
    const KEY_TEST_MINICART_GOOGLE_PAY = 'test_minicart_google_pay';

    /**
     * @var Data
     */
    private $hicModel;

    /**
     * @var ProductMetadata
     */
    private $productMetadata;

    /**
     * @param Context $context
     * @param Data $hicModel
     * @param ProductMetadata $productMetadata
     */
    public function __construct(
        Context $context,
        Data $hicModel,
        ProductMetadata $productMetadata
    ) {
        $this->hicModel = $hicModel;
        $this->productMetadata = $productMetadata;
        parent::__construct($context);
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getConfigValue($field)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_BASE . $field,
            ScopeInterface::SCOPE_STORE
        );
    }

  
    /**
     * Returns Site ID from Configuration
     *
     * @return string
     */
    public function getSiteId()
    {
        return $this->getConfigValue(self::KEY_SITE_ID);
    }

    /**
     * Returns BN Code from Configuration
     *
     * @return string
     */
    public function getBNCode()
    {
        return $this->getConfigValue(self::KEY_BN_CODE);
    }

    /**
     * Determines if module is enabled or not
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->getConfigValue(self::KEY_ENABLED);
    }

    /**
     * cart paypal express test state
     *
     * @return string
     */
    public function getTestCartPaypalExpressState()
    {
        return $this->getConfigValue(self::KEY_TEST_CART_PAYPAL_EXPRESS);
    }

     /**
     * cart paypal credit test state
     *
     * @return string
     */
    public function getTestCartPaypalCreditState()
    {
        return $this->getConfigValue(self::KEY_TEST_CART_PAYPAL_CREDIT);
    }

     /**
     * cart applePay test state
     *
     * @return string
     */
    public function getTestCartApplePayState()
    {
        return $this->getConfigValue(self::KEY_TEST_CART_APPLE_PAY);
    }

     /**
     * cart googlePay test state
     *
     * @return string
     */
    public function getTestCartGooglePayState()
    {
        return $this->getConfigValue(self::KEY_TEST_CART_GOOGLE_PAY);
    }

      /**
     * minicart paypal express test state
     *
     * @return string
     */
    public function getTestMiniCartPaypalExpressState()
    {
        return $this->getConfigValue(self::KEY_TEST_MINICART_PAYPAL_EXPRESS);
    }

     /**
     * minicart paypal credit test state
     *
     * @return string
     */
    public function getTestMiniCartPaypalCreditState()
    {
        return $this->getConfigValue(self::KEY_TEST_MINICART_PAYPAL_CREDIT);
    }

     /**
     * minicart applePay test state
     *
     * @return string
     */
    public function getTestMiniCartApplePayState()
    {
        return $this->getConfigValue(self::KEY_TEST_MINICART_APPLE_PAY);
    }

     /**
     * minicart googlePay test state
     * @return string
     */
    public function getTestMiniCartGooglePayState()
    {
        return $this->getConfigValue(self::KEY_TEST_MINICART_GOOGLE_PAY);
    }


    /**
     * Returns Url with Site ID from Configuration included
     *
     * @return string
     */
    public function getDeployUrl()
    {
        return '//h30-deploy.hiconversion.com/origin/tag/' . $this->getSiteId();
    }


    /**
     * Returns Magento Version
     *
     * @return string
     */
    public function getMageVersion()
    {
        return $this->productMetadata->getVersion();
    }

    /**
     * Returns Magento Edition
     *
     * @return string
     */
    public function getMageEdition()
    {
        return $this->productMetadata->getEdition();
    }

    /**
     * Returns Data that can be cached relative to a page
     * currently page and product data
     * @return object
     */
    public function getPageData()
    {
        if ($this->hicModel->isProduct()) {
            $this->hicModel->populateProductData();
        }

        $this->hicModel->populatePageData();

        return $this->hicModel;
    }
    
    /**
     * Returns Cart Data
     * @return object
     */
    public function getCartData()
    {
        $this->hicModel->populateCartData();

        return $this->hicModel->getData('cart');
    }

    /**
     * Returns user data
     * @return object
     */
    public function getUserData()
    {
        $this->hicModel->populateUserData();

        return $this->hicModel->getData('user');
    }

    /**
     * Returns order data
     * @return object
     */
    public function getOrderData()
    {
        if ($this->hicModel->isConfirmation()) {
            $this->hicModel->populateOrderData();
        }

        return $this->hicModel;
    }
}
