<?php
$this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true]);
$this->Html->script('ItoolCustomer.interests' . STATIC_MIN, ['block' => true]);
$this->assign('title', h($metaTitle ?? ''));
$this->assign('description', h($metaDescription ?? ''));

?>
<?php if (!$isAjax) : ?>
<div class="col-12">
    <div class="row">
        <div class="col-12 interest-header">
            <div class="blur-background-container">
                <div class="blur-background-wrapper">
                    <div class="blur-background"></div>
                </div>
            </div>
            <h1><?= __("My World") ?></h1>
            <div>
                <button class="submit-button"><?= __("Show different Products") ?></button>
            </div>
            <div>
                <a class="change-link"
                   href="<?= $this->Url->build([
                       'plugin' => 'ItoolCustomer',
                       'controller' => 'Account',
                       'action' => 'interests',
                       'override'
                   ]) ?>">
                    <?= __("Change my interests") ?>
                </a>
            </div>
        </div>
    </div>
    <div class="row browse-row">
        <?php endif; ?>
        <?php
        foreach ($items as $item) :
            $uniqueId = md5($item->item_id . $item->title);
            ?>
            <?= $this->element('Feeder.Browse/item', ['item' => $item]) ?>
            <script>
                var item_<?= $uniqueId ?> = document.getElementById('<?= $uniqueId ?>');

                if (!productImpressions.hasOwnProperty('el_<?= $uniqueId ?>')) {
                    productImpressions.el_<?= $uniqueId ?> = {
                        el: document.getElementById('<?= $uniqueId ?>'),
                        cb: function () {
                            pushEcommerce('productImpression', processProductData(<?= json_encode($this->Feeder->filterProductData($item, 'Recommendations')) ?>));
                        }
                    };
                }
            </script>
        <?php endforeach; ?>
        <script>
            var filter = <?= json_encode($filter) ?>;
            var itemCount = <?= json_encode(count($items)) ?>;
        </script>
        <?php if (!$isAjax) : ?>
    </div>
    <?php if(!(count($items) < $filter['limit'] ?? 30)): ?>
        <?= $this->element('Feeder.Browse/loader'); ?>
    <?php endif; ?>
</div>
<script>
    (function ($) {
            google.userGender = '<?= $frontUser->gender ?>';

            const url = '<?= $this->Url->build([
                    'controller' => 'Interests',
                    'action' => 'view',
                    'plugin' => 'Feeder'
                ]) ?>';
            $('#load-more-products').click(function () {
                const self = $(this);
                self.hide();
                $('#category-loader .animated-loader').show();
                filter.page++;
                $.ajax(
                    {
                        'url': url,
                        'data': filter,
                        'method': 'GET',
                        'success': function (data) {
                            $('.browse-row').append(data);
                            try {
                                $('.wishlist-item-link').wishlistify();
                            } catch (e) {
                                console.log(e);
                            }
                            if (itemCount < filter.limit) {
                                $('#category-loader').hide();
                            }else{
                                self.show();
                                $('#category-loader .animated-loader').hide();
                            }
                        },
                        'error': function (data) {
                            self.show();
                            $('#category-loader .animated-loader').hide();
                            console.log("error");
                        }
                    }
                );
            });

            $('.change-link').click(function () {
                push2dataLayer({
                    'event': 'interestChange',
                    'userGender': '<?= $frontUser->gender ?>'
                });
            });

            $('#header').header({
                catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>',
                type: 'white'
            });
    })(jQuery);
</script>
<?php endif;
