<?php foreach ($addresses as $address): ?>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= 'Address #' . $address->id ?>
                <?php if($address->core_customer->default_shipping_address_id == $address->id): ?>
                    <span class="label label-info"><?= __('Shipping') ?></span>
                <?php endif; ?>
                <?php if($address->core_customer->default_billing_address_id == $address->id): ?>
                    <span class="label label-warning"><?= __('Billing') ?></span>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <address>
                    <?php if($address->company): ?>
                        <strong><?= $address->company ?></strong><br>
                    <?php endif; ?>
                    <strong><?= $address->firstname . ' ' . $address->lastname ?></strong><br>
                    <?= $address->street_1 ?><br>
                    <?php if($address->street_2): ?>
                        <?= $address->street_2 ?><br>
                    <?php endif; ?>
                    <?= $address->city ?>, <?= $address->postcode ?><br>
                    <?= $address->country_name ?><br>
                    <?php if($address->phone): ?>
                        <abbr title="Phone">P:</abbr> <?= $address->phone ?>
                    <?php endif; ?>
                </address>
            </div>
            <div class="panel-footer">
                <?= $this->Html->link(__('Edit address'), ['controller' => 'CoreCustomerAddresses', 'action' => 'edit', $address->core_customer_id, $address->id], ['id' => 'edit-address-' . $address->id, 'class' => 'btn btn-xs btn-block btn-default btn-outline']) ?>
                <?= $this->Html->link(__('Standard shipping address'), ['controller' => 'CoreCustomers', 'action' => 'setStandardShippingAddress', $address->core_customer_id, $address->id], ['id' => 'standard-shipping-address-' . $address->id, 'class' => 'btn btn-xs btn-block btn-info btn-outline']) ?>
                <?= $this->Html->link(__('Standard billing address'), ['controller' => 'CoreCustomers', 'action' => 'setStandardBillingAddress', $address->core_customer_id, $address->id], ['id' => 'standard-billing-address-' . $address->id, 'class' => 'btn btn-xs btn-block btn-warning btn-outline']) ?>
                <?= $this->Html->link(__('Delete address'), ['controller' => 'CoreCustomerAddresses', 'action' => 'delete', $address->core_customer_id, $address->id], ['id' => 'delete-address-' . $address->id, 'class' => 'btn btn-xs btn-block btn-danger btn-outline', 'confirm' => __('Are you sure you want to delete # {0}?', $address->id)]) ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php $this->start('script') ?>
<script>
    $(document).ready(function () {
        // Open edit address form
        $('[id^=edit-address]').removeAttr('onclick');
        $('[id^=edit-address]').click(function(e) {
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

            $.ajax({
                type: 'get',
                url: this.href,
                success: function(res) {
                    $('#new-address-form').html(res);
                    $.unblockUI();
                },
                error: function(e, res) {
                    $('#new-address-form').html(res);
                    $.unblockUI();
                }
            });
        });

        // Set standard shipping address
        $('[id^=standard-shipping-address]').removeAttr('onclick');
        $('[id^=standard-shipping-address]').click(function(e) {
            e.preventDefault();
            var customerId = <?= $address->core_customer_id ?>;

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

            $.ajax({
                type: 'get',
                url: this.href,
                success: function(res) {
                    $('#new-address-form').html(res);
                    $.ajax({
                        type: 'get',
                        url: '/core_customer_addresses/customerAddresses/' + customerId,
                        success: function(res) {
                            $('#customer-addresses').html(res);
                        },
                        error: function(e, res) {
                            $('#customer-addresses').html(res);
                        }
                    });
                    $.unblockUI();
                },
                error: function(e, res) {
                    $('#new-address-form').html(res);
                    $.unblockUI();
                }
            });
        });

        // Set standard billing address
        $('[id^=standard-billing-address]').removeAttr('onclick');
        $('[id^=standard-billing-address]').click(function(e) {
            e.preventDefault();
            var customerId = <?= $address->core_customer_id ?>;

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

            $.ajax({
                type: 'get',
                url: this.href,
                success: function(res) {
                    $('#new-address-form').html(res);
                    $.ajax({
                        type: 'get',
                        url: '/core_customer_addresses/customerAddresses/' + customerId,
                        success: function(res) {
                            $('#customer-addresses').html(res);
                        },
                        error: function(e, res) {
                            $('#customer-addresses').html(res);
                        }
                    });
                    $.unblockUI();
                },
                error: function(e, res) {
                    $('#new-address-form').html(res);
                    $.unblockUI();
                }
            });
        });

        // Delete address
        $('[id^=delete-address]').removeAttr('onclick');
        $('[id^=delete-address]').click(function(e) {
            e.preventDefault();

            var customerId = <?= $address->core_customer_id ?>;

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

            $.ajax({
                type: 'get',
                url: this.href,
                success: function(res) {
                    $('#new-address-form').html(res);
                    $.ajax({
                        type: 'get',
                        url: '/core_customer_addresses/customerAddresses/' + customerId,
                        success: function(res) {
                            $('#customer-addresses').html(res);
                        },
                        error: function(e, res) {
                            $('#customer-addresses').html(res);
                        }
                    });
                    $.unblockUI();
                },
                error: function(e, res) {
                    $('#new-address-form').html(res);
                    $.unblockUI();
                }
            });
        });
    });
</script>
<?php $this->end() ?>

