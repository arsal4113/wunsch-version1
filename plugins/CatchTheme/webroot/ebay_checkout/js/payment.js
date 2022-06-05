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
