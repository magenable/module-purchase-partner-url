(function () {
    'use strict';

    // declare widget that can be used later
    $.widget('purchasePartnerUrl', {
        component: 'Magenable_PurchasePartnerUrl/js/google-analytics',
        create: function () {
            let { analitycsIsEnabled, isOpenLinkInNewTab } = this.options

            $('.product-item-purchase-partner > button').on('click', function(e){
                $(e.currentTarget.nextElementSibling).toggleClass('hidden');
            });

            $('.product-item-purchase-partner').on('mouseleave', function(e){
                $(e.currentTarget).find('.magenable-purchase-partner-urls-wrapper').addClass('hidden');
            });

            $('.magenable-purchase-partner-url').on('click onchange', function(e){
                var $element = $(e.currentTarget);
                if ($element.prop('tagName').toUpperCase() == 'SELECT') {
                    $element = $element.find('option:selected');
                }
                if (!$element.data('link')) {
                    return false;
                }
                $('body').trigger('processStart');

                if (analitycsIsEnabled && window.ga) {
                    ga(
                        'send',
                        {
                            hitType: 'event',
                            eventCategory: $element.data('event-category'),
                            eventAction: $element.data('event-action'),
                            eventLabel: $element.data('link'),
                            eventValue: $element.data('event-value')
                        }
                    );
                }

                if (isOpenLinkInNewTab) {
                    window.open(
                        $element.data('link'),
                        '_blank'
                    ).focus();
                    $('body').trigger('processStop');
                } else {
                    document.location = $element.data('link');
                }

                e.preventDefault();
            });
        }
    });
})();
