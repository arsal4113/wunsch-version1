$('.spin-icon').click(function () {
    $(".theme-config-box").toggleClass("show");
});

var collapse = $.cookie("collapse_menu");
if (collapse == 'on') {
    $('#collapsemenu').prop('checked','checked');
}

var userDashboard = $.cookie("user_dashboard");
if (userDashboard == 'on') {
    $('#userdashboard').prop('checked','checked');
}

// Enable/disable collapse menu
$('#collapsemenu').click(function () {
    if ($('#collapsemenu').is(':checked')) {
        $("body").addClass('mini-navbar');
        SmoothlyMenu();
        $.cookie("collapse_menu", 'on');
    } else {
        $("body").removeClass('mini-navbar');
        SmoothlyMenu();
        $.cookie("collapse_menu", 'off');
    }

    var url = window.location.origin + window.location.pathname
    window.location.href = url;
});

// Enable/disable user dashboard
$('#userdashboard').click(function () {
    if ($('#userdashboard').is(':checked')) {
        $.cookie("user_dashboard", 'on');
    } else {
        $.cookie("user_dashboard", 'off');
    }

    var url = window.location.origin + window.location.pathname
    window.location.href = url;
});
