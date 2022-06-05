(function ($) {
    $.fn.wishlistify = function (options) {
        var defaults = {
            heartCount: 7,
            heartTravelDistance: 80,
            animationDuration: 2500,
            itemCountSpanClass: '.wishlist-item-count'
        };
        var settings = $.extend({}, defaults, options);
        var self = this;
        var wishlistify = {
            this: self,
            settings: settings,
            init: function () {
                wishlistify.this.filter("a").each(function () {
                    $(this).click(function (e) {
                        e.stopImmediatePropagation();
                        e.preventDefault();
                        var url, newCssClass, oldCssClass, link = $(this), type;
                        if (link.hasClass('add')) {
                            url = link.data('href-add');
                            type = 'add';
                            oldCssClass = 'add';
                            newCssClass = 'remove';
                        } else {
                            url = link.data('href-remove');
                            type = 'remove';
                            oldCssClass = 'remove';
                            newCssClass = 'add';
                        }

                        var wishlistIcon = link.find('.wishlist-icon');
                        var clone = $(this).closest('.surprise-item.card').clone();
                        try {
                            $('#register-wishlist-item-id').val('');
                        } catch (e) {
                            console.error(e);
                        }

                        // animation ahead..
                        if (!link.hasClass('no-animation') && (!$('body').hasClass('wishlist') || (typeof catcher.wishlistIsEmpty !== 'undefined' && catcher.wishlistIsEmpty))) {
                            wishlistIcon.addClass('engorgio');
                            setTimeout(function () {
                                wishlistIcon.removeClass('engorgio').addClass('reducio');
                                for (var i = 0; i < settings.heartCount; i++) {
                                    var heart = $('<div class="heart-animation heart-' + i + ' ' + oldCssClass + '"></div>');
                                    link.append(heart);
                                    heart.animate({
                                        right: "+=" + Math.round((Math.random() * (settings.heartTravelDistance * 2)) - settings.heartTravelDistance),
                                        top: "+=" + Math.round((Math.random() * (settings.heartTravelDistance * 2)) - settings.heartTravelDistance),
                                        opacity: 0
                                    }, settings.animationDuration, "easeOutCubic", function () {
                                        $(this).remove();
                                    });
                                }
                            }, 500);
                            setTimeout(function () {
                                wishlistIcon.removeClass('reducio');
                            }, 700);
                        }

                        if (window.userLogedIn) {
                            $.ajax(
                                {
                                    'url': url,
                                    'method': 'GET',
                                    'success': function (data) {
                                        try {
                                            if (data.response.redirect) {
                                                window.location = data.response.redirect;
                                                return;
                                            }
                                            if (data.response.success) {
                                            	window.localStorage.setItem('pandata_wishlist_added_product_name', data.response.item_name);
                                                window.localStorage.setItem('pandata_wishlist_added_product_sku', data.response.item_sku);
                                                window.localStorage.setItem('pandata_wishlist_added_product_category', link.data('category-id'));
                                                if (link.hasClass('add')) {
                                                    pushEcommerce('addToWishlist'
                                                    		     + (link.hasClass('from-minicart')
                                              		             ? 'FromMiniCart'
                                                    		     : ''), null);
                                                }
                                                else {
                                                	pushEcommerce('removeFromWishlist'
                                               		             + (link.hasClass('from-minicart')
                                      		                     ? 'FromMiniCart'
                                            		             : ''), null);
                                                }

                                                wishlistify.handleItemCount(type);
                                                link.addClass(newCssClass).removeClass(oldCssClass);
                                                wishlistIcon.addClass(newCssClass).removeClass(oldCssClass);
                                                if (typeof window.reloadAfterWishlistAdd !== 'undefined' && window.reloadAfterWishlistAdd) {
                                                    //window.location.reload();
                                                    var cloneIcon = clone.find('.wishlist-icon'),
                                                        cloneLink = clone.find('.wishlist-item-link');
                                                    setTimeout(function () {
                                                        $('#empty-wishlist').slideUp('slow');
                                                        $('#surprise-item-headline').hide();
                                                        $('#surprise-item-row').hide();
                                                        $('#wishlist-items-container').show();
                                                        $('.browse-row').html('<div class="col-6 col-md-4 browse-col"></div>');
                                                        clone.removeClass('surprise-item');
                                                        clone.find('a.surprise-item-link').removeClass('surprise-item-link');
                                                        clone.find('.deals-badge').remove();
                                                        cloneIcon.removeClass('add');
                                                        cloneIcon.addClass('remove');
                                                        cloneLink.removeClass('add');
                                                        cloneLink.addClass('remove');
                                                        cloneLink.attr('href', cloneLink.data('href-remove'));
                                                        cloneLink.attr('data-category-id', 'WishList');
                                                        console.log(cloneLink.data('category-id'));
                                                        clone.appendTo('.browse-col');
                                                    }, 1000);
                                                }
                                                if (typeof window.reloadAfterWishlistRemove !== 'undefined' && window.reloadAfterWishlistRemove) {
                                                    if (wishlistIcon.hasClass('add')) {
                                                        wishlistIcon.append('<div class="removed-text"><p>Entfernt</p><a>Wieder hinzufügen</a></div>');
                                                    } else {
                                                        var removeOverlay = wishlistIcon.find('.removed-text');
                                                        if (removeOverlay !== undefined) {
                                                            removeOverlay.remove();
                                                        }
                                                    }
                                                    if ($(wishlistify.settings.itemCountSpanClass).data('count') === 0) {
                                                        /*setTimeout(function () {
                                                            //window.location.reload();
                                                        }, 1000);*/
                                                        console.log('last Item will be removed');
                                                    }
                                                }
                                            }
                                        } catch (e) {
                                            console.log(e);
                                        }
                                    },
                                    'error': function () {
                                        console.log('Wishlist error');
                                    }
                                }
                            );
                        } else {
                            if ($('.to-many-items-alert') && $('.to-many-items-alert').children().length) {
                                $('.wishlist-popup-alert').fadeOut(500);
                            }
                            $('#wishlist').trigger('click');
                            try {
                                $('#register-wishlist-item-id').val(link.data('item-id'));
                            } catch (e) {
                                console.error(e);
                            }

                            window.userLoginCallback = function () {
                                $.ajax(
                                    {
                                        'url': url,
                                        'method': 'GET',
                                        'success': function (data) {
                                            try {
                                                if (data.response.redirect) {
                                                    window.location = data.response.redirect;
                                                    return;
                                                }
                                                if (data.response.success) {
                                                    link.addClass(newCssClass).removeClass(oldCssClass);
                                                    wishlistIcon.addClass(newCssClass).removeClass(oldCssClass);
                                                }
                                            } catch (e) {
                                                console.log(e);
                                            }
                                        },
                                        'error': function () {
                                            console.log('Wishlist error');
                                        }
                                    }
                                );
                            }
                        }
                        if (link.parent('.links-box').length) { // then we are in the minicart, we need to refresh it..
                        	if (link.hasClass('add')) {
                        		$('.mini-cart-wrapper').data('iways-mini_cart').softRefresh(3512);
                        		link.parent('.links-box').siblings('.wishlist-box').slideDown(256).delay(3000).slideUp(256);
                        	} else {
                        		$('.mini-cart-wrapper').data('iways-mini_cart').softRefresh();
                        	}
                        }
                    });
                });
            },
            handleItemCount: function (type) {
                if ($(wishlistify.settings.itemCountSpanClass).length) {
                    var itemCount = $(wishlistify.settings.itemCountSpanClass).data('count');
                    if (type === 'add') {
                        itemCount++;
                    } else {
                        itemCount--;
                    }
                    this.showItemCount(itemCount);
                }
            },
            showItemCount: function (itemCount) {
                try {
                    var visualItemCount;
                    if (itemCount < 100) {
                        visualItemCount = itemCount;
                        if($(wishlistify.settings.itemCountSpanClass).hasClass('three-digit')) {
                            $(wishlistify.settings.itemCountSpanClass).removeClass('three-digit');
                        }
                    } else {
                        visualItemCount = '99+';
                        if(!$(wishlistify.settings.itemCountSpanClass).hasClass('three-digit')) {
                            $(wishlistify.settings.itemCountSpanClass).addClass('three-digit');
                        }
                    }
                    $(wishlistify.settings.itemCountSpanClass).data('count', itemCount);
                    $(wishlistify.settings.itemCountSpanClass).html(visualItemCount);
                    if (itemCount < 1) {
                        $(wishlistify.settings.itemCountSpanClass).hide();
                        $(wishlistify.settings.itemCountSpanClass).data('count', 0);
                    } else {
                        $(wishlistify.settings.itemCountSpanClass).show();
                    }

                } catch (e) {
                    console.log(e);
                }
            }
        };
        wishlistify.init();
        return wishlistify;
    };
}(jQuery));

(function ($) {
    $(function () {

        if (typeof catcher.wishlistIsEmpty !== 'undefined' && catcher.wishlistIsEmpty) {
            $('#wishlist-items-container').hide();
        } else {
            $('#wishlist-items-container').show();
        }
        $('.wishlist-item-link').wishlistify();
    });
})(jQuery);

