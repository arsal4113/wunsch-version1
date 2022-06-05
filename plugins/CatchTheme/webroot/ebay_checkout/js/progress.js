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
