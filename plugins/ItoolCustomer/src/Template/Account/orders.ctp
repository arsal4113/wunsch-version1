<?php
/**
 * @var \App\View\AppView $this
 * @var \EbayCheckout\Model\Entity\EbayCheckoutSession[] $ebayCheckoutSessions
 */
?>
<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]); ?>
<div class="container">
    <div class="row headline account-title">
        <div class="col-12">
            <h1><?= __d('itool_customer', 'Orders') ?></h1>
        </div>
    </div>
    <div class="row content-wrapper">
        <div id="account-nav-container">
            <div class="row account-navigation">
                <div class="col-12">
                    <?= $this->cell('ItoolCustomer.AccountNavigation', [$frontUser, 'active' => 'orders']) ?>
                </div>
            </div>
        </div>
        <div class="order-wrapper account-content-container">
            <?php if (empty($ebayCheckoutSessions->toArray())) : ?>
                    <div class="order empty">
                        <h2><?= __d('itool_customer', 'No orders yet.') ?></h2>
                        <?= $this->Html->link(__d('itool_customer', 'Find your first catch!'), '/world-of-trends', ['class' => 'find-first-catch']) ?>
                    </div>
            <?php else: ?>
                <div class="order box order-table-header">
                    <div class="row order-info order-table-header">
                        <div class="col-6 col-md-6 order-overview">
                            <div class="col-12 col-md-6 order-info-box">
                                <span class="bold"><?= __d('itool_customer', 'Order date'); ?></span>
                            </div>
                            <div class="order-info-box">
                                <span class="bold"><?= __d('itool_customer', 'Order number') ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 order-overview">
                            <div class="order-info-box order-total">
                                <span class=" bold"><?= __d('itool_customer', 'Order total'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($ebayCheckoutSessions as $ebayCheckoutSession) : ?>
                    <div class="order box">
                        <div class="row order-info">
                            <div class="col-6 col-md-6 order-overview">
                                <div class="col-12 col-md-6 order-info-box">
                                    <span class="title bold"><?= __d('itool_customer', 'Order date'); ?></span>
                                    <span class="buy-date"><?= \Cake\I18n\Time::parse($ebayCheckoutSession->created)->i18nFormat('dd.MM.yyyy') ?></span>
                                </div>
                                <div class="order-info-box">
                                    <span class="title bold"><?= __d('itool_customer', 'Order number') ?></span>
                                    <span class="order-id"><?= __d('itool_customer', $ebayCheckoutSession->purchase_order_id) ?></span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 order-overview">
                                <div class="order-info-box order-total">
                                    <span class="title bold"><?= __d('itool_customer', 'Order total'); ?></span>
                                    <span>
                                        <?php foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) {
                                            if ($total->code == 'total') {
                                                echo \Cake\I18n\Number::currency($total->value, $total->currency);
                                                break;
                                            }
                                        } ?>
                                    </span>
                                    <span class="tax-info"><?= __('inkl. MwSt.') ?></span>
                                </div>
                            </div>
                            <div class="row col-12 col-md-2 order-number">
                                <div class="col-12 order-details">
                                    <?= $this->Html->link(__d('itool_customer', 'Details'), [
                                        'controller' => 'Account',
                                        'action' => 'orderView',
                                        'plugin' => 'ItoolCustomer',
                                        $ebayCheckoutSession->purchase_order_id
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()) : ?>
                    <div class="row pagination">
                        <span><?= $this->Paginator->prev('<') ?></span>
                        <div class="">
                            <ul id="pagination-bar">
                                <?= $this->Paginator->numbers() ?>
                            </ul>
                        </div>
                        <span><?= $this->Paginator->next('>') ?></span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
