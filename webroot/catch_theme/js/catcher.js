var catcher = {
    isMobile: false,
    isTablet: false,
    searchSuggestionsUrl: null,
    searchSuggestionsRequest: null,
    redirectAfterLogin: null,
    search: '',
    loginSidebarNotLoggedInText: '',
    userName: '',
    animatedHeader: false,
    init: function () {
        catcher.isMobile = $(window).innerWidth() <= 480 || $(window).innerHeight() <= 480;
        catcher.isTablet = ($(window).innerWidth() <= 1024 && $(window).innerHeight() <= 768) || ($(window).innerHeight() <= 1024 && $(window).innerWidth() <= 768);
        $(window).on('resize orientationchange', function () {
            catcher.isMobile = $(window).innerWidth() <= 480 || $(window).innerHeight() <= 480;
            catcher.isTablet = ($(window).innerWidth() <= 1024 && $(window).innerHeight() <= 768) || ($(window).innerHeight() <= 1024 && $(window).innerWidth() <= 768);
        });

        catcher.initNavigation();
        catcher.initHeaderAndMenu();
    },
    scrollLock: function () {
        const html = $('html');
        if (!html.data('previous-overflow')) {
            html.data('previous-overflow', html.css('overflow'));
        }
        html.css('overflow', 'hidden');
    },
    scrollUnlock: function () {
        const html = $('html');
        html.css('overflow', html.data('previous-overflow'));
        html.data('previous-overflow', null);
    },
    hideMenu: function () {
        $('.burger-container :focus').blur();
        $('.burger-wrapper').css('width', '0px');
        $('.burger-container').removeClass('menu-shown').css('z-index', '-1');
        $('.additional-message').hide();
        $('.register-burger').hide();
        $('.password-burger').hide();
        $('.login-burger').show();
        $('#user-content .newsletter-wrapper').show();
        $('#back-to-login').hide();
        $('#login-box-container').removeClass('show');
        if (!(catcher.isMobile && catcher.animatedHeader)) {
            $('.sticky-filter-control').show();
        }
        $('#wishlist').removeClass('burger-menu-shown');
        if (!$('body').hasClass('cart')) {
            $('#wishlist').show();
            $('#mini-cart-icon').show();
        }
        $('#user-account').show();
        if ($('#burger-switch').hasClass('burger-icon-switch')) {
            $('#burger-switch').removeClass('burger-icon-switch');
        }
        $('#orange-message-container').removeClass('orange-message-hide');
        window.userLoginCallback = function () {
        };
        try {
            $('#register-wishlist-item-id').val('');
        } catch (e) {
            console.error(e);
        }
        try {
            FB.CustomerChat.show(false);
        } catch (e) {

        }
        catcher.scrollUnlock();
    },
    showMenu: function () {
        if ($('#filter').hasClass('filter-shown')) {
            catcher.hideFilter();
        }
        $('#user-content').addClass('menu-shown');
        $('#user-content').css('z-index', '1000');
        $('#user-close').show();
        catcher.scrollLock();
        if (catcher.isMobile) {
            $('.burger-wrapper').css('width', '100%');
            if ($('body').hasClass('orange-message-shown')) {
                $('#orange-message-container').addClass('orange-message-hide');
            }
        } else {
            $('.burger-wrapper').css('width', '365px');
        }
        $('.sticky-filter-control').hide();
        try {
            FB.CustomerChat.hide();
        } catch (e) {

        }
        $('.register-burger').hide();
    },
    showAccountMenu: function () {//console.log('showAccountMenu');
        if ($('body').hasClass('homepage')) {
            if (catcher.isMobile) {
                $('#header').addClass('user-account-clicked scrolled');
            }
        }
        $('#login-box-container').show().addClass('show');
        $('#login-box').show();
        $('#user-account').addClass('show-info-box');
    },
    hideAcconutMenu: function () {//console.log('hideAcconutMenu');
        if ($('body').hasClass('homepage')) {
            if (catcher.isMobile) {
                if ($(window).scrollTop() < $('#banners-carousel').height()) {
                    $('#header').removeClass('scrolled');
                }
                $('#header').removeClass('user-account-clicked');
            }
        }
        $('#login-box').hide();
        $('#login-box-container').hide().removeClass('show');
        $('#user-account').removeClass('show-info-box');
    },
    hideAccountMenuTimer: function () {
        $('#login-box-container').hide().removeClass('show');
    },
    hideFilter: function () {
        if (($(window).width() < 850 && ($(window).innerWidth() > $(window).innerHeight())) || $(window).width() < 480) {
            $('.filter-wrapper').css('right', '-850px');
            $('#filter').removeClass('filter-shown');
            $('.sticky-filter-control').removeClass('disabled');
            $('.sticky-filter-control').css('right', '10px');
            if ($(window).scrollTop() >= 300) {
                $('#back-to-top-control').removeClass('hidden');
            }
        } else {
            $('.filter-wrapper').css('right', '-490px');
            $('#filter').removeClass('filter-shown');
            $('.sticky-filter-control').removeClass('disabled');
            $('.sticky-filter-control').css('right', '0px');
            if ($(window).scrollTop() >= 300) {
                $('#back-to-top-control').removeClass('hidden');
            }
        }
    },
    showSearch: function () {
        console.log('show searchfield');
        $('.search-wrapper').addClass('search-shown');
        $('#user-account').removeClass('show-info-box');
        $('#login-box-container').removeClass('show').hide();
        $('#mini-cart-icon').removeClass('shown');
        $('#mini-cart-container').removeClass('shown');
        $('#mini-cart-background').hide();
        $('#search-switch').addClass('search-shown');
        push2dataLayer({'search_toggle': 'open'});

    },
    hideSearch: function () {
        $('.search-wrapper').removeClass('search-shown');
        $('#search-switch').removeClass('search-shown');
        push2dataLayer({'search_toggle': 'close'});
    },
    searchSuggestions: function () {
        catcher.search = $('.search').find("input[type=text]").val();
        if (catcher.search.length >= 2) {
            if (catcher.searchSuggestionsRequest != null) {
                catcher.searchSuggestionsRequest.abort();
                catcher.searchSuggestionsRequest = null;
            }
            catcher.searchSuggestionsRequest = $.ajax(
                {
                    'url': catcher.searchSuggestionsUrl,
                    'data': {
                        'search': catcher.search,
                    },
                    'method': 'GET',
                    'success': function (data) {
                        // i-ways GTM tracking helper
                        console.log(data);
                        push2dataLayer({'search_input': catcher.search});
                        $("#search-suggestions").html(data);
                        $('.search').addClass('typing');
                    },
                    'error': function (data) {
                    }
                });
        } else {
            $("#search-suggestions").html('');
            $('.search').removeClass('typing');
        }
    },
    searchClickX: function (el) {
        var inputValue = $('input.clearable').val().length;
        if (inputValue === 0 && $('#close-searchfield').hasClass('closeable')) {
            if (!$('.search-wrapper').hasClass('search-shown')) {
                $('#customer-segment-row.scrolled').removeClass('search-shown');
                catcher.search = '';
                catcher.searchSuggestions();
            }
        } else {
            $('#searchfield').removeClass('x onX').val("");
            $('.search').removeClass('typing');
            catcher.search = '';
            catcher.searchSuggestions();
        }
    },
    initNavigation: function () {
        category_navigation = $('#navigation-container');
        if (category_navigation.is(':empty')) {
            category_navigation.addClass('empty');
            //$('#content').css('padding-top', header_height);
        } else {
            category_navigation.css('transition', 'height .25s');
        }

        // category slider controls
        var navi = $('#category-navigation'),
            prev = $('.navbar-control.navbar-prev'),
            next = $('.navbar-control.navbar-next'),
            slider_width = Math.floor(navi.width()),
            wrapper_width = $('#category-navigation').width(),
            subNav = $('#category-subnav'),
            subPrev = $('.sub-navbar-control.navbar-prev'),
            subNext = $('.sub-navbar-control.navbar-next')

        navi.on('scroll', function (e) {
            var left_scrolling = $(this).scrollLeft(),
                marquee = $(this).children('#navbarSupportedContent'),
                slider_width = Math.floor($(this).width());
            if (left_scrolling) {
                prev.addClass('active');
            } else {
                prev.removeClass('active');
            }
            if (marquee.width() == slider_width + left_scrolling) {
                next.removeClass('active');
            } else {
                next.addClass('active');
            }
            current_step = Math.ceil(left_scrolling / wrapper_width);
        });

        prev.on('click', function (event) {
            var left_scrolling = navi.scrollLeft(),
                scroll_left = left_scrolling - wrapper_width;
            navi.animate({
                scrollLeft: scroll_left
            }, 500);
        });

        next.on('click', function (event) {
            var left_scrolling = navi.scrollLeft(),
                scroll_left = left_scrolling + wrapper_width;
            navi.animate({
                scrollLeft: scroll_left
            }, 500);
        });

        // controls for sub navigation
        subNav.on('scroll', function (e) {
            var sub_left_scrolling = $(this).scrollLeft(),
                marquee = $(this).children('.navbar-nav.level-1.active'),
                sub_slider_width = Math.floor($(this).width());
            var n = $('.level-1.active li').length,
                subNavItemWidth = 0;
            for (var i = 1; i <= n; i++) {
                subNavItemWidth = subNavItemWidth + $('.level-1.active > li:nth-of-type(' + i + ')').width();
            }
            if (sub_left_scrolling) {
                subPrev.addClass('active');
                $('.sub-nav').removeClass('hide-before');
            } else {
                subPrev.removeClass('active');
                $('.sub-nav').addClass('hide-before');
            }
            if (marquee.width() == sub_slider_width + sub_left_scrolling) {
                subNext.removeClass('active');
                $('.sub-nav').addClass('hide-after');
            } else {
                subNext.addClass('active');
                $('.sub-nav').removeClass('hide-after');
            }
            current_step = Math.ceil(sub_left_scrolling / $('#category-subnav').width());
        });

        subPrev.on('click', function (event) {
            var sub_left_scrolling = subNav.scrollLeft(),
                sub_scroll_left = sub_left_scrolling - $('#category-subnav').width();
            subNav.animate({
                scrollLeft: sub_scroll_left
            }, 500);
        });

        subNext.on('click', function (event) {
            var sub_left_scrolling = subNav.scrollLeft(),
                sub_scroll_left = sub_left_scrolling + $('#category-subnav').width();
            subNav.animate({
                scrollLeft: sub_scroll_left
            }, 500);
        });
    },

    initHeaderAndMenu: function () {
    	// check for filter button on pages without price filters
        if (!$('#price-filter').length) {
            $('#filter-switch').off().addClass('disabled');
        }

        $('#search-switch').on('click', function () {
            if ($('#search-switch').hasClass('search-shown')) {
                catcher.hideSearch();
            } else {
                catcher.showSearch();
            }
        }).trigger('click'); // because of WD-2110

        /* Searchfield*/
        if ($('body').hasClass('ebaycheckout')) {
            $('#header .search-wrapper').removeClass('search-shown');
        }
        $(window).on('load', function () {
            if ($('#searchfield').val().length != 0) {
                $('.search-wrapper').addClass('search-shown');
                $('#searchfield').addClass('x onX');
                $('#customer-segment-row.scrolled').addClass('search-shown');
            }
        });

        $('#searchfield').keyup(function () {
            catcher.searchSuggestions();
        });
        if ($(window).width() < 768) {
            $(document).on('input', '.clearable', function () {
                $(this)[catcher.toggleClass(this.value)]('x');
                $('#searchfield').addClass('x onX');
                $('#close-searchfield').removeClass('closeable');
            });

            $(window).on('load', function () {
                if ($('input.clearable').val().length > 0) {
                    $('#close-searchfield').removeClass('closeable');
                }
            });

            $('#close-searchfield').click(function (ev) {
                catcher.searchClickX();
            });
            $('body').on('click touch', function (e) {
                var clicked = $(e.target);
                if (clicked.is('.search-wrapper') || clicked.parents().is(".search-wrapper")) {
                    return;
                } else {
                    if ($('#item-list').hasClass('show')) {
                        $("#search-suggestions").html("");
                    } else {
                        $('.search-wrapper .row.search').removeClass('active');
                        $('.search-wrapper').removeClass('active');
                    }
                }
            });
        } else {
            $(document).on('input', '.clearable', function () {
                $(this)[catcher.toggleClass(this.value)]('x');
            }).on('mousemove', '.x', function (e) {
                $(this)[catcher.toggleClass(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]('onX');
            });
        }

        $(document).on('input', '.clearable', function () {
            $(this)[catcher.toggleClass(this.value)]('x');
            $('#close-searchfield').removeClass('closeable');
            $('#searchfield').addClass('x onX');
        });

        $('#searchfield').on({
            keyup: function () {
                if ($(this).val() === "") {
                    $(this).removeClass("onX x");
                    $('#close-searchfield').removeClass("closeable");
                }
            },
            'touchstart click': function () {
                $('.search').addClass('active');
                $('.search-wrapper').addClass('active');
            }
        });

        $('#close-searchfield').on('touchstart click', function (ev) {
            ev.preventDefault();
            catcher.searchClickX();
        }, {passive: true});
        $('body').click(function (e) {
            var clicked = $(e.target);
            if ($('#item-list').hasClass('show')) {
                if (clicked.is('.search-wrapper') || clicked.parents().is(".search-wrapper")) {
                    return;
                } else
                    $("#search-suggestions").html("");
            }
            if ($('#user-account').hasClass('show-info-box')) {
                if (!clicked.is('#user-account > span') && !clicked.is('#login-box') && !clicked.parents().is('#login-box')) {
                    catcher.hideAcconutMenu();
                }
            }
        });

        // Mini Cart
        $('#mini-cart-icon').on('click mouseover', function (e) {
            if ($('#filter').hasClass('filter-shown')) {
                catcher.hideFilter();
            }
            if ($('#user-account').hasClass('show-info-box')) {
                catcher.hideAcconutMenu();
            }
        });

        // show burger menu
        $('#burger-switch').click(function (e) {
            if (!$(this).hasClass('burger-icon-switch')) {
                e.preventDefault();
                catcher.scrollLock();
                if ($('#filter').hasClass('filter-shown')) {
                    catcher.hideFilter();
                }
                //$('#burger-content').show().addClass('menu-shown').css('z-index', '1000');
                $('#mobile-navi').show().addClass('menu-shown').css('z-index', '1000');
                if (catcher.isMobile) {
                    $('.burger-wrapper').css('width', '100%');
                    if ($('body').hasClass('orange-message-shown')) {
                        $('#orange-message-container').addClass('orange-message-hide');
                    }
                    $('#wishlist').hide();
                    $('#mini-cart-icon').hide();
                    $('#user-account').hide();
                    $('.search-wrapper').removeClass('search-shown');
                    $('#burger-switch').addClass('burger-icon-switch');
                } else {
                    $('.burger-wrapper').css('width', '365px');
                }

                $('.sticky-filter-control').hide();
                try {
                    FB.CustomerChat.hide();
                } catch (e) {

                }
            } else {
                catcher.hideMenu();
            }
        });
        // show user login
        var leaveUser = false,
            leaveLogin = false;
        $('#user-account').on('click', function (e) {
            var clicked = (e.type === 'click');
            leaveUser = false;
            leaveLogin = false;
            if (!($(this).hasClass('burger-icon-switch'))) {
                e.preventDefault();
                if (!($(this).hasClass('show-info-box'))) {
                    catcher.showAccountMenu();
                } else {
                    if (e.type === 'click') {
                        catcher.hideAcconutMenu();
                    }
                }
            } else {
                $('#user-close').show();
            }
        });
        $('#user-account').hover(function (e) {
            if (!catcher.isMobile) {
                var clicked = (e.type === 'click');
                leaveUser = false;
                leaveLogin = false;
                if (!($(this).hasClass('burger-icon-switch'))) {
                    e.preventDefault();
                    if (!($(this).hasClass('show-info-box'))) {
                        catcher.showAccountMenu();
                    } else {
                        if (e.type === 'click') {
                            catcher.hideAcconutMenu();
                        }
                    }
                } else {
                    console.log('else user close');
                    $('#user-close').show();
                }
            }
        });
        $('#user-account').on('mouseout', function () {
            leaveUser = true;
            if (leaveUser && leaveLogin) {
                catcher.hideAcconutMenu();
            }
        });
        $('#login-box').on('mouseover', function () {
            leaveLogin = false;
        });
        $('#login-box').on('mouseleave', function () {
            leaveLogin = true;
            if (leaveUser && leaveLogin) {
                catcher.hideAcconutMenu();
            }
        });

        $('#login-box .login-button').click(function () {
            $('#login-box').slideUp('slow');
            $('#user-account').removeClass('show-info-box');
            setTimeout(function () {
                $('#login-box-container').hide();
            }, 600);
            catcher.showMenu();
        });
        $('#login-box .registration-link').click(function (e) {
            e.preventDefault();
            $('#login-box').slideUp('slow');
            $('#user-account').removeClass('show-info-box');
            catcher.showMenu();
            $('.register-burger').show();
        });
        $('#login-box .user-account-logout').click(function () {
            $('#login-box').slideUp('slow');
            setTimeout(function () {
                $('#login-box-container').hide();
            }, 600);
            $('#user-account').removeClass('show-info-box');
        });
        $('#login-box #account-navigation > li > a').click(function (e) {
            var userNotLogged = $('#account-navigation > li').hasClass('user-not-logged');
            if (userNotLogged) {
                e.preventDefault();
                catcher.redirectAfterLogin = $(this).attr('href');
                $('#login-box').slideUp('slow');
                $('#user-account').removeClass('show-info-box');
                catcher.showMenu();
            }
        });

        // force to show user login after reset password
        if ($('.reset-password-message').contents().length) {
            $('#user-account').trigger('click');
        }
        $('#wishlist').click(function (e) {
            var userNotLogged = !(typeof window.userLogedIn !== 'undefined' && window.userLogedIn);
            var login_sidebar = $('.burger-container .burger-wrapper .row.menu-account .container');
            if (e.which) {
                catcher.redirectAfterLogin = $(this).attr("data-redirect");
            }
            if (login_sidebar.hasClass('user-not-logged')) {
                login_sidebar.children('.additional-message').remove();
            }
            if (userNotLogged) {
                if (!$(this).hasClass('burger-menu-shown')) {
                    catcher.showMenu();
                    $('#wishlist').addClass('burger-menu-shown');
                    if (login_sidebar.hasClass('user-not-logged')) {
                        login_sidebar.prepend(catcher.loginSidebarNotLoggedInText);
                    }
                } else {
                    catcher.hideMenu();
                    $('#wishlist').removeClass('burger-menu-shown');
                    $('section.login-burger').show();
                    $('#back-to-login').hide();
                    $('.newsletter-wrapper').show();
                    $('.additional-message').show();
                    $('#user-close').show();
                }
            }
        });
        $('#wishlist').on('mouseover', function () {
            catcher.hideAcconutMenu();
        });
        $(window).on('resize orientationchange', function () {

            if ($('.burger-container').hasClass('menu-shown')) {
                if (catcher.isMobile) {
                    $('.burger-wrapper').css('width', '100%');
                    if ($('body').hasClass('orange-message-shown')) {
                        $('#orange-message-container').addClass('orange-message-hide');
                    }
                    if ($('#burger-content').hasClass('menu-shown')) {
                        $('#burger-switch').addClass('burger-icon-switch');
                    }
                } else {
                    $('.burger-wrapper').css('width', '365px');
                    if (!$('#content').hasClass('cart')) {
                        $('#wishlist').show();
                        $('#mini-cart-icon').show();
                    }
                    if ($('#burger-switch').hasClass('burger-icon-switch')) {
                        $('#burger-switch').removeClass('burger-icon-switch');
                    }
                }
            }
        });
        // hide burger menu
        $('#burger-close, #navi-close').click(function (e) {
            catcher.hideMenu();
        });
        // hide user menu
        $('#user-close').click(function (e) {
            catcher.hideMenu();
        });
        $('.burger-container').click(function (e) {
            if ($('.burger-container').hasClass('menu-shown')) {
                var target = $(e.target);
                if (target.is('.burger-wrapper') || target.parents('.burger-wrapper').length) {
                    // do nothing
                } else {
                    catcher.hideMenu();
                }
            }
        });

        // hide registration or password reset block
        // click on back-to-login-button
        $('#back-to-login').on('click', function (e) {
            e.preventDefault();
            $('section.register-burger').hide();
            $('section.password-burger').hide();
            $('section.login-burger').show();
            $('#back-to-login').hide();
            $('.newsletter-wrapper').show();
            $('.additional-message').show();
            $('#user-close').show();
        });

        $('#back-to-login-link').on('click', function (e) {
            e.preventDefault();
            $('section.password-burger').hide();
            $('section.login-burger').show();
            $('.newsletter-wrapper').show();
            $('.additional-message').show();
            $('#user-close').show();
            $('#back-to-login').hide();
        });

        // replace register form
        $('.not-registered, .registered-user a').on('click', function (e) {
            if (window.location.href.indexOf('registration') > -1) {
                $('.not-registered').removeAttr('href');
                catcher.hideMenu();
            } else {
                //if (!(window.location.href.indexOf('login') > -1)) {
                    e.preventDefault();
                    catcher.showMenu();
                    $('.login-burger, .register-burger').toggle();
                //}
            }
        });

        $('.not-registered').on('click', function (e) {
            pushEcommerce('registrationFlow1');
        });

        // remove submit button outline on click
        var noOutline = function () {
            this.blur();
        };
        for (var i = 0; i < $('.redesign-button').length; i++) {
            $('.redesign-button')[i].addEventListener('click', noOutline, false);
        }

        // i-ways GTM tracking helper on form submit event
        $('from#search-form').on('submit', function (e) {
            e.preventDefault();
            var search_field_val = $('#searchfield').val();
            push2dataLayer({
                'search_input': search_field_val ? search_field_val : '-',
                'event': 'search',
                'resultsNo': pandata.resultsNo,
                'query': search_field_val ? search_field_val : undefined
            });
        });

        // pandata GTM tracking helper on header interactions
        var clicked_item = 'discover';
        $('#header #logo').on('click', function (e) {
            clicked_item = 'logo';
            push2dataLayer({
                'event': 'headerInteraction',
                'clickedItem': clicked_item
            });
        });
        $('#header #search-switch').on('click', function (e) {
            clicked_item = 'search button';
            push2dataLayer({
                'event': 'headerInteraction',
                'clickedItem': clicked_item
            });
        });
        /*$('#header #mini-cart-icon').on('click', function (e) {
            clicked_item = 'cart button';
            push2dataLayer({
                'event': 'headerInteraction',
                'clickedItem': clicked_item
            });
        }); deaktivated because of WD-1423 addition */

        // new, from WD-1423
        $('#header #wishlist').on('click', function (e) {
            clicked_item = 'wishlist';
            push2dataLayer({
                'event': 'headerInteraction',
                'clickedItem': clicked_item
            });
            if (!google.userId) {
                clicked_item = 'user';
                push2dataLayer({
                    'event': 'headerInteraction',
                    'clickedItem': clicked_item
                });
            }
        });
        $('#header #user-account').on('click', function (e) {
            clicked_item = 'user';
            push2dataLayer({
                'event': 'headerInteraction',
                'clickedItem': clicked_item
            });
        });
        $('#header #mini-cart-icon').on('click', function (e) {
            clicked_item = 'cart';
            push2dataLayer({
                'event': 'headerInteraction',
                'clickedItem': clicked_item
            });
        });
        $('#header #burger-switch').on('click', function (e) {
            clicked_item = 'menue';
            push2dataLayer({
                'event': 'headerInteraction',
                'clickedItem': clicked_item
            });
        });
        $('#burger-content .category-navigation a').on('click', function (e) {
            clicked_item = $(this).text();
            push2dataLayer({
                'event': 'headerInteraction',
                'clickedItem': clicked_item
            });
        });

        $('.item-count').each(function () {
            if ($(this).text().length > 2) {
                $(this).addClass('three-digit');
            }
        });

        $(window).trigger('resize');
    },
    toggleClass: function (v) {
        if (v) {
            return 'addClass';
        }
        return 'removeClass';
    }
};
$(function () {
    catcher.init();
});
