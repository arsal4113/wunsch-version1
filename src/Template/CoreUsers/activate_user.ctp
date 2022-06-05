<h3 class="margin-bottom-20 forgot-password-text text-center white"><?= __('Activate Your Account') ?></h3>
<?= $this->Form->create(null, ['class' => 'm-t', 'role' => 'form']) ?>
<div class="form-group">
    <?= $this->Form->input('user_email', ['value' => $email, 'label' => false, 'class' => 'form-control', 'placeholder' => __('Please type your email here...'), 'autofocus', 'required', 'autocomplete'=>'off']) ?>
</div>
<?= $this->Form->button('<i class="fa fa-paper-plane"></i> ' . __('Activate Account'), ['id' => 'login-button', 'class' => 'btn btn-primary block full-width m-b']); ?>
<div class="forgot-password text-center">
    <?= $this->Html->link('<i class="fa fa-mail-reply"></i>' . ' ' . __('Back to login'), ['controller' => 'CoreUsers', 'action' => 'login', 'plugin' => false, 'prefix' => false], ['escape' => false]) ?>
</div>
<?= $this->Form->end() ?>

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

    });
</script>
<?php $this->end(); ?>