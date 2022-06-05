<?= $this->Form->create($coreCustomerAddress, ['id' => 'new-address-form', 'class' => 'form-horizontal style-form']); ?>
<?= $this->Form->hidden('core_seller_id', ['value' => $coreCustomerAddress->core_seller_id]) ?>
<?= $this->Form->hidden('core_customer_id', ['value' => $coreCustomerAddress->core_customer_id]) ?>

<div class="col-lg-5">
    <div class="form-group">
        <label class="col-sm-2 control-label"><?= $this->Form->label(__('company')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('company', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"><?= $this->Form->label(__('firstname')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('firstname', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"><?= $this->Form->label(__('lastname')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('lastname', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"><?= $this->Form->label(__('phone')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('phone', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
</div>
<div class="col-lg-7">
    <div class="form-group">
        <label class="col-sm-3 control-label"><?= $this->Form->label(__('street_1')); ?></label>
        <div class="col-sm-9">
            <?= $this->Form->input('street_1', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?= $this->Form->label(__('street_2')); ?></label>
        <div class="col-sm-9">
            <?= $this->Form->input('street_2', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?= $this->Form->label(__('postcode')); ?></label>
        <div class="col-sm-3">
            <?= $this->Form->input('postcode', ['label' => false, 'class' => 'form-control']) ?>
        </div>
        <label class="col-sm-3 control-label"><?= $this->Form->label(__('city')); ?></label>
        <div class="col-sm-3">
            <?= $this->Form->input('city', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 col-sm-3 control-label"><?= $this->Form->label(__('Country')); ?></label>
        <div class="col-sm-3">
            <?= $this->Form->input('country_code', ['label' => false, 'class' => 'form-control', 'options' => $countryCodes]) ?>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-8">
            <?= $this->Form->submit(__('Update address'), ['id' => 'save-address', 'class' => 'btn btn-sm btn-primary pull-right', 'data-url' => '/core_customer_addresses/edit/' . $coreCustomerAddress->core_customer_id . '/' . $coreCustomerAddress->id]) ?>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>

<?php $this->start('script') ?>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('#save-address').click(function(e) {
            e.preventDefault();
            $.blockUI({
                message: 'Loading',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff',
                    'z-index': 9999
                },
                overlayCSS: {
                    'z-index': '9999'
                }
            });

            var data = {
                'CoreCustomerAddresses': {
                    'core_seller_id': $('input[name=core_seller_id]').val(),
                    'core_customer_id': $('input[name=core_customer_id]').val(),
                    'company': $('input[name=company]').val(),
                    'firstname': $('input[name=firstname]').val(),
                    'lastname': $('input[name=lastname]').val(),
                    'email': $('input[name=email]').val(),
                    'phone': $('input[name=phone]').val(),
                    'street_1': $('input[name=street_1]').val(),
                    'street_2': $('input[name=street_2]').val(),
                    'postcode': $('input[name=postcode]').val(),
                    'city': $('input[name=city]').val(),
                    'country_code': $('#country-code').val()
                }
            };

            $.ajax({
                type: 'post',
                url: $(this).attr('data-url'),
                data: data,
                success: function(res, textStatus, xhr) {
                    $('#new-address-form').html(res);
                    $.ajax({
                        type: 'get',
                        url: '/core_customer_addresses/customerAddresses/' + $('input[name=core_customer_id]').val(),
                        success: function(res) {
                            $('#customer-addresses').html(res);
                        },
                        error: function(e, res) {
                            $('#customer-addresses').html(res);
                        }
                    });
                    $.unblockUI();
                }
            });
        });
    });
</script>
<?php $this->end() ?>
