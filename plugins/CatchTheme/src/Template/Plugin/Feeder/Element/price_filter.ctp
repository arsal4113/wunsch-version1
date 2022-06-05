<div class="container-fluid under-<?= $under; ?>" id="filter">
    <div id="sticky-filter-control" class="sticky-filter-control"></div>
    <div class="row filter-wrapper">
        <div class="container product-filter">
            <p class="filter-title"><?= __('Filter by'); ?></p>
            <div class="filter-area">
                <div class="price-slider">
                    <p class="filter-subtitle"><?= __('Price filters'); ?></p>
                    <div id="slider-range"></div>
                    <div class="price-range">
                        <label for="amount"><?= __('Price range'); ?>:</label>
                        <input type="text" id="amount" readonly style="border:0; color:#FEDA46; font-weight:bold;">
                    </div>
                </div>
                <div class="product-filter">
                    <p class="filter-subtitle"><?= __('Filters'); ?></p>
                    <ul id="filter-options">
                        <li class="free-shipping <?= $this->request->getQuery('free_shipping',
                            false) ? 'active' : ''; ?>">
                            <input name="free_shipping" id="free-shipping" class="filter-button"
                                   type="checkbox" <?= $this->request->getQuery('free_shipping',
                                false) ? 'checked="checked"' : ''; ?>>
                            <label for="free-shipping"><?= __('Free shipping'); ?></label>
                        </li>
                        <li class="top-rated <?= $this->request->getQuery('top_rated',
                            false) ? 'active' : ''; ?>">
                            <input name="top_rated" id="top-rated" class="filter-button"
                                   type="checkbox" <?= $this->request->getQuery('top_rated',
                                false) ? 'checked="checked"' : ''; ?>>
                            <label for="top-rated"><?= __('Good reviewed'); ?></label>
                        </li>
                        <li class="fast-shipping <?= $this->request->getQuery('fast_shipping',
                            false) ? 'active' : ''; ?>">
                            <input name="fast_shipping" id="fast-shipping" class="filter-button"
                                   type="checkbox" <?= $this->request->getQuery('fast_shipping',
                                false) ? 'checked="checked"' : ''; ?>>
                            <label for="fast-shipping"><?= __('Fast delivery'); ?></label>
                        </li>
                        <li class="low-stock <?= $this->request->getQuery('low_stock',
                            false) ? 'active' : ''; ?>">
                            <input name="low_stock" id="low-stock" class="filter-button"
                                   type="checkbox" <?= $this->request->getQuery('low_stock',
                                false) ? 'checked="checked"' : ''; ?>>
                            <label for="low-stock"><?= __('Almost gone'); ?></label>
                        </li>
                        <li class="free-return <?= $this->request->getQuery('free_return',
                            false) ? 'active' : ''; ?>">
                            <input name="free_return" id="free-return" class="filter-button"
                                   type="checkbox" <?= $this->request->getQuery('free_return',
                                false) ? 'checked="checked"' : ''; ?>>
                            <label for="free-return"><?= __('Free returns'); ?></label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="button submit">
                <input name="submit-filter" id="submit-filter" class="filter-button"
                       type="checkbox">
                <label for="submit-filter"><?= __('Confirm'); ?></label>
            </div>
            <div class="button close">
                <input name="close-filter" id="close-filter" class="filter-button"
                       type="checkbox">
                <label for="close-filter"><?= __('Close'); ?></label>
            </div>
            <div class="divider-mobile"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function ($) {
        var priceLimit = <?= min($priceLimit ?? 20, 6000) ?>,
            priceFrom = <?= $priceFrom ?? 1 ?>,
            min_range = getParameterByName('upper') || priceFrom,
            max_range = getParameterByName('under') || priceLimit,
            filterCount = 0,
            ladderStep,
            priceSlider = $("#slider-range"),
            filterCounter = $('#filter-counter');

        if (priceLimit <= 50) {
            ladderStep = 5;
        } else if (priceLimit <= 100) {
            ladderStep = 10;
        } else if (priceLimit < 500) {
            ladderStep = 50;
        }  else {
            ladderStep = priceLimit/10;
        }

        window.filter = {
            "search": getParameterByName('search') || '',
            "upper": getParameterByName('upper') || priceFrom,
            "under": getParameterByName('under') || priceLimit,
            "free_shipping": getParameterByName('free_shipping') || 0,
            "discounts": getParameterByName('discounts') || 0,
            "fast_shipping": getParameterByName('fast_shipping') || 0,
            "low_stock": getParameterByName('low_stock') || 0,
            "top_rated": getParameterByName('top_rated') || 0,
            "free_return": getParameterByName('free_return') || 0
        };

        filterURL = window.location.href;
        var filterChecked = false;
        $.each(window.filter, function (key, value) {
            if ((key !== 'upper') && (key !== 'under') && (value === 1)) {
                filterCount++;
            } else if (((key === 'upper') && (value > 1)) || ((key === 'under') && (value < priceLimit))) {
                if (filterChecked = false) {
                    filterCount++;
                    filterChecked = true;
                }
            }
        });
        if (filterCount > 0) {
            filterCounter.append(filterCount);
            filterCounter.css('display', 'block');
        }

        priceSlider.slider({
            range: true,
            min: priceFrom,
            max: priceLimit,
            values: [window.filter.upper, window.filter.under],
            step: 1,
            slide: function (event, ui) {
                // first range input(min)
                var firstValue = ui.values[0];
                // second range input(max)
                var secondValue = ui.values[1];
                $("#amount").val("€" + firstValue + " - €" + secondValue);
                priceSlider.on("slide slidestart slidestop", function (event, ui) {
                    $("#slider-range label").removeClass("in-range");
                    var priceLabel = priceSlider.find("label a");
                    priceLabel.each(function() {
                        var stopPrice = +$(this).text().replace(/[^0-9]/gi, '');
                        if (ui.values[0] < stopPrice && stopPrice < ui.values[1]) {
                            $(this).parent().addClass("in-range");
                        }
                    });
                    window.filter.upper = firstValue;
                    window.filter.under = secondValue;
                    // i-ways GTM tracking helper
                    push2dataLayer({'slider_range': firstValue + '-' + secondValue});
                });
            } // END OF SLIDE
        });

        priceSlider.each(function () {
            // Add labels to slider whose values
            // are specified by min, max
            // Get the options for this slider (specified above)
            var opt = $(this).data().uiSlider.options,
                vals = opt.max - opt.min, // Get the number of possible values
                n = 0,
                priceElements = [];
            // With this function we create a new element and position it with percentages
            var stopPriceLabel = function (priceVal, classVal, leftVal) {
                return $('<label class="price-stop '+ classVal + '"><a href="#">' + "€" + priceVal + '</a></label>').css('left', leftVal + '%');
            };
            // Position the labels
            for (var i = 0; i <= vals; i++) {
                // Check if label is in range
                if (i >= min_range && i < max_range) {
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
        $("#amount").val("€" + priceSlider.slider("values", 0) +
            " - €" + priceSlider.slider("values", 1));

        $('label').click(function (e) {
            var clicked = $(e.target);
            if (clicked.parents().hasClass('active')) {
                clicked.parents().removeClass('active');
            } else  if (clicked.parents().is('li')) {
                clicked.parents('li').addClass('active');
            }
        });

        $('#submit-filter').on('click', function () {
            var filterUrl = refineURL();
            var filterParameter = [];
            try {
                window.filter.page = 1;
                window.filter.upper = priceSlider.slider("values")[0];
                window.filter.under = priceSlider.slider("values")[1];
            } catch (e) {
                console.log(e);
            }
            $("#filter input.filter-button").each(
                function (e) {
                    if ($(this).is(":checked")) {
                        window.filter[$(this).attr("name")] = 1;
                    } else {
                        window.filter[$(this).attr("name")] = 0;
                    }
                }
            );
            $.each(window.filter, function (key, value) {
                if (value && value !== "0") {
                    filterParameter.push(key + "=" + value);
                }
            });
            if (filterParameter.length) {
                filterUrl = filterUrl + "?" + filterParameter.join('&');
            }
            if (typeof window.browser !== "undefined") {
                var link = $('a.nav-link.active').first();
                window.browser.requestUrl(link.attr('id'), document.title, filterUrl, true);
            } else {
                window.location.href = filterUrl;
            }
            catcher.hideFilter();
            $('#content').removeClass('no-scroll');
            $('.sticky-filter-control').trigger('click').removeClass('disabled');

            // pandata additional tracking-pushes on apply-filters event
            push2dataLayer({
                'event': 'filtering',
                'filteredPriceLow': window.filter.upper,
                'filteredPriceHigh': window.filter.under,
                'filteredFreeShipping': window.filter.free_shipping ? 'Y' : 'N',
                'filteredHighRating': window.filter.top_rated ? 'Y' : 'N',
                'filteredFastShipping': window.filter.fast_shipping ? 'Y' : 'N',
                'filteredNearlyGone': window.filter.low_stock ? 'Y' : 'N',
                'filteredFreeReturn': window.filter.free_return ? 'Y' : 'N',
            });
        });

        $("#filter input.filter-button").change(
            function () {
                if ($(this).is(":checked")) {
                    window.filter[$(this).attr("name")] = 1;
                } else {
                    window.filter[$(this).attr("name")] = 0;
                }
            }
        );

        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        function refineURL() {
            return window.location.pathname;
        }

        function bindFilters ()
        {
            $('.sticky-filter-control').off().click(function () {
                if ($('#filter').hasClass('filter-shown')) {
                    hideFilter();
                } else {
                    if (($(window).width() < 850 && ($(window).innerWidth() > $(window).innerHeight())) || $(window).width() < 480) {
                        // Phone in landscape or portrait
                        $('.filter-wrapper').css('right', '0');
                        $('#filter').addClass('filter-shown');
                        $('.sticky-filter-control').addClass('disabled');
                        $('.sticky-filter-control').css('right', '-490px');
                        $('#back-to-top-control').addClass('hidden');
                    } else {
                        $('.filter-wrapper').css('right', '0');
                        $('#filter').addClass('filter-shown');
                        $('.sticky-filter-control').addClass('disabled');
                        $('.sticky-filter-control').css('right', '490px');
                        $('#back-to-top-control').addClass('hidden');
                    }
                    $('#content').addClass('no-scroll');
                    $('#footer').hide();
                    try {
                        FB.CustomerChat.hide();
                    } catch (e) {

                    }
                }
            });

            $('.button.close').off().click(function () {
                hideFilter();
            });
        }

        if ($('#filter').length) {
            setTimeout(function(){bindFilters()},512);
        } else {
            $('.sticky-filter-control').addClass('disabled');
        }

        function hideFilter() {
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
            $('#content').removeClass('no-scroll');
            $('#footer').show();
            try {
                FB.CustomerChat.show(false);
            } catch (e) {

            }
        }
    })(jQuery);
</script>
