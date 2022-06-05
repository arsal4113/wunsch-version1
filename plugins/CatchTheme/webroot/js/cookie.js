$(function () {
    var document_cookies = document.cookie.split("; "),
        cookies_layer = $('#cookies-layer'),
        close_button = cookies_layer.find('.cookies-close-button'),
        cookie_policy_check = false,
        bodyElement = $('body'),
        sticky_bar = $('.sticky-bar-container'),
        product_page = bodyElement.hasClass('products'),
        mobile_device = window.innerWidth < 768 || window.innerHeight < 480;

    for (var i = 0; i < document_cookies.length; i++) {
        var cookie = document_cookies[i].split("=");
        if (cookie[0] === 'ebay_cookie_policy') {
            cookie_policy_check = true;
        }
    }

    if (!cookie_policy_check) {
        cookies_layer.addClass('show');
        bodyElement.addClass('cookies-layer-shown');
        if (product_page && mobile_device) {
            $('#footer').css('margin-bottom', cookies_layer.height() + sticky_bar.height());
            $('#cookies-layer').css('bottom', sticky_bar.height());
        } else {
            $('#footer').css('margin-bottom', cookies_layer.height());
            $('#cookies-layer').css('bottom', 0);
        }
        close_button.on('click', function (e) {
            var date = new Date(new Date().setFullYear(new Date().getFullYear() + 1));
            document.cookie = 'ebay_cookie_policy=accepted; path=/; expires=' + date.toUTCString();
            cookies_layer.removeClass('show');
            $('body').removeClass('cookies-layer-shown');
            if (product_page && mobile_device) {
                $('#footer').css('margin-bottom', sticky_bar.height());
            } else {
                $('#footer').css('margin-bottom', '0');
            }
        });
    }
    $(window).on('resize', function() {
        mobile_device = window.innerWidth < 768 || window.innerHeight < 480;
        if ($('#cookies-layer').hasClass('show')) {
            if (product_page && mobile_device) {
                $('#footer').css('margin-bottom', cookies_layer.height() + sticky_bar.height());
                $('#cookies-layer').css('bottom', sticky_bar.height());
            } else {
                $('#footer').css('margin-bottom', cookies_layer.height());
                $('#cookies-layer').css('bottom', 0);
            }
        }
    });
});
