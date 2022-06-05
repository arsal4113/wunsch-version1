<?php
/**
 * @var \App\View\AppView $this
 * @var \ItoolCustomer\Model\Entity\Customer $customer
 */

$this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]);
$this->Html->script('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]);
?>
<div id="customer-delete-popup" class="popup-shown" style="display: none;">
    <div class="customer-popup-wrapper box">
        <div id="customer-delete-confirm">
            <div class="delete-img-wrapper">
                <div class="delete-image"></div>
            </div>
            <div class="delete-text">
                <?= __d('itool_customer', 'Bist du sicher, dass du dein Konto löschen möchtest?
                                    Es gibt noch so viele wunderbare Catchs, die ein Zuhause suchen. Deine Wunschliste und Kontaktdaten würden verloren gehen, wenn du uns verlässt.') ?>
            </div>
            <?= $this->Form->create(null, ['url' => ['controller' => 'Account', 'action' => 'delete']]); ?>
            <?= $this->Form->hidden('type', ['value' => 'delete']) ?>
            <div class="col-12 col-md-8 button-wrapper">
                <?= $this->Form->submit(__d('itool_customer', 'Konto endgültig löschen'), ['id' => 'customer-delete']) ?>

                <div id="customer-delete-cancel" class="button submit-button popup-close">
                    <span><?= __d('itool_customer', 'Cancel') ?></span>
                </div>

            </div>
            <?= $this->Form->end() ?>
        </div>
        <div id="customer-delete-loader" style="display: none;">
            <div class="loader-text">
                <span class="bold"> <?= __d('itool_customer', 'Dein Konto wird gelöscht') ?> </span><br>
                <span>Bitte warten, das kann einige Momente dauern...</span>
            </div>
            <div class="delete-account-loader">
                <span class="loader-circle"></span>
                <span class="loader-circle"></span>
                <span class="loader-circle"></span>
                <span class="loader-circle"></span>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row headline account-title">
        <div class="col-12">
            <h1><?= __d('itool_customer', 'Account edit') ?></h1>
        </div>
    </div>
    <div class="row content-wrapper">
        <div id="account-nav-container">
            <div class="row account-navigation">
                <div class="col-12">
                    <?= $this->cell('ItoolCustomer.AccountNavigation', [$frontUser, 'active' => 'edit']) ?>
                </div>
            </div>
        </div>
        <div id="account-edit-container" class="account-content-container">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 box" id="customer-edit-wrapper">
                        <div class="row box-headline">
                            <div class="col-12">
                                <h3><?= __d('itool_customer', 'Contact data') ?></h3>
                            </div>
                        </div>
                        <div class="row box-content" id="customer-show">
                            <div class="container success-message-wrapper">
                                <div class="col-12 success-message">
                                    <?= $this->Flash->render('customer_success') ?>
                                </div>
                            </div>
                            <div class="container error-message-wrapper">
                                <div class="col-12 error-message">
                                    <?= $this->Flash->render('customer_error') ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <?php /** @var \ItoolCustomer\Model\Entity\Customer $customer */ ?>
                                <customer>
                                    <?= $customer->first_name ?> <?= $customer->last_name ?><br>
                                    <?= $customer->email ?><br>
                                </customer>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 edit-link">
                                <span id="customer-edit-button"><?= __d('itool_customer', 'Edit contact data') ?></span>
                            </div>
                        </div>

                        <div id="customer-edit" class="content-edit-wrapper" style="display: none;">
                            <?= $this->Form->create($customer) ?>
                            <?= $this->Form->hidden('type', ['value' => 'customer']) ?>
                            <div class="col-12 customer-form-content">
                                <div class="row box-content edit">
                                    <div class="col-12 input-field"><?= $this->Form->radio('gender',
                                            [['value' => 'M', 'text' => __('Male')],
                                                ['value' => 'F', 'text' => __('Female')],
                                                ['value' => 'D', 'text' => __('Divers')]
                                            ]); ?>
                                    </div>
                                    <div class="col-12 input-field"><?= $this->Form->control('first_name') ?></div>
                                    <div class="col-12 input-field"><?= $this->Form->control('last_name') ?></div>
                                    <div class="col-12 input-field"><?= $this->Form->control('email',
                                            ['disabled' => 'disabled']) ?>
                                    </div>
                                </div>
                                <div class="row button-wrapper">
                                    <div class="col-10 col-md-12 input-field">
                                        <?= $this->Form->submit(__d('itool_customer', 'Save'), ['class' => 'submit-button']) ?>
                                        <a href="#" id="customer-cancel" class="cancel">
                                            <?= __d('itool_customer', 'Cancel') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 box" id="customer-address-wrapper" >
                        <div class="row box-headline">
                            <div class="col-12">
                                <h3><?= __d('itool_customer', 'Shipping address') ?></h3>
                            </div>
                        </div>
                        <div class="row box-content" id="customer-address-show">
                            <div class="container success-message-wrapper">
                                <div class="col-12 success-message">
                                    <?= $this->Flash->render('address_success') ?>
                                </div>
                            </div>
                            <div class="container error-message-wrapper">
                                <div class="col-12 error-message">
                                    <?= $this->Flash->render('address_error') ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <?php /** @var \ItoolCustomer\Model\Entity\CustomerAddress $customerAddress */ ?>
                                <?php if (!$customerAddress) : ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <?= __d('itool_customer', 'Please add your shipping address') ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <address>
                                        <?= $customerAddress->first_name ?> <?= $customerAddress->last_name ?><br>
                                        <?= $customerAddress->street_line_1 ?><br>
                                        <?php if ($customerAddress->street_line_2) : ?>
                                            <?= $customerAddress->street_line_2 ?><br>
                                        <?php endif; ?>
                                        <?= $customerAddress->postal_code ?> <?= $customerAddress->city ?> <br>
                                        <?= $customerAddress->core_country->name ?> <?php if ($customerAddress->state) : ?> - <?php endif; ?> <?= $customerAddress->state ?><br>
                                        <?= $customer->email ?><br>
                                        <?= $customerAddress->phone_number ?>
                                    </address>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <?php /** @var \ItoolCustomer\Model\Entity\CustomerAddress $customerAddress */ ?>
                            <?php  if ($customerAddress) : ?>
                                <div class="col-12 edit-link">
                                    <span id="customer-address-edit-button"><?= __d('itool_customer', 'Edit shipping address') ?></span>
                                </div>
                            <?php else : ?>
                                <div class="col-12 edit-link">
                                    <span id="customer-address-add-button"><?= __d('itool_customer', 'Add shipping address') ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div id="customer-address-edit" class="content-edit-wrapper" style="display: none;">
                            <?= $this->Form->create($customerAddress) ?>
                            <?= $this->Form->hidden('type', ['value' => 'customer_address']) ?>
                            <div class="col-12 customer-form-content">
                                <div class="row box-content edit">
                                    <div class="col-6 input-field"><?= $this->Form->control('first_name',
                                            ['name' => 'first_name',  'placeholder' => __d('itool_customer', 'First name')]) ?></div>
                                    <div class="col-6 input-field"><?= $this->Form->control('last_name',
                                            ['name' => 'last_name', 'placeholder' => __d('itool_customer', 'Last name')]) ?></div>
                                    <div class="col-12 input-field"><?= $this->Form->control('street_line_1',
                                            ['placeholder' => __d('itool_customer', 'Street and number')]) ?></div>
                                    <div class="col-12 input-field"><?= $this->Form->control('street_line_2',
                                            ['placeholder' => __d('itool_customer', 'Street additional')]) ?></div>
                                    <div class="col-6 input-field"><?= $this->Form->control('postal_code',
                                            ['placeholder' => __d('itool_customer', 'Zip')]) ?></div>
                                    <div class="col-6 input-field"><?= $this->Form->control('city',
                                            ['placeholder' => __d('itool_customer', 'City')]) ?></div>
                                    <div class="col-12 input-field"><?= $this->Form->control('state',
                                            ['placeholder' => __d('itool_customer', 'State')]) ?></div>
                                    <div class="col-12 input-field"><?= $this->Form->control('phone_number',
                                            ['placeholder' => __d('itool_customer', 'Phone number')]) ?></div>
                                    <div class="col-12 col-md-6 input-field"><?= $this->Form->control('country_dummy',
                                            [
                                                'id' => 'country',
                                                'value' => __d('itool_customer', 'GERMANY'),
                                                'disabled' => 'disabled'
                                            ]) ?>
                                    </div>
                                </div>
                                <div class="row button-wrapper">
                                    <div class="col-10 col-md-12 input-field">
                                        <?= $this->Form->submit(__d('itool_customer', 'Save'), ['class' => 'submit-button']) ?>
                                        <a href="#" id="customer-address-cancel" class="cancel">
                                            <?= __d('itool_customer', 'Cancel') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 box" id="customer-password-wrapper" >
                        <div class="row box-headline">
                            <div class="col-12">
                                <h3><?= __('Password') ?></h3>
                            </div>
                        </div>
                        <div class="row box-content" id="customer-password-show">
                            <div class="container success-message-wrapper">
                                <div class="col-12 success-message">
                                    <?= $this->Flash->render('password_success') ?>
                                </div>
                            </div>
                            <div class="container error-message-wrapper">
                                <div class="col-12 error-message">
                                    <?= $this->Flash->render('password_error') ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <?php /** @var \ItoolCustomer\Model\Entity\Customer $customer */ ?>
                                <?php if ($customer->password) { ?>
                                    ***********************
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 edit-link">
                                <span id="customer-password-edit-button"><?= __d('itool_customer', 'Edit password') ?></span>
                            </div>
                        </div>
                        <div id="customer-password-edit" class="content-edit-wrapper" style="display: none;">
                            <?= $this->Form->create($customer) ?>
                            <?= $this->Form->hidden('type', ['value' => 'password']) ?>
                            <div class="col-12 customer-form-content">
                                <div class="row box-content edit" >
                                    <div class="col-12 input-field">
                                        <?= $this->Form->control('old_password', ['type' => 'password', 'placeholder' => __d('itool_customer', 'Enter your old password')]) ?>
                                    </div>

                                    <div class="col-12 input-field">
                                        <?= $this->Form->control('password', ['type' => 'password', 'value' => '', 'placeholder' => __d('itool_customer', 'New Password')]) ?>
                                    </div>
                                    <div class="col-12 input-field">
                                        <?= $this->Form->control('password_repeat', ['type' => 'password', 'value' => '', 'placeholder' => __d('itool_customer', 'Confirm New Password')]) ?>
                                    </div>
                                </div>
                                <div class="row button-wrapper">
                                    <div class="col-10 col-md-12 input-field">
                                        <?= $this->Form->submit(__d('itool_customer', 'Save'), ['class' => 'submit-button']); ?>
                                        <a href="#" id="customer-password-cancel" class="cancel">
                                            <?= __d('itool_customer', 'Cancel') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12" id="customer-delete-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="row box-headline">
                        <div class="col-12 edit-link delete">
                            <span id="customer-delete-button"><?= __d('itool_customer', 'Delete account') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(function() {
        $("#postal-code").on("keyup change", function(e) {
            console.log(e)
            if ((e.keyCode >= 48 && e.keyCode <= 86) || (e.keyCode >= 96 && e.keyCode <= 105)) {
                let value = $("#postal-code").val();
                if (value.length == 5) {
                    $.ajax({
                        type: "GET",
                        url: "/zip-data/zip-data-zips/get-by-code/" + value,
                        contentType: "application/json",
                        headers: {
                            'Access-Control-Allow-Origin': '*'
                        },
                        crossDomain: true,
                        dataType: "json",
                        success: function(response) {

                            if (response.ZipData.city) {
                                let city = response.ZipData.city,
                                    area = response.ZipData.area;
                                $("#state").val(area);
                                $("#city").val(city);
                            }
                        },
                        error: function(err) {
                            console.log({
                                err
                            });
                        }
                    });
                }
            }

        });
    });
    var placeSearch, autocomplete;

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('route'), {types: ['geocode'],
                componentRestrictions: {country: 'de'}});

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            if (document.getElementById(component)) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                if (document.getElementById(addressType)) {
                    document.getElementById(addressType).value = val;
                } else if (addressType === 'street_number'){
                    var streetNumber = val;
                }
            }
        }
        if (!document.getElementById('street_number') && streetNumber) {
            document.getElementById('route').value += ' ' + streetNumber;
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle(
                    {center: geolocation, radius: position.coords.accuracy});
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= \Cake\Core\Configure::read('googleMapsApi.apiKey') ?>&libraries=places&callback=initAutocomplete&language=de"
        async defer></script>

<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
