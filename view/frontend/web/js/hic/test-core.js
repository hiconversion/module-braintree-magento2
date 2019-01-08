/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'jquery',
], function ($) {
    'use strict';

    return {
        applyCss: function (text) {
            var styleSheet = document.createElement('style');
            document.getElementsByTagName('head')[0].appendChild(styleSheet);
            if (styleSheet.styleSheet) {
                // ie case
                styleSheet.styleSheet.cssText = text;
            } else {
                styleSheet.appendChild(document.createTextNode(text));
            }
            return $(styleSheet);
        },

        addToApi: function (testLocation, testName, fn) {
            window.braintreeHicApi = window.braintreeHicApi || {};
            window.braintreeHicApi[testLocation] = window.braintreeHicApi[testLocation] || {};
            window.braintreeHicApi[testLocation][testName] = fn;
        },

        createRemoveFn: function (style) {
            return function () {
                style.remove();
            }
        }
    }
});