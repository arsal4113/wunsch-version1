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
        this.element.find('.widget-title').click(
            function(e) {
                if(self.getShippingAddress().hasClass('address-entered')){
                    $('body').addClass('no-scroll');
                    self.element.addClass('form-shown');
                    if (
                        self.element.hasClass("disabled")
                        && window.paymentState
                    ) {
                        self.enable();
                    }
                }
            }
        );
        this.element.find('#form-close-row').click(
            function(e) {
                self.element.removeClass('form-shown');
                $('body').removeClass('no-scroll');
            }
        );
        this.element.click(
            function(e) {
                if(window.matchMedia('(max-width: 768px)').matches && self.element.hasClass('payment-entered') && !self.element.hasClass('form-shown')) {
                    self.enable();
                    self.element.addClass('form-shown');
                    $('body').addClass('no-scroll');
                }
            }
        );
        this.element.find('.payment-method-title-row').click(
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
                        self.showError(data.error);
                        return;
                    }
                    self.element.removeClass('form-shown');
                    $('body').removeClass('no-scroll');
                    window.paymentState = true;
                    self.getTotals().totals("enable");
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
                },
                'error': function (data) {
                    window.paymentState = false;
                    self.showError(data.statusText);
                }
            }
        );
    },
    enable: function () {
        this.startLoading();
        this.getTotals().totals("disable");
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
                    if(formShown) {
                        $('body').addClass('no-scroll');
                        self.getPayment().addClass('form-shown');
                    } else {
                        $('body').removeClass('no-scroll');
                    }
                    self.stopLoading();

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
        this.element.find('.payment-method-title-row').removeClass("pointer").unbind("click");
    },
    showEditForm: function () {
        this.getTotals().totals("disable");
        this.element.find(this.options.addressForm).show();
        this.element.find(this.options.addressBlock).hide();
    },
    getState: function () {
        return window.paymentState;
    }
});
