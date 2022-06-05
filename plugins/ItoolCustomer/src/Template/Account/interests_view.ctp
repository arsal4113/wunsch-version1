<?php
$this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true]);
$this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]);
$this->Html->script('ItoolCustomer.interests' . STATIC_MIN, ['block' => true]);
?>

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
        <?php foreach ($items as $item) : ?>
            <?= $this->element('Feeder.Browse/item', ['item' => $item]) ?>
        <?php endforeach; ?>
    </div>
    <?php if(!(count($items) < 30)): ?>
        <?= $this->element('Feeder.Browse/loader'); ?>
        <div class="button-wrapper">
            <button id="load-more-button"><?= __('Load more') ?></button>
        </div>
    <?php endif; ?>
</div>
<script>
    (function ($) {
        let loading = false,
            filter = <?= json_encode($filter) ?>,
            url = '<?= $this->Url->build([
                'controller' => 'Account',
                'action' => 'interestsView',
                'plugin' => 'ItoolCustomer'
            ]) ?>';

        $('#load-more-button').click(function () {
            if(!loading){
                loading = true;
                $('.button-wrapper').fadeOut(200, function () {
                    $('#category-loader').fadeIn(200)
                });
                filter.page++;
                $.ajax(
                    {
                        'url': url,
                        'data': filter,
                        'method': 'GET',
                        'success': function (data) {
                            $('#category-loader').hide();
                            let jqObj = $('<div/>').html(data).contents(),
                                newItems = jqObj.find(".browse-row").children();

                            $('.browse-row').append(newItems);
                            if(newItems.length === (filter.limit * 2)){
                                $('.button-wrapper').show();
                            }
                            loading = false;
                        },
                        'error': function (data) {
                            $('#category-loader').hide();
                            $('.button-wrapper').show();
                            console.log("error");
                            loading = false;
                        }
                    }
                )
            }

        })
    }(jQuery));
</script>
