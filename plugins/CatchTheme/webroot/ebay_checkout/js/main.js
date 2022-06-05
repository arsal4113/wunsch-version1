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
;
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
;
$.widget('iways.shipping_address', $.iways.checkout, {
    options: {
        getUrl: '',
        saveUrl: '',
        state: true,
        addressProvided: false,
        submitButton: '',
        editButton: '',
        addressBlock: '',
        addressForm: ''
    },
    _create: function () {
        this._super();
        this.submitButton = $(this.options.submitButton);
        this.editButton = $(this.options.editButton);
        this.addressProvided = this.options.addressProvided;
        var self = this;
        this.element.find('#form-close-row').click(
            function(e) {
                $('body').removeClass('no-scroll');
                self.element.removeClass('form-shown');
            }
        );
        this.submitButton.click(
            function(e) {
                if (document.getElementById(self.element.find('form').attr('id')).checkValidity() === true) {
                    e.preventDefault();
                    e.stopPropagation();
                    self.save();
                }
            }
        );
        this.editButton.click(
            function(e) {
                e.preventDefault();
                self.enable();
                $('.payment-arrow').hide();
            }
        );
        $(document).ready(function () {
            console.log("document is ready!");
            console.log("address is provided:", self.addressProvided);
            console.log(self.addressProvided);
            if(self.addressProvided){
                self.getPayment().payment("enable");
                self.getApplyCoupon().apply_coupon("enable");
                self.scrollTo(self.getApplyCoupon().apply_coupon("getElement"));
                self.renderRoverPixel(self.options.doneRoverPixel);
            }
        });
    },
    save: function (data) {
        var self = this;
        var form = this.element.find('form');
        self.getTotals().totals("setCheckbox", $('#marketing_consent').is(":checked"), $('#catch-marketing_consent').is(":checked"));
        self.startLoading();
        $.ajax(
            this.options.saveUrl,
            {
                'method': 'POST',
                'data': form.serialize(),
                'success' : function (data) {
                    if (data.error) {
                        self.enable();
                        self.showError(data.error);
                        self.scrollTo(self.element);
                        self.stopLoading();
                        return;
                    }
                    self.element.addClass('address-entered');
                    self.element.removeClass('form-shown');
                    $('body').removeClass('no-scroll');
                    self.disable();
                    self.getItemWrapper().item_wrapper("refresh");
                    self.getTotals().totals("refresh");
                    self.getPayment().payment("enable");
                    self.getApplyCoupon().apply_coupon("enable");
                    self.scrollTo(self.getPayment().payment("getElement"));
                    self.scrollTo(self.getApplyCoupon().apply_coupon("getElement"));
                    self.renderRoverPixel(self.options.doneRoverPixel);
                },
                'error': function (data) {
                    self.showError(data.statusText);
                    self.scrollTo(self.element);
                    self.stopLoading();
                },
                'complete': function (data) {
                }
            }
        );
    },
    enable: function () {
        this.removeError();
        this.element.removeClass('address-entered');
        this.element.find(this.options.addressBlock).hide();
        this.element.find(this.options.addressForm).show();
        this.getPayment().payment("disable");
        this.getTotals().totals("disable");
        //this.getApplyCoupon().apply_coupon("disable");
        this.setTotalsInfo();
        this.getProgressWrapper().progress("updateProgressDelivery");

    },
    disable: function () {
        this.removeError();
        var addressForm = this.element.find(this.options.addressForm);
        var addressBlock = this.element.find(this.options.addressBlock);
        $(addressForm).find('input, select, textarea').each(
            function(index){
                var input = $(this);
                if(this.nodeName == "SELECT") {
                    addressBlock.find('span#' + input.attr('name')).html(input.find("option:selected").text());
                }else if(input.attr('name') !== 'country') {
                    addressBlock.find('span#' + input.attr('name')).html(input.val());
                }
            }
        );
        addressForm.hide();
        addressBlock.show();
    }
});
;
$.widget('iways.payment', $.iways.checkout, {
    options: {
        saveUrl: '',
        state: false,
        getUrl: '',
        addressBlock: '',
        addressForm: '',
        editButton: ''
    },
    _create: function () {
        this._super();
        var self = this;
        this.editButton = $(this.options.editButton);
        this.editButton.click(
            function (e) {
                e.preventDefault();
                self.showEditForm();
            }
        );
        window.paymentState = this.options.state;
        this.element.find('#form-close-row').click(
            function (e) {
                self.element.removeClass('form-shown');
                $('body').removeClass('no-scroll');
            }
        );
        this.element.find('.payment-method-title-row').each(
            function () {
                $(this).click(
                    function (e) {
                        var row = e.target;
                        if (
                            self.element.hasClass("disabled")
                            && window.paymentState
                        ) {
                            self.enable();
                        }
                        if (self.element.hasClass("enabled")) {
                            var paymentMethodType = $(row).closest(".payment-method-title-row").data("payment-method-type");
                            self.element.find('.payment-method.payment-method-selected').removeClass('payment-method-selected');
                            self.element.find('.payment-method.' + paymentMethodType).addClass('payment-method-selected');
                        }
                    });
            }
        );
    },
    save: function (method, data) {
        var self = this;
        self.startLoading();
        var formData = new FormData(document.querySelector('#payment-method-' + method));
        formData = objectToFormData(data, formData, 'additionalData');
        $.ajax(
            this.options.saveUrl,
            {
                'method': 'POST',
                'data': formData,
                'contentType': false,
                'processData': false,
                'success': function (data) {
                    self.stopLoading();
                    if (data.error) {
                        window.paymentState = false;
                        self.showError(data.error, method);
                        return;
                    }
                    self.element.removeClass('form-shown');
                    $('body').removeClass('no-scroll');
                    window.paymentState = true;
                    self.getTotals().totals("enable");
                    self.scrollTo(self.getTotals().totals('getElement'));
                    self.disable();
                    self.getTotals().totals("setText", "");
                    self.getPayment().addClass('payment-entered');
                    self.element.find('.payment-method-title-row').addClass("pointer").click(
                        function (e) {
                            var target = e.target;
                            if (
                                self.element.hasClass("disabled")
                                && window.paymentState
                            ) {
                                self.enable();
                            }
                        }
                    );
                    self.renderRoverPixel(self.options.doneRoverPixel);
                    pandata.paymentOption = method;
                    self.scrollTo(self.getTotals().totals('getElement'));
                },
                'error': function (data) {
                    window.paymentState = false;
                    self.showError(data.statusText, method);
                }
            }
        );
    },
    enable: function () {
        this.startLoading();
        this.getTotals().totals("disable");
        this.getProgressWrapper().progress("updateProgressPayment");
        this.element.find('.payment-method-success-info').html("");
        this.element.removeClass("disabled");
        this.element.removeClass('payment-entered');
        this.element.addClass("enabled");
        window.paymentState = false;
        var formShown = this.element.hasClass('form-shown');
        var self = this;
        self.setTotalsInfo();
        if (!window.paymentState) {
            $.ajax(
                this.options.getUrl
            ).done(
                function (data) {
                    self.element.parent().html(data);
                    window.paymentState = false;
                    if (formShown) {
                        $('body').addClass('no-scroll');
                        self.getPayment().addClass('form-shown');
                    } else {
                        $('body').removeClass('no-scroll');
                    }
                }
            );
        }
    },
    disable: function () {
        this.removeError();
        this.element.addClass("disabled");
        this.element.removeClass("enabled");
        this.element.removeClass("payment-entered");
        this.element.find(".payment-method-body").html("");
        //this.element.find(".payment-method:not(.payment-method-selected)").html("");
        this.element.find('.payment-method-title-row').removeClass("pointer").unbind("click");
        this.element.find(".border-box").addClass("no-body");
    },
    showEditForm: function () {
        this.getTotals().totals("disable");
        this.element.find(this.options.addressForm).show();
        this.element.find(this.options.addressBlock).hide();
    },
    getState: function () {
        return window.paymentState;
    },
    showError: function (message, method) {
        this.removeError();
        if (typeof method !== "undefined") {
            var errorContainer = this.element.find("." + method +" " +this.options.errorContainer);
        } else {
            var errorContainer = this.element.find(this.options.errorContainer);
        }

        if($.type(message) == "string") {
            errorContainer.show().html($('<div class="row"><div class="col error-message">' + message + '</div></div>'));
        } else {
            errorContainer.show()
            $.each(message, function(index, msg) {
                errorContainer.append($('<div class="row"><div class="col error-message">' + msg + '</div></div>'));
            });
        }

        // additional pandata tracking
        push2dataLayer({
            'event': 'paymentError',
            'paymentMethod': method,
            'errorMessage': message
        });
    },
});
;
$.widget('iways.totals', $.iways.checkout, {
    options: {
        getUrl: '',
        submitButton: '',
        submitUrl: '',
        successUrl: '',
        stepInfoElement: '.step-info',
        ebayCheck: false,
        catchCheck: false,
        paymentStepCallback: function () {
        }
    },
    _create: function () {
        this._super();

        this.submitButton = $(this.options.submitButton);
        this.stepInfoElement = $(this.options.stepInfoElement);
        if (typeof window.statusInfo != 'undefined') {
            this.setText(window.statusInfo);
        }
        if (window.paymentState) {
            this.enable();
        }
        var self = this;
        this.element.find('.legal-messages input[required]').click(
            function (e) {
                self.enable();
            }
        );
        this.submitButton.click(
            function () {
                self.submit();
            }
        );
        this.stopLoading();
    },
    enable: function () {
        this.getProgressWrapper().progress("updateProgressTotals");
        var acceptedAll = true;
        $.each(this.element.find('.legal-messages input[required]'), function (key, object) {
                if (!$(object).prop("checked")) {
                    acceptedAll = false;
                }
            }
        );
        if (acceptedAll === true) {
            if (window.paymentState) {
                this.element.find(this.options.submitButton).removeAttr("disabled");
                this.element.find('.button-wrapper').removeClass("disabled");
                this.options.paymentStepCallback();
            }
        } else {
            this.disable();
        }
    },
    disable: function () {
        this.element.find(this.options.submitButton).attr("disabled", "disabled");
        this.element.find('.button-wrapper').addClass("disabled");
    },
    refresh: function () {
        var self = this;
        window.statusInfo = self.element.find(self.options.stepInfoElement).html();
        self.startLoading();
        $.ajax(
            this.options.getUrl
        ).done(
            function (data) {
                self.element.parent().html(data);
                if (window.paymentState) {
                    self.enable();
                }
                if(self.options.ebayCheck){
                    $('#marketing_consent').attr('checked','checked');
                }
                if(self.options.catchCheck){
                    $('#catch-marketing_consent').attr('checked', 'checked');
                }
            }
        );
    },
    setText: function (text) {
        window.statusInfo = text;
        this.stepInfoElement.html(text);
    },
    setCheckbox: function (ebay, catchCheck) {
        this.options.ebayCheck = ebay;
        this.options.catchCheck = catchCheck;
    },
    submit: function () {
        var self = this;
        self.startLoading();
        var formData = new FormData();
        formData.append("success", this.options.successUrl);
        $.each(this.element.find('.legal-messages input[required]'), function (key, object) {
                formData.append("legalMessage[" + $(object).attr("name") + "]", $(object).prop("checked"));
            }
        );
        formData.append('marketingConsent', $('#marketing_consent').prop("checked"));
        formData.append('catchMarketingConsent', $('#catch-marketing_consent').prop("checked"));
        $.ajax(
            this.options.submitUrl,
            {
                'method': 'POST',
                'data': formData,
                'contentType': false,
                'processData': false,
                'success': function (data) {
                    if (data.error) {
                        $('body').children('div.loader').remove();
                        self.showError(data.error);
                        return;
                    }

                    if (data.redirectUrl == self.options.successUrl) {

                        if ($('#marketing_consent').prop('checked')) {
                            // pandata GTM tracking helper
                        	push2dataLayer({
                                'event': 'newsletter',
                                'newsletterAction': 'Requested',
                                'newsletterLabel': 'checkout'
                            });
                        }

                        window.location.href = data.redirectUrl;
                    } else {
                        location.reload();
                    }
                },
                'error': function (data) {
                    self.showError(data.statusText);
                    self.stopLoading();
                }
            }
        );
    }
});
;
$.widget('iways.progress', $.iways.checkout, {
    _create: function () {
        this._super();
    },
    updateProgressDelivery: function() {
        this.updateWidget(1);
    },
    updateProgressPayment: function () {
        this.updateWidget(2);
    },
    updateProgressTotals: function () {
        this.updateWidget(3);
    },
    updateWidget: function (index) {
        var element = this.element;
        if(index === 1){
            element.find('.second-part').removeClass('done').addClass('active');
            element.find('.third-part').removeClass('done active').addClass('outstanding');
            element.find('.fourth-part').removeClass('active').addClass('outstanding');
            element.find('.first-message').show();
            element.find('.second-message, .third-message').hide();
            element.find('.second.connector, .third.connector').removeClass("active");
        }else if(index === 2){
            element.find('.second-part').removeClass('active').addClass('done');
            element.find('.third-part').removeClass('outstanding done').addClass('active');
            element.find('.fourth-part').removeClass('active').addClass('outstanding');
            element.find('.second-message').show();
            element.find('.first-message, .third-message').hide();
            element.find('.second.connector').addClass("active");
            element.find('.third.connector').removeClass("active");
        }else if(index === 3){
            element.find('.third-part').removeClass('active outstanding').addClass('done');
            element.find('.fourth-part').removeClass('outstanding').addClass('active');
            element.find('.first-message, .second-message').hide();
            element.find('.third-message').show();
            element.find('.third.connector').addClass("active");
        }
    }
});
;
$.widget('iways.apply_coupon', $.iways.checkout, {
    options: {
        saveUrl: '',
        getUrl: '',
        submitButton: '',
    },
    _create: function () {
        this._super();
        this.submitButton = $(this.options.submitButton);
        var self = this;
        this.submitButton.click(
            function(e) {
                if (document.getElementById(self.element.find('form').attr('id')).checkValidity() === true) {
                    e.preventDefault();
                    e.stopPropagation();
                    self.save();
                }
            }
        );
    },
    save: function (data) {
        var self = this;
        var form = this.element.find('form');
        self.startLoading();
        self.getPayment().payment("startLoading");
        $.ajax(
            this.options.saveUrl,
            {
                'method': 'POST',
                'data': form.serialize(),
                'success' : function (data) {
                    if (data.error) {
                        self.showError(data.error);
                        return;
                    }
                    self.removeError();
                    if (self.element.find("input[type=text]").val()) {
                        self.submitButton.addClass("success");
                        self.element.find("input[type=text]").data('code', self.element.find("input[type=text]").val());
                        self.submitButton.html(self.submitButton.data("success-text"));
                        self.scrollTo(self.getPayment("getElement"));
                    } else {
                        self.submitButton.removeClass("success");
                        self.element.find("input[type=text]").data('code', self.element.find("input[type=text]").val());
                        self.submitButton.html(self.submitButton.data("submit-text"));
                    }
                },
                'error': function (data) {
                    self.showError(data.statusText);
                },
                'complete': function (data) {
                    self.stopLoading();
                    self.getPayment().payment("enable");
                    self.getTotals().totals("refresh");
                }
            }
        );
    },
    enable: function () {
        this.element.find("#apply-coupon-disabled").hide();
        this.element.find("#apply-coupon-form-row").show();
        //this.element.find("input[type=text]").val("");
        if(this.element.find("input[type=text]").data('code')) {
            this.submitButton.addClass("success");
            this.submitButton.html(this.submitButton.data("success-text"));
        } else {
            this.submitButton.removeClass("success");
            this.submitButton.html(this.submitButton.data("submit-text"));
        }

        this.removeError();
    },
    disable: function () {
        this.element.find("#apply-coupon-disabled").show();
        this.element.find("#apply-coupon-form-row").hide();
        this.removeError();
    }
});
