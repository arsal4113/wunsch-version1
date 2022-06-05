<div id="customer-delete-popup" class="popup-shown">
    <div class="customer-popup-wrapper box">
        <div id="customer-delete-success">
            <div class="loader-text">
                <span class="bold"> <?= __d('itool_customer', 'Dein Konto wurde gelöscht') ?> </span><br>
                <span><?= __d('itool_customer', 'Wir hoffen, du findest trotzdem deinen perfekten Catch! Lass dich inspirieren!') ?></span>
            </div>
            <div class="delete-img-wrapper">
                <div class="delete-image success"></div>
            </div>
            <div class="col-12 col-md-8 button-wrapper">
                <a href="/">
                <div class="submit">
                    <div class="button redesign-button popup-close">
                        <span><?= __d('itool_customer', 'Zurück zur Startseite') ?></span>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.popup-message .popup-close button').on('click', function (e) {
        $('#messages .popup-shown').fadeOut(255);
    });
</script>
