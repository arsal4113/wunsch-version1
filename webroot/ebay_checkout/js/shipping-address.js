$.widget('iways.shipping_address', $.iways.checkout, {
    options: {
        getUrl: '',
        saveUrl: '',
        state: true,
        submitButton: '',
        editButton: '',
        addressBlock: '',
        addressForm: '',
    },
    _create: function () {
        this._super();
        this.submitButton = $(this.options.submitButton);
        this.editButton = $(this.options.editButton);
        var self = this;
        this.element.find('.widget-title').click(
            function(e) {
                if(window.matchMedia('(max-width: 768px)').matches) {
                    $('body').addClass('no-scroll');
                    self.element.addClass('form-shown');
                    self.getPayment().payment("disable");
                }
            }
        );
        this.element.find('#form-close-row').click(
            function(e) {
                $('body').removeClass('no-scroll');
                self.element.removeClass('form-shown');
            }
        );
        this.element.click(
            function(e) {
                if(window.matchMedia('(max-width: 768px)').matches && self.element.hasClass('address-entered') && !self.element.hasClass('form-shown')) {
                    self.enable();
                    $('body').addClass('no-scroll');
                    self.element.addClass('form-shown');
                }
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
            }
        );
    },
    save: function (data) {
        var self = this;
        var form = this.element.find('form');
        self.startLoading();
        $.ajax(
            this.options.saveUrl,
            {
                'method': 'POST',
                'data': form.serialize(),
                'success' : function (data) {
                    if (data.error) {
                        self.enable();
                        self.showError(data.error);return;
                    }
                    self.element.addClass('address-entered');
                    self.element.removeClass('form-shown');
                    $('body').removeClass('no-scroll');
                    self.disable();
                    self.getItemWrapper().item_wrapper("refresh");
                    self.getTotals().totals("refresh");
                    self.getPayment().payment("enable");
                    self.renderRoverPixel(self.options.doneRoverPixel);

                },
                'error': function (data) {
                    self.showError(data.statusText);
                },
                'complete': function (data) {
                    self.stopLoading();
                }
            }
        )
        ;
    },
    enable: function () {
        this.removeError();
        this.element.removeClass('address-entered')
        this.element.find(this.options.addressBlock).hide();
        this.element.find(this.options.addressForm).show();
        this.getPayment().payment("disable");
        this.getTotals().totals("disable");
        this.setTotalsInfo();
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
                }else {
                    addressBlock.find('span#' + input.attr('name')).html(input.val());
                }
            }
        );
        addressForm.hide();
        addressBlock.show();
    }
});
