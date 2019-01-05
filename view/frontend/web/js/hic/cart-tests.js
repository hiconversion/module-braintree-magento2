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
          html: '&shy;<style>' + rule + '</style>'
        }).appendTo("body");    
      }

    return function (config) {

        if (config) {
            if (config.testCartPaypalExpressState === 'test') {
                var style = injectStyles('.cart-summary .paypal.checkout {display:none;}' );
                window.braintreeHicApi = window.braintreeHicApi || {};
                window.braintreeHicApi.testCartPaypal = function() {
                    style.remove();
                };
            }
        }
    };
});