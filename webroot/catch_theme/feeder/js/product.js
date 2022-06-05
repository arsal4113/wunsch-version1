function resizeDescriptionIframe(obj) {
    obj.style.height = (obj.contentWindow.document.body.scrollHeight + 30) + 'px';
}

function addThumbnailsEvents(obj) {
    var current_image = $('.product-view-row .product-gallery .current-image > img');

    obj.on('click', function (e) {
        if (!$(this).hasClass('img-active')) {

            obj.removeClass('img-active');

            current_image.attr('src', $(this).data('image-url'));

            $(this).addClass('img-active');
        }
    });
}

function addTabbedContentsEvents(element, toMobileAccordion) {
    $(element).find('.tab-label').click(
        function (e) {
            var label = $(this);
            var currentTab = $(element).find('.tabbed-content.active');
            var newTab = $('#' + $(this).data('tab-id'));
            var wasActive = newTab.hasClass('active');
            if (!wasActive) {
                if (currentTab.length) {
                    currentTab.fadeOut(125, function () {
                        $(element).find('.active').removeClass('active');
                        newTab.fadeIn(125).addClass('active');
                        label.addClass('active');
                    });
                } else {
                    newTab.fadeIn(125).addClass('active');
                    label.addClass('active');
                }
            } else {
                if ($(window).width() <= 480 && wasActive && toMobileAccordion) {
                    currentTab.removeClass('active')
                    label.removeClass('active');
                    currentTab.fadeOut(125);
                }
            }

        }
    );
}

function setItemQty() {
    var increment_button = $('#inc-button'),
        decrement_button = $('#dec-button'),
        limit = $('#qty option').length,
        value = 1;
    increment_button.on('click', function () {
        if (value < limit - 1) {
            value += 1;
            $('#qty').val(value);
            $('#qty').find('option[value="' + (value - 1) + '"]').removeAttr('selected');
            $('#qty').find('option[value="' + value + '"]').attr("selected", true);
            $('#qty-option').removeData();
            $('#qty-option').html(value);
            increment_button.addClass('clicked');
            setTimeout(function () {
                increment_button.removeClass('clicked');
            }, 1000);
        }
    });
    decrement_button.on('click', function () {
        if (value > 1) {
            value -= 1;
            $('#qty').val(value);
            $('#qty').find('option[value="' + (value + 1) + '"]').removeAttr('selected');
            $('#qty').find('option[value="' + value + '"]').attr("selected", true);
            $('#qty-option').removeData();
            $('#qty-option').html(value);
            decrement_button.addClass('clicked');
            setTimeout(function () {
                decrement_button.removeClass('clicked');
            }, 1000);
        }
    });
}

function shareItemLink() {
    $('#share-item-switch').on('click', function () {

        if ($(window).width() < 480) {
            if ($('#social-sharing-pop-up').hasClass('active')) {
                $('#social-sharing-pop-up').removeClass('active');
            } else {
                $('#social-sharing-pop-up').addClass('active');
            }
        }
    });
    $('#pop-up-close').on('click', function () {
        if ($('#social-sharing-pop-up').hasClass('active')) {
            $('#social-sharing-pop-up').removeClass('active');
        }
    });
    $(window).on('resize', function(){
        if ($(window).width() > 480) {
            $('#social-sharing-pop-up').removeClass('active');
        }
    });
}

$(function () {
    var gallery_thumbnails = $('.product-view-row .product-gallery .thumbnail-image'),
        tabbed_switches = $('.product-view-row .tabbed-contents .tab-label'),
        tabbed_contents = $('.product-view-row .tabbed-contents .tabbed-content'),
        tabbed_contents_mobile = $('.product-view-row .tabbed-contents .tabbed-content.mobile'),
        tabbed_info_switches = $('.item-info-wrapper.tabbed-contents .tab-labels .tab-label'),
        tabbed_info_contents = $('.item-info-wrapper.tabbed-contents .tabbed-content');

    gallery_thumbnails.first().addClass('img-active');

    addThumbnailsEvents(gallery_thumbnails);

    tabbed_switches.first().addClass('active');
    tabbed_contents.first().show();
    tabbed_contents_mobile.first().show();

    tabbed_info_switches.first().addClass('active');
    tabbed_info_contents.first().show();

    addTabbedContentsEvents('.product-view-row .tabbed-contents', true);
    addTabbedContentsEvents('.item-info-wrapper.tabbed-contents', false);
    setItemQty();
    shareItemLink();
});
