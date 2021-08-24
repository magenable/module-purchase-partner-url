define(['jquery', 'domReady!'], function ($) {
    'use strict';

    var defined = false;

    return function(analitycsIsEnabled) {
        if (defined) {
            return false;
        }
        defined = true;
        $('.magenable-purchase-partner-url').on('click', function(e){
            var $button = $(e.currentTarget);
            if (analitycsIsEnabled && window.ga) {
                ga(
                    'send',
                    {
                        hitType: 'event',
                        eventCategory: $button.data('event-category'),
                        eventAction: $button.data('event-action'),
                        eventLabel: $button.data('link'),
                        eventValue: $button.data('event-value')
                    }
                );
            }

            document.location = $button.data('link');
        });
    }
});
