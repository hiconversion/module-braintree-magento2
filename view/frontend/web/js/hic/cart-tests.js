/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'jquery',
    'Magento_Braintree/js/hic/test-core'
], function ($, testCore) {
    'use strict';

    return function (config) {

        if (config) {
            if (config.paypalExpressState === 'test') {
                var style = testCore.applyCss('.cart-summary .paypal.checkout:not(.paypal-bml) {display:none;}');
                testCore.addToApi('cart', 'paypal', testCore.createRemoveFn(style));
            }

            if (config.paypalCreditState === 'test') {
                var style = testCore.applyCss('.cart-summary .paypal-bml.checkout {display:none;}');
                testCore.addToApi('cart', 'paypalCredit', testCore.createRemoveFn(style));
            }

            if (config.applePayState === 'test') {
                var style = testCore.applyCss('.cart-summary .applepay-minicart {display:none;}');
                testCore.addToApi('cart', 'applePay', testCore.createRemoveFn(style));
            }

            if (config.googlePayState === 'test') {
                var style = testCore.applyCss('.cart-summary .googlepay-minicart-logo {display:none;}');
                testCore.addToApi('cart', 'googlePay', testCore.createRemoveFn(style));
            }
        }
    };
});