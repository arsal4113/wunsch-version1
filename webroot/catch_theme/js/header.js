(function ($) {
    $.fn.header = function (options) {
        var defaults = $.extend({
            header_height: 40,
            complete_header_height: 71,
            header_elements: '#header',
            category_navigation: '#navigation-container',
            searchSwitch: '#search-switch',
            searchShown: false,
            minicartShown: false,
            minicartClicked: false,
            scroll_top: 0,
            actual_scroll: 0,
            stop_event: false,
            cycleDelay: 4000,
            cycleAnimationDelay: 500
        });

        var settings = $.extend({}, defaults, options);

        var header = {
            init: function () {
                settings.scroll_top = settings.actual_scroll = $(window).scrollTop();
                var navigation = $('#customer-segment-row');
                if (navigation.length) {
                    var navigation_offset = navigation.offset();
                    settings.navigation_bottom_threshold = navigation_offset.top + navigation.height() - 95; // because of orange-message-container..
                } else {
                    settings.navigation_bottom_threshold = settings.complete_header_height;
                }
                settings.sliderHeight = $('#bubble-banner').height();
                if ($('.search-wrapper').is(':visible')) {
                    settings.searchShown = true;
                    header.handleResize();
                }
                $(window).on('scroll resize reload', function () {
                    header.checkScroll();
                    header.handleOrangeMessage();
                    header.handleHeaderSize();
                    settings.sliderHeight = $('#bubble-banner').height();

                    if ($('#orange-message-container').length) {
                        var orangeHeight = $('#orange-message-container').height(),
                            scrollTop = $(document).scrollTop();

                        if (scrollTop >= orangeHeight) {
                            scrollTop = orangeHeight;
                        }

                        if (scrollTop < 0) scrollTop = 0;
                        if ($(window).width() > 767 && $(window).width() < 992) {
                            if (scrollTop > 54) scrollTop = 0;
                        }
                        if ($(window).width() > 991) {
                            if (scrollTop > 58) scrollTop = 0;
                        }
                        if ($(window).width() < 768) {
                            if ($('#login-box-container').hasClass('show')) {
                                $('.search-wrapper').removeClass('search-shown');
                            }
                        }
                    }

                });

                header.cycle($('#orange-message-container ul li'), 0);

                header.handleHeaderSize();
                header.handleOrangeMessage();
                $('#close-searchfield').on('touchstart click', function () {
                    if ($(window).width() < 481) {
                        if ($(this).hasClass('closeable') && !settings.stop_event) {
                            settings.stop_event = true;
                            $('#close-searchfield').removeClass('closeable');
                            header.handleSearchSwitch();
                        } else {
                            $('#close-searchfield').addClass('closeable');
                        }
                    }
                });

                if (settings.type === 'search') {
                    $('#close-searchfield').addClass("closeable");
                }
                $(window).trigger('resize');
            },
            cycle: function(elements, index) {
                let cycles = elements.length - 1,
                    textWrapper = elements.eq(index).find('.text-wrapper'),
                    overlap = textWrapper.width() - (elements.eq(index).width());

                if(overlap > 0) {
                    textWrapper.css({'position': 'absolute', 'left': 0})
                }else{
                    textWrapper.attr('style', '');
                }

                if(cycles >= 1){
                    elements.eq(index).css("left", "100%")
                        .animate({"left": "0%"}, settings.cycleAnimationDelay, 'easeOutSine')
                        .animate({"left": "0%"}, settings.cycleDelay / 2,  function () {
                            if(overlap > 5){
                                textWrapper.animate({'left': -overlap + 'px'}, 20 * overlap)
                            }
                        })
                        .delay(overlap * 20)
                        .animate({"left": "0%"}, settings.cycleDelay / 2)
                        .animate({"left": "-150%"}, settings.cycleAnimationDelay, function () {
                            (index === cycles) ? index=0 : index++;
                            header.cycle(elements, index);
                        });
                }else{
                    $(elements).eq(index).css("left",  "0");
                    if(overlap > 5){
                        textWrapper.delay(settings.cycleDelay / 2)
                            .animate({'left': -overlap + 'px'}, 20 * overlap)
                            .delay(settings.cycleDelay / 2)
                            .animate({'left': '0px'}, 20 * overlap)
                            .animate({'left': '0px'}, settings.cycleDelay, function () {
                                header.cycle(elements, index)
                            });
                    }
                }
            },
            handleOrangeMessage: function () {
                var orangeHeight = $('#orange-message-container').height(),
                    scrollTop = $(document).scrollTop();
                if (scrollTop < orangeHeight) {
                    $('#orange-message-container').css('margin-top', "-" + scrollTop + "px");
                    $('.search-wrapper').removeClass('scrolled');
                } else {
                    $('#orange-message-container').css('margin-top', "-" + orangeHeight + "px");
                    $('.search-wrapper').addClass('scrolled');
                }
            },
            handleResize: function () {
                this.handleHeaderSize();
            },
            handleHeaderSize: function () {
                if ($('#customer-segment-row').hasClass('scrolled')) {
                    $('#customer-segment-row').css('top', $('#header').height() + 'px');
                } else {
                    $('#customer-segment-row').css('top', '');
                }
            },
            checkScroll: function () {
                settings.scroll_top = $(window).scrollTop();
                if (settings.scroll_top >= settings.navigation_bottom_threshold) {
                    $('#customer-segment-row').addClass('scrolled');
                    $('#customer-segment-row-dummy').show();
                } else {
                    $('#customer-segment-row').removeClass('scrolled');
                    $('#customer-segment-row-dummy').hide();
                }
                if ($('body').hasClass('homepage')) {
                    var magicbBackground = settings.sliderHeight;
                    if (settings.scroll_top < settings.sliderHeight) {
                        if (!$('#header').hasClass('user-account-clicked')) {
                            $('#header').removeClass('scrolled');
                        }
                        var headerOpacity = settings.scroll_top / settings.sliderHeight;
                        $('#header').css('background-color', 'rgba(255, 255, 255,' + headerOpacity );
                        if (settings.scroll_top >= settings.sliderHeight / 2) {
                            $('#header .magic').addClass('scrolled');
                            $('#header .left-wrapper').addClass('scrolled');
                            $('#header .magic.scrolled').css('opacity', headerOpacity);
                        } else {
                            $('#header .magic').removeClass('scrolled');
                            $('#header .left-wrapper').removeClass('scrolled');
                            $('#header .magic').css('opacity', 1);
                        }
                        magicbBackground = settings.sliderHeight  - settings.scroll_top;
                        if (!catcher.isMobile) {
                            $('#login-box-container').css('height', magicbBackground);
                            $('#mini-cart-background').css('height', magicbBackground);
                        } else {
                            $('#login-box-container').css('height', 'calc(100vh - 110px - 30px)');
                        }
                    } else {
                        $('#header').addClass('scrolled');
                        $('#header').css('background-color', 'white');
                        $('#login-box-container').css('height', 'auto');
                        $('#mini-cart-background').css('height', 'auto');
                    }
                }
                settings.actual_scroll = settings.scroll_top;
            }
        };
        header.init();
        return header;
    };
}(jQuery));
