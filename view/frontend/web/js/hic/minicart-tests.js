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
                var style = testCore.applyCss('#minicart-content-wrapper .paypal.checkout:not(.paypal-bml) {display:none;}');
                testCore.addToApi('minicart', 'paypal', testCore.createRemoveFn(style));
            }

            if (config.paypalCreditState === 'test') {
                var style = testCore.applyCss('#minicart-content-wrapper .paypal-bml.checkout {display:none;}');
                testCore.addToApi('minicart', 'paypalCredit', testCore.createRemoveFn(style));
            }

            if (config.applePayState === 'test') {
                var style = testCore.applyCss('#minicart-content-wrapper .applepay-minicart {display:none;}');
                testCore.addToApi('minicart', 'applePay', testCore.createRemoveFn(style));
            }

            if (config.googlePayState === 'test') {
                var style = testCore.applyCss('#minicart-content-wrapper .googlepay-minicart-logo {display:none;}');
                testCore.addToApi('minicart', 'googlePay', testCore.createRemoveFn(style));
            }
        }
    };
});