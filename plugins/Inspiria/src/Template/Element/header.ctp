<?= $this->Html->css('Inspiria.language-picker.css') ?>
<style>
    .help-link {
        color: #1ab394 !important;
    }
    .help-link:hover {
        color: #FFFFFF !important;
    }

    .help-link:hover, .help-link:active, .help-link:focus {
        outline: none;
    }
</style>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a id='sidebar-toggle-button' class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                    class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span
                    class="m-r-sm text-muted welcome-message"><?= __('Hi') . ", <b>" . ($authUser['email'] ?? '') . "</b> | " . $this->Time->nice(date('l, d-m-Y H:i:s')) ?></span>
            </li>

            <?php if (isset($authUser) && !empty($authUser)) {
                echo "<li>" .
                    $this->Html->link(
                        '<i class="fa fa-sign-out"></i>' . __('Log out'),
                        ['controller' => 'CoreUsers', 'action' => 'logout', 'plugin' => false],
                        ['class' => 'logout', 'escape' => false]
                    ) .
                    "</li>";
            }
            ?>
            <?php if (isset($coreLanguageCodes) && !empty($coreLanguageCodes)) { ?>
                <div class="language-selector pull-right-xs">
                    <div id="language-dropdown" class="dropdown">
                        <button onclick="showDropdown(this)"
                                class="dropbtn flag flag-selector flag-<?= $currentLanguageCode ?>"></button>
                        <div id="myDropdown" class="dropdown-content">
                            <?php foreach ($coreLanguageCodes as $language) {
                                if ($language != $currentLanguageCode) { ?>
                                    <a class="flag flag-<?= $language ?>" href="#"
                                       data-language-code="<?= $language ?>"></a>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </ul>
    </nav>
</div>

<div id="profile-loading-message" hidden><?= __('Your ETC profile is being prepared..') ?></div>

<?php $this->start('script'); ?>
<?= $this->fetch('script') ?>
<script>
    function showDropdown(element) {
        $(element).closest('.dropdown').find('.dropdown-content').toggleClass('show');
    }

    $(window).click(function (event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = $(".dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = $(dropdowns[i]);
                if (openDropdown.hasClass('show')) {
                    openDropdown.removeClass('show');
                }
            }
        }
    });

    $(document).ready(function () {
        $(".language-selector .dropdown-content .flag").click(function (evt) {
            evt.preventDefault();
            $.get('/core_sellers/setLanguage/' + $(this).data('languageCode'), function (data) {
                location.reload();
            });
        });

        $(document).on('click', '#login-button', function (e) {
            var message = document.getElementById("profile-loading-message").innerHTML;
            var form = this.form;
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
