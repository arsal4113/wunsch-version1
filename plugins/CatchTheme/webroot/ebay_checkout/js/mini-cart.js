$.widget('iways.mini_cart', {
    options: {
        toggler: '#mini-cart-icon',
        container: '#mini-cart-container',
        loginContainer: '#user-content .burger-wrapper .row.menu-account .container',
        loginMessage: '',
        checkoutUrl: '',
        guestButtonText: '',
        itemDeleteMessage: 'Do you really want to remove that item?',
        cartLoader: '.mini-cart-loader',
        refreshUrl: false,
        itemRemoveMessageTime: 1000,
        logoUrl: '',
        logoUrlNotScrolled: ''
    },
    _create: function () {
        this._super();
        var self = this,
            leaveIcon = false,
            leaveMiniCart = false;
        $(this.options.toggler).on('click mouseover', function (e) {
            var clicked = (e.type === "click");
            leaveIcon = false;
            leaveMiniCart = false;
            if(catcher.isMobile && !clicked) return;
            if ($(this).data('checkout-url') && !catcher.isMobile && clicked) {
                window.location.href = $(this).data('checkout-url');
            } else if ($(window).width() <= 1024 && $(this).data('cart-url') && clicked) {
                window.location.href = $(this).data('cart-url');
            } else {
                if(clicked) {
                    self.toggle();
                } else {
                    self.show();
                }
            }
        });
        $(this.options.toggler).on('mouseout', function () {
            leaveIcon = true;
            if (leaveIcon && leaveMiniCart) {
                self.hide();
            }
        });
        $('#mini-cart-container').on('mouseleave', function() {
            leaveMiniCart = true;
            if (leaveIcon && leaveMiniCart) {
                self.hide();
            }
        });
        $('body #user-account').on('click mouseover', function (e) {
            var container = $(self.options.container);
            var toggler = $(self.options.toggler);
            if (!container.is(e.target) && container.has(e.target).length === 0 && !toggler.is(e.target) && toggler.has(e.target).length === 0) {
                if (self.element.hasClass('shown')) {
                    self.hide();
                }
            }
        });
        $('body').click(function (e) {
            var container = $(self.options.container);
            var toggler = $(self.options.toggler);
            if (!container.is(e.target) && container.has(e.target).length === 0 && !toggler.is(e.target) && toggler.has(e.target).length === 0) {
                if (self.element.hasClass('shown')) {
                    self.hide();
                }
            }
        });

        /*this.element.find('a.mini-cart-item-remove').click(function (e) { // this was the old version, before softDelete..
            e.preventDefault();
            if (window.confirm(self.options.itemDeleteMessage)) {
                self.removeItem(this);
            }

        });*/

        this.element.find('a.delete-item, a.undelete-item').on('click', function (e) {
            e.preventDefault();
            self.deleteUndeleteItem(this);
        });
    },
    toggle: function () {
        if (this.element.hasClass('hidden')) {
            this.show();
        } else {
            this.hide();
        }
    },
    show: function () {
        $('#header').addClass('mini-cart-shown');
        this.element.addClass('shown').removeClass('hidden');
        $(this.options.toggler).addClass("shown");
        $('#mini-cart-background').show();
        $('#search-switch').hide();
    },
    hide: function () {
        $('#header').removeClass('mini-cart-shown');
        this.element.addClass('hidden').removeClass('shown');
        $(this.options.toggler).removeClass("shown");
        $('#mini-cart-background').hide();
        $('#search-switch').show();
    },
    toggleLoader: function (displayLoader) {
        if (displayLoader) {
            $(this.options.cartLoader).show();
        } else {
            $(this.options.cartLoader).hide();
        }
    },
    deleteUndeleteItem: function (element) {console.log(element);
        var self = this;
        if (this.options.refreshUrl) {
            $.ajax({
                'url': $(element).attr('href'),
                'success': function (data) {
                    if (typeof data.response.success != "undefined") {
                        if (typeof data.response.message != "undefined") {
                            self.softRefresh();
                            $(document).trigger('ebay_checkout_cart_removed_item_' + $(element).data('item-id'));
                        }
                    }
                }
            });
        }
    },
    refresh: function (showAfterRefresh = false) {
        var self = this;
        if (this.options.refreshUrl) {
            $.ajax({
                'url': this.options.refreshUrl,
                'success': function (data) {
                    $('.mini-cart-container').replaceWith(data);
                    if(showAfterRefresh) self.show();
                    self.toggleLoader(false);
                    if ($(window).width() > 767) {
                        $('.mini-cart-wrapper').addClass('shown').removeClass('hidden');
                    }
                    self.refreshItemCount();
                }
            });
        }
    },
    softRefresh: function (delay = null) {
        var self = this,
            delay = delay ? delay : self.options.itemRemoveMessageTime;
        setTimeout($.proxy(self.refresh, self), delay);
    },
    refreshItemCount: function () {
        var itemCount = $('.mini-cart-item-row').length;
        if (itemCount) {
            if ($('#mini-cart-icon .item-count').length) {
                $('#mini-cart-icon .item-count').html(itemCount);
            } else {
                $('#mini-cart-icon').append($('<span class="item-count">' + itemCount + '</span>'));
            }
        } else {
            $('#mini-cart-icon .item-count').remove();
        }
    }
});
