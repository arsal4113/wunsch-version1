
<h3 class="margin-top-100 text-center white"><?= __('Temporarily unavailable for Maintenance') ?></h3>

<p class="margin-bottom-20 text-center white"><?= __('We are performing scheduled amintenance. We should be back online shortly.') ?></p>


<?php $this->start('script'); ?>
<script>
    function showDropdown(element) {
        $(element).closest('.dropdown').find('.dropdown-content').toggleClass('show');
    }

    $(window).click(function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = $(".dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = $(dropdowns[i]);
                if(openDropdown.hasClass('show')) {
                    openDropdown.removeClass('show');
                }
            }
        }
    });

    $(document).ready(function() {

        $(".language-selector .dropdown-content .flag").click(function (evt) {
            evt.preventDefault();
            $.get('/core_sellers/setLanguage/' + $(this).data('languageCode'), function (data) {
                location.reload();
            });
        });

        $(document).on('click', '#login-button', function(e) {
            var form = this.form;
            var message = document.getElementById("profile-loading-message").innerHTML;
            e.preventDefault();
            $.blockUI({
                message: message,
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: 1,
                    color: '#fff',
                    top: '10px',
                    left: '',
                    right: '10px'
                },
                overlayCSS: {
                    'z-index': '9999'
                }
            });

            setTimeout(function () {
                form.submit();
            }, 200);
        });
    });
</script>
<?php $this->end(); ?>
