<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Edit Customer') ?></h2>
        <ol class="breadcrumb">
            <li><?= __('Customers') ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Customers'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $coreCustomer->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $coreCustomer->id)]
                    )
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('General Information') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->Form->create($coreCustomer, ['class' => 'form-horizontal style-form']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('Seller')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('core_seller_id', ['label' => false, 'class' => 'form-control', 'options' => $coreSellers]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('User'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('core_user_id', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
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
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('email')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('email', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('tax_certificate')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('tax_certificate', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Address Book') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                    <div class="form-group">
                        <div class="col-sm-4 text-right pull-right">
                            <?= $this->Html->link(__('Add new address'), ['controller' => 'CoreCustomerAddresses', 'action' => 'add', $coreCustomer->id], ['id' => 'new-address', 'class' => 'btn btn-xs btn-primary btn-outline']) ?>
                            <?= $this->Html->link(__('<i class="fa fa-remove"></i>'), '#', ['escape' => false, 'id' => 'close-new-address-form', 'class' => 'btn btn-xs btn-danger btn-outline']) ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hr-line-dashed"></div>
                </div>

                <div class="col-lg-12" id="new-address-form"></div>

                <div class="col-lg-12" id="customer-addresses">
                <?php if (!empty($coreCustomer->core_customer_addresses)) { ?>
                    <?php foreach ($coreCustomer->core_customer_addresses as $address): ?>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?= 'Address #' . $address->id ?>
                                <?php if($coreCustomer->default_shipping_address_id == $address->id): ?>
                                    <span class="label label-info"><?= __('Shipping') ?></span>
                                <?php endif; ?>
                                <?php if($coreCustomer->default_billing_address_id == $address->id): ?>
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
                                    <?php if($address->street_2): ?>
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
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script') ?>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        // Open new address form
        $('#new-address').removeAttr('onclick');
        $('#new-address').click(function(e) {
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

        // Close new address form
        $('#close-new-address-form').click(function() {
            $('#new-address-form').html("");
        });

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

            var customerId = <?= $coreCustomer->id ?>;

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

            var customerId = <?= $coreCustomer->id ?>;

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

            var customerId = <?= $coreCustomer->id ?>;

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

