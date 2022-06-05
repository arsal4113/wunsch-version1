$.widget('iways.mini_cart', $.iways.checkout, {
    options: {
        errorContainer: '.error-message-row',
        totals: '.totals-widget',
        payment: '.payment-widget',
        item_wrapper: '.item-widget-wrapper',
        shipping_address: '.shipping-address-widget',
        totalsInfo: ''

    },
    loader: '<div class="loader"></div>',
    invalidate: function () {

    },
    refresh: function () {

    },
    removeItem: function () {

    },
    toggle: function () {

    }
});
