<?php
/**
 * @var \App\View\AppView $this
 * @var \ItoolCustomer\Model\Entity\Customer $customer
 */

$this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]);
$this->Html->script('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]);
$this->Html->script('ItoolCustomer.interests' . STATIC_MIN, ['block' => true]);
?>
<div class="container">
    <?php /*<div class="row headline">
        <div class="col-4 col-md-12 account-title">
            <h1><?= __d('itool_customer', 'Interests') ?></h1>
        </div>
        <div class="col-8 col-md-12 account-subtitle">
            <h2><?= __d('itool_customer', 'Zeig uns was du liebst und gestalte deine individuelle Welt') ?></h2>
        </div>
    </div> */ ?>
    <div class="row content-wrapper">
        <div id="account-nav-container">
            <div class="row account-navigation">
                <div class="col-12">
                    <?= $this->cell('ItoolCustomer.AccountNavigation', [$frontUser, 'active' => 'interests']) ?>
                </div>
            </div>
        </div>
        <div id="account-interests-container" class="account-content-container">
            <div class="container interests-content-container">
                <div class="row">
                    <!--< ?= $this->Form->create($customer, ['class' => 'form-horizontal style-form', 'type' => 'file', 'url' => '/customer/account/interests']); ?>-->
                    <?php if (!empty($feederInterests)) : foreach ($feederInterests as $key => $feederInterest) :?>
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3 box">
                            <div class="box-content-container container" style="<?php if ($feederInterest["image"]) : ?><?=  "background-image: url(" . $this->Url->image($feederInterest["image"]) . ");" ?><?php endif; ?>">
                                <!--div class="background-image"><img src="<?= $feederInterest["image"] ?>" /></div-->
                                <div class="box-headline">
                                    <h3><?= __($feederInterest["name"]) ?></h3>
                                    <a href="#" class="select-link select-all"><?= __d('itool_customer', 'Alle auswählen') ?></a>
                                    <!--a href="#" class="select-link deselect-all" style="display: none;"><?= __d('itool_customer', 'Rückgängig machen') ?></a-->
                                </div>
                                <div class="box-content">
                                    <div class="container sub-categories">
                                        <div class="row sub-categories-container" data-parentid="<?= $feederInterest->id ?>">
                                            <?php foreach ($feederInterest->feeder_interest_subcategories as $categoryKey => $feederInterestSubCategory) : ?>
                                                <div class="sub-category sub-cat-id-<?= $feederInterestSubCategory->id ?>" data-catid="<?= $feederInterestSubCategory->id ?>"><span class="sub-category-name" data-catname="<?= __($feederInterest["name"]) ?>"><?= __($feederInterestSubCategory->name) ?></span></div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="button-container">
    <div class="container">
        <div class="row content-wrapper">
            <div class="account-content-container">
                    <div class="button-wrapper col-9 col-sm-6 col-md-4 col-xl-3">
                        <form id="interestForm" method="post" action="<?= $this->Url->build(['controller' => 'Account', 'action' => 'saveInterests', 'plugin' => 'ItoolCustomer']) ?>">
                            <input type="hidden" id="subcategory_ids" name="subcategoryIds">
                            <button type="submit" class="button submit-button disabled"><?= __d('itool_customer', 'Meine Welt entdecken') ?></button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.unselectText = "<?= __d('itool_customer', 'Rückgängig machen') ?>";
    window.selectText = "<?= __d('itool_customer', 'Alle auswählen') ?>";
    (function ($) {
        let interestInfo = <?= json_encode($selectedSubCats) ?>;
        $('.sub-categories-container').each(function () {
            let subcategoryIds = interestInfo[$(this).attr('data-parentid')];
            if(subcategoryIds !== undefined){
                for(let i = 0; i < subcategoryIds.length; i++){
                    $(this).find('.sub-cat-id-' + subcategoryIds[i]).addClass("selected");
                }
            }
        });

        $('.sub-categories-container .sub-category').on('click', function (e) {
            if (!$(this).hasClass('selected')) {
                var subcat_name = $(this).children('.sub-category-name'),
                    item_label = subcat_name.text(),
                    cat_name = subcat_name.data('catname');
                push2dataLayer({
                    'event': 'interestNavigation',
                    'clickedItem': cat_name + ' > ' + item_label,
                    'userGender': '<?= $frontUser->gender ?>'
                });
            }
        });

        $('.select-link').on('click', function (e) {
            if ($(this).hasClass('select-all')) {
                $(this).closest('.box-content-container.container').find('.sub-categories-container .sub-category').each(function () {
                    var subcat_name = $(this).children('.sub-category-name'),
                        item_label = subcat_name.text(),
                        cat_name = subcat_name.data('catname');
                    push2dataLayer({
                        'event': 'interestNavigation',
                        'clickedItem': cat_name + ' > ' + item_label,
                        'userGender': '<?= $frontUser->gender ?>'
                    });
                });
            }
        });

        $('body.itoolcustomer.account.interests #button-container .button-wrapper .submit-button').on('click', function (e) {
            push2dataLayer({
                'event': 'interestSubmit',
                'userGender': '<?= $frontUser->gender ?>'
            });
        });
    })(jQuery);
</script>
<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
