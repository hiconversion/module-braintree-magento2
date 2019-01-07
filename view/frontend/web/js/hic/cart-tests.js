/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'jquery',
], function ($) {
    'use strict';

    function injectStyles(rule) {
        return $("<div />", {
            html: '<style>' + rule + '</style>'
        }).appendTo("body");
    }

    function applyCss(text) {
        var styleSheet = document.createElement('style');
        document.getElementsByTagName('head')[0].appendChild(styleSheet);
        if (styleSheet.styleSheet) {
            // ie case
            styleSheet.styleSheet.cssText = text;
        } else {
            styleSheet.appendChild(document.createTextNode(text));
        }
        return $(styleSheet);
    }

    function addToApi(testLocation, testName, fn) {
        window.braintreeHicApi = window.braintreeHicApi || {};
        window.braintreeHicApi[testLocation] = window.braintreeHicApi[testLocation] || {};
        window.braintreeHicApi[testLocation][testName] = fn;
    }

    function createRemoveFn(style) {
        return function() {
            style.remove();
        }
    }

    return function (config) {

        if (config) {
            if (config.paypalExpressState === 'test') {
                var style = applyCss('.cart-summary .paypal.checkout:not(.paypal-bml) {display:none;}');
                addToApi('cart', 'paypal', createRemoveFn(style));
            }

            if (config.paypalCreditState === 'test') {
                var style = applyCss('.cart-summary .paypal-bml.checkout {display:none;}');
                addToApi('cart', 'paypalCredit', createRemoveFn(style));
            }

            if (config.applePayState === 'test') {
                var style = applyCss('.cart-summary .applepay-minicart {display:none;}');
                addToApi('cart', 'applePay', createRemoveFn(style));
            }

            if (config.googlePayState === 'test') {
                var style = applyCss('.cart-summary .googlepay-minicart-logo {display:none;}');
                addToApi('cart', 'googlePay', createRemoveFn(style));
            }
        }
    };
});