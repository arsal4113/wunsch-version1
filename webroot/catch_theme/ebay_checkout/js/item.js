$.widget('iways.item_wrapper', $.iways.checkout, {
    options: {
        getUrl: ''
    },
    _create: function () {
        this._super();
    },
    refresh: function () {
        var self = this;
        self.startLoading();
        $.ajax(
            this.options.getUrl
        ).done(
            function(data) {
                self.element.parent().html(data);
                self.stopLoading();
            }
        );
    }
});

$.widget('iways.item', $.iways.checkout, {
    options: {
        saveQtyUrl: '',
        saveShippingUrl: '',
        itemId: ''
    },
    _create: function () {
        this._super();
        var self = this;
        this.element.find('select[name=qty]').change(
            function(e) {
                self.updateQty($(e.target), $(e.target).val())
            }
        );
        this.element.find('.shipping-options-wrapper input[type=radio]').click(
            function(e) {
                self.updateShipping($(e.target), $(e.target).val())
            }
        );
    },
    updateQty: function(element, qty) {
        var self = this;
        this.getTotals().totals("startLoading");
        self.startLoadingOnAllItems();
        var formData = new FormData();
        $(element).attr("disabled", "disabled");
        formData.append('itemId', self.options.itemId);
        formData.append('qty', qty);
        $.ajax(
            this.options.saveQtyUrl,
            {
                'method': 'POST',
                'data': formData,
                'processData': false,
                'contentType': false,
                'success' : function (data) {
                    if(data.error) {
                        self.showError(data.error)
                        $(element).removeAttr("disabled");
                        self.stopLoadingOnAllItems();
                        return;
                    }
                    self.removeError();
                    $(element).removeAttr("disabled");
                    self.checkPayment();
                    self.getTotals().totals("refresh");
                    self.refreshAllItems();
                },
                'error': function (data) {
                    self.showError(data.statusText)
                    $(element).removeAttr("disabled");
                    self.stopLoadingOnAllItems();
                }
            }
        );
    },
    updateShipping: function(element, shippingId) {
        var self = this;
        self.getTotals().totals("setCheckbox", $('#marketing_consent').is(":checked"), $('#catch-marketing_consent').is(":checked"));
        this.getTotals().totals("startLoading");
        self.startLoadingOnAllItems();
        var formData = new FormData();
        formData.append('itemId', self.options.itemId);
        formData.append('shippingId', shippingId);
        $.ajax(
            this.options.saveShippingUrl,
            {
                'method': 'POST',
                'data': formData,
                'contentType': false,
                'processData': false,
                'success' : function (data) {
                    if(data.error) {
                        self.showError(data.error);
                        self.stopLoadingOnAllItems();
                        return;
                    }
                    self.removeError();
                    self.checkPayment();
                    self.getTotals().totals("refresh");
                    self.refreshAllItems();
                    self.checkPayment();
                },
                'error': function (data) {
                    self.showError(data.statusText);
                    self.stopLoadingOnAllItems();
                }
            }
        );
    },
    refreshAllItems: function() {
        $('.item-widget-wrapper').item_wrapper("refresh");
    },
    startLoadingOnAllItems: function () {

        $('.item-widget-wrapper').item_wrapper("startLoading");
    },
    stopLoadingOnAllItems: function () {
        $('.item-widget-wrapper').item_wrapper("stopLoading");
    },
    checkPayment: function () {
        var shipping_address = this.getShippingAddress().shipping_address("getElement");
        if (!shipping_address.hasClass('address-entered')) {
            this.getShippingAddress().shipping_address("enable");
        } else {
            this.getPayment().payment("enable");
            //this.getApplyCoupon().apply_coupon("enable");
        }
    }
});
