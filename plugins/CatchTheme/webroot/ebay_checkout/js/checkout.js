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
        apply_coupon: '.apply-coupon-widget',
        progress_wrapper: '.progress-widget',
        totalsInfo: ''

    },
    loader: '<div class="loader"><div class="animated-loader"><span>Loading...</span></div></div>',
    scrollDisabled: false,
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
    getProgressWrapper:function () {
        return $(this.options.progress_wrapper);
    },
    getApplyCoupon:function () {
        return $(this.options.apply_coupon);
    },
    startLoading: function () {
        if(!$('.content-area').find('.loader').length){
            $('.content-area').prepend(this.loader);
            this.element.addClass('loading');
        }
    },
    stopLoading: function () {
        this.element.removeClass('loading');
        if(!$('.loading').length) {
            $('.content-area').find('.loader').remove();
        }
    },
    showError: function (message) {
        this.removeError();
        if($.type(message) == "string") {
            this.errorContainer.show().html($('<div class="row"><div class="col error-message">' + message + '</div></div>'));
        } else {
            var self = this;
            self.errorContainer.show();
            $.each(message, function(index, msg) {
                self.errorContainer.append($('<div class="row"><div class="col error-message">' + msg + '</div></div>'));
            });
        }

        // additional pandata tracking
        push2dataLayer({
            'event': 'addressError',
            'errorMessage': message
        });
    },
    removeError: function () {
        this.errorContainer.find(".error-message").remove();
    },
    setTotalsInfo: function () {
        this.getTotals().totals('setText', this.options.totalsInfo);
    },
    renderRoverPixel: function (url) {
        this.element.prepend($('<img src="'+url+'" style="display: none;" />'));
    },
    scrollTo: function (element, time) {
        if (this.scrollDisabled) {
            return
        }
        time = (typeof time !== 'undefined') ?  time : 350;
        var progressHeight = $(window).width() < 1024 ? $('.progress-widget').height() : 0;
        $([document.documentElement, document.body]).animate({
            scrollTop: $(element).offset().top - $("#header").height() - 20 - progressHeight
        }, time);

    },
    disableScroll: function() {
      this.scrollDisabled = true;
    },
    enableScroll: function() {
        this.scrollDisabled = false;
    },
    getElement : function() {
        return this.element;
    }
});
