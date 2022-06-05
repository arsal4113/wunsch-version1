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
