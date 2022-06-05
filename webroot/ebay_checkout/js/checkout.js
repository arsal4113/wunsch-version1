var objectToFormData = function (obj, form, namespace) {

    var fd = form || new FormData();
    var formKey;

    for (var property in obj) {
        if (obj.hasOwnProperty(property)) {
            if (namespace) {
                formKey = namespace + '[' + property + ']';
            } else {
                formKey = property;
            }

            if (typeof obj[property] === 'object' && !(obj[property] instanceof File)) {
                objectToFormData(obj[property], fd, formKey);
            } else {
                fd.append(formKey, obj[property]);
            }

        }
    }
    return fd;
};


$.widget('iways.checkout', {
    options: {
        errorContainer: '.error-message-row',
        totals: '.totals-widget',
        payment: '.payment-widget',
        item_wrapper: '.item-widget-wrapper',
        shipping_address: '.shipping-address-widget',
        totalsInfo: ''

    },
    loader: '<div class="loader"></div>',

    _create: function () {
        this.errorContainer = this.element.find(this.options.errorContainer);
    },
    getPayment: function () {
        return $(this.options.payment);
    },
    getTotals: function () {
        return $(this.options.totals);
    },
    getItemWrapper: function () {
        return $(this.options.item_wrapper);
    },
    getShippingAddress: function () {
        return $(this.options.shipping_address);
    },
    startLoading: function () {
        if (!this.element.find('.widget-body > .loader').length) {
            this.element.find('.widget-body').prepend(this.loader);
            this.element.addClass('loading');
        }
    },
    stopLoading: function () {
        this.element.find('.loader').remove();
        this.element.removeClass('loading');
    },
    showError: function (message) {
        this.removeError();
        if($.type(message) == "string") {
            this.errorContainer.show().html($('<div class="row"><div class="col error-message">' + message + '</div></div>'));
        } else {
            var self = this;
            self.errorContainer.show()
            $.each(message, function(index, msg) {
                self.errorContainer.append($('<div class="row"><div class="col error-message">' + msg + '</div></div>'));
            });
        }
    },
    removeError: function () {
        this.errorContainer.find(".error-message").remove();
    },
    setTotalsInfo: function () {
        this.getTotals().totals('setText', this.options.totalsInfo);
    },
    renderRoverPixel: function (url) {
        this.element.prepend($('<img src="'+url+'" style="display: none;" />'));
    }
});