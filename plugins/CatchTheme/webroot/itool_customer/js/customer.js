(function ($) {
    $(function () {
        $(document).ready(function() {
            $('.success-message').each(function () {
                var successMessage = $(this);
                if(successMessage.find($('.alert')).length !== 0) {
                    successMessage.slideDown();
                    setTimeout(function () {
                        successMessage.slideUp();
                        successMessage.children('.alert').remove();
                    }, 6000);
                } else {
                    successMessage.hide();
                }
            });
            $('.error-message').each(function () {
                var errorMessage = $(this);
                if(errorMessage.children('.alert').length !== 0) {
                    errorMessage.slideDown();
                    setTimeout(function () {
                        errorMessage.slideUp();
                        errorMessage.children('.alert').remove();
                    }, 6000);
                } else {
                    errorMessage.hide();
                }
            });
        });

        var isDesktop = $(window).innerWidth() >= 1024;

        $(window).on('resize', function() {
            isDesktop = $(window).innerWidth() >= 1024;
        });

        $('#customer-edit-button').click( function () {
            if ($('#customer-address-edit').hasClass('show')) {
                hideCustomerAddressEdit();
            }
            if ($('#customer-password-edit').hasClass('show')) {
                hidePasswordEdit();
            }
            showCustomerEdit();
        });
        $('#customer-cancel').click( function () {
            hideCustomerEdit();
        });
        $('#customer-address-edit-button').click( function () {
            if ($('#customer-password-edit').hasClass('show')) {
                hidePasswordEdit();
            }
            if ($('#customer-edit').hasClass('show')) {
                hideCustomerEdit();
            }
            showCustomerAddressEdit();
        });
        $('#customer-address-add-button').click( function () {
            if ($('#customer-password-edit').hasClass('show')) {
                hidePasswordEdit();
            }
            if ($('#customer-edit').hasClass('show')) {
                hideCustomerEdit();
            }
            showCustomerAddressAdd();

        });
        $('#customer-address-cancel').click( function () {
            hideCustomerAddressEdit();
        });
        $('#customer-password-edit-button').click( function () {
            if ($('#customer-address-edit').hasClass('show')) {
                hideCustomerAddressEdit();
            }
            if ($('#customer-edit').hasClass('show')) {
                hideCustomerEdit();
            }
            showPasswordEdit();
        });
        $('#customer-password-cancel').click( function () {
            hidePasswordEdit();
        });
        $('#customer-delete-button').click( function () {
            if ($('#customer-edit').hasClass('show')) {
                hideCustomerEdit();
            }
            if ($('#customer-address-edit').hasClass('show')) {
                hideCustomerAddressEdit();
            }
            if ($('#customer-password-edit').hasClass('show')) {
                hidePasswordEdit();
            }
            $('#customer-delete-popup').show();
        });
        $('#customer-delete-cancel').click(
            function () {
                $('#customer-delete-popup').hide();
            }
        );
        $('#customer-delete').click(
            function () {
                $('#customer-delete-confirm').hide();
                $('#customer-delete-loader').show();
            }
        );
        function showCustomerEdit() {
            $('#customer-show').hide();
            $('#customer-edit-button').hide();
            $('#customer-edit').show();
            $('#customer-edit').addClass('show');
            // for gender input design
            $('input[type=radio]').after('<span class="checkmark"></span>');
        }
        function hideCustomerEdit() {
            $('#customer-show').show();
            $('#customer-edit-button').show();
            $('#customer-edit').hide();
            $('#customer-edit').removeClass('show');
            $('label .checkmark').remove();
        }
        function showCustomerAddressEdit() {
            $('#customer-address-show').hide();
            $('#customer-address-edit-button').hide();
            $('#customer-address-edit').show();
            $('#customer-address-edit').addClass('show');
            $('#customer-address-edit .input > input').each( function() {
                var value = $(this).attr('value');
                if ( value === undefined || value === '' ) {
                    $(this).addClass('empty');
                }
            });
        }
        function showCustomerAddressAdd() {
            $('#customer-address-show').hide();
            $('#customer-address-add-button').hide();
            $('#customer-address-edit').show();
            $('#customer-address-edit').addClass('show');
            $('#customer-address-cancel').addClass('add');
            $('#customer-address-edit .input > input').each( function() {
                var value = $(this).attr('value');
                if ( value === undefined || value === '' ) {
                    $(this).addClass('empty');
                }
            });
        }
        function hideCustomerAddressEdit() {
            if ($('#customer-address-cancel').hasClass('add')) {
                $('#customer-address-cancel').removeClass('add');
                $('#customer-address-add-button').show();
            } else {
                $('#customer-address-edit-button').show();
            }
            $('#customer-address-show').show();
            $('#customer-address-edit').hide();
            $('#customer-address-edit').removeClass('show');
        }
        function showPasswordEdit() {
            $('#customer-password-show').hide();
            $('#customer-password-edit-button').hide();
            $('#customer-password-edit').show();
            $('#customer-password-edit').addClass('show');
            $('#customer-password-edit .input > input').each( function() {
                var value = $(this).attr('value');
                if ( value === undefined || value === '' ) {
                    $(this).addClass('empty');
                }
            });
            var passwordInput = null;
            $('#customer-password-edit .input > input').on('click input change focus', function() {
                if (passwordInput !== null && passwordInput.attr('id') !== $(this).attr('id')) {
                    var oldPasswordInput = passwordInput,
                        oldPasswordSwitch = oldPasswordInput.siblings('.switch');
                    oldPasswordInput.attr('type', 'password');
                    oldPasswordInput.removeClass('focus');
                    oldPasswordSwitch.hide();
                    oldPasswordSwitch.addClass('show-password');
                    oldPasswordSwitch.removeClass('hide-password');
                    passwordInput = $(this);
                } else {
                    passwordInput = $(this);
                }
                passwordInput.addClass('focus');
                showHidePassword(passwordInput);
            });
        }

        function hidePasswordEdit() {
            $('#customer-password-show').show();
            $('#customer-password-edit-button').show();
            $('#customer-password-edit').hide();
            $('#customer-password-edit').removeClass('show');
        }

        function showHidePassword(input) {
            var passwordSwitch =  input.closest($('.input')).find('.switch');
            if (passwordSwitch.length === 0) {
                input.closest($('.input')).append('<div class="switch show-password"></div>');
                passwordSwitch =  $(this).closest($('.input')).find('.switch');
            }
            passwordSwitch.show();
            if (passwordSwitch.hasClass('show-password')) {
                passwordSwitch.html('zeigen');
            } else {
                passwordSwitch.html('verbergen');
            }
            passwordSwitch.on('click', function() {
                if (passwordSwitch.hasClass('show-password')) {
                    input.attr('type', 'text');
                    passwordSwitch.addClass('hide-password');
                    passwordSwitch.removeClass('show-password');
                    passwordSwitch.html('verbergen');
                } else {
                    input.attr('type', 'password');
                    passwordSwitch.addClass('show-password');
                    passwordSwitch.removeClass('hide-password');
                    passwordSwitch.html('zeigen');
                }
            });
        }

    });

})(jQuery);
