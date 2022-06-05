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
