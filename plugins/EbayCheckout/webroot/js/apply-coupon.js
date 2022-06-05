$.widget('iways.apply_coupon', $.iways.checkout, {
    options: {
        saveUrl: '',
        submitButton: '',
    },
    _create: function () {
        this._super();
        this.submitButton = $(this.options.submitButton);
        var self = this;
        this.submitButton.click(
            function (e) {
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
        $.ajax(
            this.options.saveUrl,
            {
                'method': 'POST',
                'data': form.serialize(),
                'success': function (data) {
                    if (data.error) {
                        self.enable();
                        self.showError(data.error);
                        return;
                    }
                    self.disable();
                    self.getItemWrapper().item_wrapper("refresh");
                    self.getTotals().totals("refresh");
                    self.getPayment().payment("enable");

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
        this.startLoading();
        this.getTotals().totals("disable");
        this.element.addClass("enabled");
        var self = this;
        $.ajax(
            this.options.getUrl
        ).done(
            function (data) {
                self.element.parent().html(data);
                self.stopLoading();

            }
        );
    },
    disable: function () {
    }
});
