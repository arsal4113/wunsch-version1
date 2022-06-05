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
