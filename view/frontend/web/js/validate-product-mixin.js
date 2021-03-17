define([
    'jquery',
    'mage/translate'
], function ($, $t) {
    'use strict';

    var widgetMixin = {
        _create: function () {
            if (!window.magenable || !window.magenable.purchasePartnerUrls) {
                return this._super();
            }

            var productId = this.element.find('[name="product"]').val();
            var partnerUrl = window.magenable.purchasePartnerUrls[productId];

            if (partnerUrl) {
                $(this.options.addToCartButtonSelector).text(
                    $t('Purchase From Partner')
                ).attr('disabled', false);
                this.element.on('submit', function (e) {
                    e.preventDefault();
                    location.href = partnerUrl;
                });
            } else {
                return this._super();
            }
        }
    };

    return function (targetWidget) {
        $.widget('mage.productValidate', targetWidget, widgetMixin);

        return $.mage.productValidate;
    };
});