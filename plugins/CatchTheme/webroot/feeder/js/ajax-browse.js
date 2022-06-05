(function ($) {
    $.fn.ajaxBrowse = function (options) {
        var defaults = {
            contentArea: '.browse-row',
            loader: '<div class="gradient-progress row"></div>',
            navigationContainer: '#customer-segment-row',
            loaderContainer: '#header',
            priceLimit: 20
        };

        var settings = $.extend({}, defaults, options);
        var self = this;
        var browser = {
            this: self,
            settings: settings,
            init: function () {
                browser.this.filter("a").not("#discover-my-world").each(function () {
                    $(this).click(function (e) {
                        var link = $(this);
                        e.preventDefault();
                        browser.navigation(link.attr('id'));
                        browser.requestUrl(link.attr('id'), link.data('title'), link.attr('href'),
                            true);
                        // fake pageView event on ajax reload of product listing
                        ga('set', 'page', link.attr('href'));
                        ga('send', 'pageview');
                    });
                });
                window.addEventListener('popstate', function (e) {
                    if (typeof e.state.url !== 'undefined') {
                        browser.navigation(e.state.linkId);
                        browser.requestUrl(e.state.linkId, e.state.title, e.state.url, false);
                    }
                });
                browser.checkSubNavVisibility();
                browser.updateNaviScroll();
                browser.updateSubNaviScroll();
                browser.updatePriceFilter();
                $(window).on('scroll', function (e) {
                    browser.updateNaviScroll();
                });
            },
            requestUrl: function (linkId, title, url, pushState) {
                browser.scrollTop();
                browser.addLoader();
                $.ajax({
                    url: url,
                    success: function (data) {
                        $(browser.settings.contentArea).html(data);
                        if (pushState) {
                            var stateObject = {
                                browse: true,
                                url: url,
                                title: title,
                                linkId: linkId
                            };
                            history.pushState(stateObject, title, url);
                        }
                        browser.changePageTitle(title);
                        browser.checkBanner();
                        browser.removeLoader();
                        browser.updatePriceFilter();
                        checkProductImpressions(); // for pandata impressions..

                        try {
                            $('.wishlist-item-link').wishlistify();
                        } catch (e) {
                            console.log(e);
                        }
                    }
                });
            },
            addLoader: function () {
                browser.removeLoader();
                $(browser.settings.loaderContainer).prepend($(browser.settings.loader));
            },
            removeLoader: function () {
                $('.gradient-progress').remove();
            },
            scrollTop: function () {
                $("html, body").animate({scrollTop: 0}, "slow", function () {
                    browser.updateNaviScroll();
                    browser.updateSubNaviScroll();
                });
                return false;
            },
            changePageTitle: function (title) {
                var oldtitle = document.title;
                try {
                    document.title = title;
                } catch (e) {
                    document.title = oldtitle;
                }
            },
            checkBanner: function () {
                if (categoryImage == false) {
                    $('#category-banner').css('height', '0px').addClass('empty-banner');
                    $('.banner-wrapper style').remove();
                    $('.banner-text').remove();
                } else {
                    if (($(window).width() < 850 && ($(window).innerWidth() > $(window).innerHeight())) || $(window).width() < 480) {
                        // Phone in landscape or portrait
                        $('#category-banner').css('height', '200px');
                    } else if ($(window).width() < 1025) {
                        $('#category-banner').css('height', '250px');
                    } else {
                        $('#category-banner').css('height', '320px');
                    }
                    $('#category-banner').removeClass('empty-banner');
                    $('.banner-wrapper').css('background-image', 'url(' + categoryImage + ')');
                    $('.banner-wrapper style').remove();
                    $('.banner-text').remove();
                    $('.banner-wrapper').append('<div class="row banner-text"><div class="container"></div></div>');
                    $('.banner-text .container').append('<div class="title-wrapper"></div>');
                    $('.title-wrapper').append('<span class="category-banner-headline" style="' + headlineStyle + '">' + categoryHeadline + '</span>');
                    if (typeof categorySubtitle !== 'undefined' && categorySubtitle) {
                        $('.title-wrapper').append('<br><span class="category-banner-caption"  style="' + captionStyle + '">' + categorySubtitle + '</span>');
                    }
                }
            },
            updatePriceFilter: function () {
                var priceSlider = $("#slider-range"),
                    upper = 1, under = 20;
                try {
                    if (typeof window.filter.under !== "undefined" && window.filter.under) {
                        under = window.filter.under;
                    } else {
                        under = priceLimit;
                    }
                    if (typeof window.filter.upper !== "undefined" && window.filter.upper) {
                        upper = window.filter.upper;
                    } else {
                        upper = priceFrom;
                    }
                    priceSlider.slider({
                        min: priceFrom,
                        max: priceLimit,
                        values: [upper, under]
                    });
                    $("#amount").val("€" + upper + " - €" + under);
                    $('.price-stop, .single-step').remove();
                    priceSlider.each(function () {
                        // Add labels to slider whose values
                        // are specified by min, max
                        // Get the options for this slider (specified above)
                        var opt = $(this).data().uiSlider.options,
                            vals = opt.max - opt.min, // Get the number of possible values
                            n = 0,
                            ladderStep,
                            priceElements = [];
                        if (priceLimit <= 50) {
                            ladderStep = 5;
                        } else if (priceLimit <= 100) {
                            ladderStep = 10;
                        } else if (priceLimit < 500) {
                            ladderStep = 50;
                        }  else {
                            ladderStep = priceLimit/10;
                        }
                        // With this function we create a new element and position it with percentages
                        var stopPriceLabel = function (priceVal, classVal, leftVal) {
                            return $('<label class="price-stop '+ classVal + '"><a href="#">' + "€" + priceVal + '</a></label>').css('left', leftVal + '%');
                        };
                        // Position the labels
                        for (var i = 0; i <= vals; i++) {
                            // Check if label is in range
                            if (i >= upper && i < under) {
                                var price = i + opt.min;
                                var leftPosition = i / vals * 100;
                                // Set label for 1€, 5€, 10€, 15€, 20€ ...
                                if ( i === 0 ||  i === (n - 1 ) || i === (priceLimit - 1)) {
                                    if (i === (priceLimit / 2 - 1 )) {
                                        var middleElementIn = new stopPriceLabel(price, 'in-range middle', leftPosition);
                                        priceElements.push(middleElementIn);
                                    } else {
                                        // Create a new element and position it with percentages
                                        var elementIn = new stopPriceLabel(price, 'in-range', leftPosition);
                                        priceElements.push(elementIn);
                                    }
                                    n = n + ladderStep;
                                }
                            } else { //if labels are not in range
                                var price = i + opt.min;
                                var leftPosition = i / vals * 100;
                                if (i === 0 || i === (n - 1) || i === (priceLimit - 1)) {
                                    if (i === (priceLimit / 2 - 1)) {
                                        var middleElementOut = new stopPriceLabel(price, 'middle', leftPosition);
                                        priceElements.push(middleElementOut);
                                    } else {
                                        var elementOut = new stopPriceLabel(price, '', leftPosition);
                                        priceElements.push(elementOut);
                                    }
                                    n = n + ladderStep;
                                }
                            }
                        }
                        priceSlider.append(priceElements);
                    });
                    var priceLabel = $('#slider-range').find("label a");
                    priceLabel.each(function() {
                        var stopPrice = +$(this).text().replace(/[^0-9]/gi, '');
                        if (upper < stopPrice && stopPrice <= under) {
                            $(this).parent().addClass("in-range");
                        }
                    });
                } catch (e) {
                    console.log(e);
                }
            },
            navigation: function (linkId) {
                var newItem = $('#' + linkId).parent(),
                    newItemImg = newItem.find('img'),
                    oldItem = $('.nav-item.active'),
                    oldItemImg = oldItem.find('img'),
                    filterItems = $('#filter-options li');

                oldItem.removeClass('active has-active-children');
                if (oldItemImg.data('src')) {
                    oldItemImg.attr('src', oldItemImg.data('src'));
                }

                newItem.addClass('active');
                if (newItemImg.data('src-selected')) {
                    newItemImg.attr('src', newItemImg.data('src-selected'));
                }
                filterItems.removeClass('active');

                // 2nd level navigation additional logic
                if (newItem.attr('ref')) {
                    $('.navbar-nav.level-1').removeClass('active');
                    $('ul#' + newItem.attr('ref')).addClass('active');

                }
                if (newItem.parent().attr('id')) { // 2nd level link
                    var parentItem = $('li[ref=' + newItem.parent().attr('id') + ']'),
                        parentItemImg = parentItem.find('img');
                    parentItem.addClass('has-active-children');
                    if (parentItemImg.data('src-selected')) {
                        parentItemImg.attr('src', parentItemImg.data('src-selected'));
                    }
                } else {
                    newItem.siblings('.has-active-children').each(function () {
                        $(this).removeClass('has-active-children');
                        var img = $(this).find('img');
                        if (img.data('src')) {
                            img.attr('src', img.data('src'));
                        }
                    });
                }

                this.checkSubNavVisibility();
                if (linkId != oldItem.attr('id')) {
                    $("#filter input.filter-button").each( function() {
                        $(this).prop('checked', false);
                    });
                }
                try {
                    window.filter.free_shipping = 0;
                    window.filter.discounts = 0;
                    window.filter.fast_shipping = 0;
                    window.filter.low_stock = 0;
                    window.filter.top_rated = 0;
                    window.filter.free_return = 0;
                    window.filter.page = 1;
                } catch (e) {
                    console.log(e);
                }
            },

            checkSubNavVisibility: function () {
                var subNavItemWidth = 0;
                $('#customer-segment-row .row > .col-12 .container .row.sub-nav').css('display', $('#customer-segment-row .row > .col-12 .container .row .navbar-nav.level-1.active').children().length ? 'block' : 'none');
                var n = $('.level-1.active li').length;
                for (var i = 1; i <= n; i++) {
                    subNavItemWidth = subNavItemWidth + $('.level-1.active > li:nth-of-type(' + i + ')').width();
                }
                if (($('.nav-item.active').hasClass('has-children') || $('.nav-item').hasClass('has-active-children')) && (subNavItemWidth > $('#category-subnav').width())) {
                    $('.sub-navbar-control').show();
                } else {
                    $('.sub-navbar-control').hide();
                }
            },
            updateNaviScroll: function () {
                var activeLink = $('#category-navigation .level-0 > .nav-item.active, #category-navigation .level-0 > .nav-item.has-active-children');

                if (activeLink.length) {
                    $('#category-navigation').scrollLeft(activeLink.position().left);

                }
            },
            updateSubNaviScroll: function () {
                var activeSubLink = $('#category-subnav .level-1 > .nav-item.active');

                if (activeSubLink.length) {
                    $('#category-subnav').scrollLeft(activeSubLink.position().left);
                }
            }
        };
        browser.init();
        return browser;
    };
}(jQuery));
