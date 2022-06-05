<?php if ($item != "smallBanner" && $item != "largeBanner"): ?>
    <?php $uniqueId = md5(is_object($item) ? ($item->item_id . $item->title) : (time() . microtime())) ?>

    <div class="col-6 col-md-3 browse-col" id="<?= $uniqueId ?>">
        <div class="card">
            <?php
            $itemId = $item->item_id;
            $browseItemId = md5($itemId);
            $itemTimeLimit = $item->end_date;
            $timeNow = Cake\I18n\Time::now();
            $timeLimited = false;
            if (!empty($item->item_group_id)) {
                $itemId = $item->item_group_id;
            }


            $itemFastFree = ((isset($item->delivery_duration_de) && $item->delivery_duration_de <= 3) && (isset($item->delivery_cost_de) && $item->delivery_cost_de == 0));
            $itemSoldOut = ($item->quantity && $item->quantity < 3);
            $itemTopRated = (isset($item->rating) && $item->rating >= 4.5);
            ?>

            <a href="<?= $this->Url->build([
                'controller' => 'Products',
                'action' => 'view',
                'plugin' => 'Feeder',
                $itemId,
                \Cake\Utility\Text::slug($item->title)
            ]); ?>">
                <div class="card-img-wrapper">
                    <?= $this->Html->image('lazy-placeholder.png', [
                        'data-src' => $item->thumbnail_url ?? $item->image_url,
                        'data-srcset' => $item->thumbnail_url ?? $item->image_url,
                        'alt' => $this->Feeder->htmlAttributeSafe($item->title),
                        'class' => 'lazyload card-img-top'
                    ]) ?>
                </div>
                <div class="card-label-wrapper">
                    <?php if ($item->energy_efficiency ) : ?>
                        <div class="eek-label-wrapper">
                            <div class="eek-label">
                                <span class="energy-rating-symbol <?= strtolower(str_replace('+', '-plus',
                                    $item->energy_efficiency)); ?>"><?php echo $item->energy_efficiency ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                        if (!empty($itemTimeLimit)) {
                            $timeLimit = new Cake\I18n\Time ($itemTimeLimit);
                            if ($timeLimit->isWithinNext(5) && isset($item->original_price) && $item->price < $item->original_price) { ?>
                                <div class="row deals-label-wrapper">
                                    <div class="col-6 col-lg-5 deal-label"><span><?= __('Deal') ?></span></div>
                                    <div class="col-6 col-lg-7 deal-time-limit">
                                        <span data-countdown="<?= $itemTimeLimit ?>" id="<?= $browseItemId ?>"></span>
                                    </div>
                                </div>
                                <?php
                                $timeLimited = true;
                            }
                            else {
                                if (($itemSoldOut && $itemFastFree) || ($itemFastFree)) {
                                    ?>
                                    <div class="item-label">
                                        <span class="tag-fast-and-free"><?= __("Fast and free") ?></span>
                                    </div>
                                    <?php
                                } elseif ($itemSoldOut) {
                                    ?>
                                    <div class="item-label">
                                        <span class="tag-almost-sold-out"><?= __("Almost sold out") ?></span>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
                <div class="row card-body">
                    <p class="card-price col-12">
                        <?php if (isset($item->original_price) && $item->price != $item->original_price) : ?>
                            <span class="additional-price-info marketing-price"><?= \Cake\I18n\Number::currency($item->original_price,
                                    $item->currency); ?></span>
                        <?php endif; ?>
                        <span
                            class="item-price <?php if (isset($item->original_price) && $item->price != $item->original_price) {
                                echo "item-savings";
                            } ?>"><?= $item->display_price; ?></span>
                        <?php if ($item->unit_price_measure ?? false && $item->unit_price_value ?? false) : ?>
                            <span class="additional-price-info base-price"><?= \Cake\I18n\Number::currency($item->unit_price_value,
                                    $item->currency); ?> / <?= $item->unit_price_measure ?></span>
                        <?php endif; ?>
                    </p>
                    <?php  if ($itemTopRated) : ?>
                        <div class="col-6 top-rated-badge  <?php echo $this->Feeder->averageCustomerReviews($item->rating)?>">*</div>
                    <?php endif; ?>
                </div>
            </a>
            <?php if (!$timeLimited) { ?>
                <?= $this->element('ItoolCustomer.wishlist_link', ['wishlistItems' => $wishlistItems, 'itemId' => $itemId, 'categoryId' => $item->category_id]); ?>
            <?php } ?>
        </div>
    </div>

    <script>
        productImpressions.el_<?= $uniqueId ?> = {
            el: document.getElementById('<?= $uniqueId ?>'),
            cb: function () {
                pushEcommerce('productImpression', processProductData(<?= json_encode($this->Feeder->filterProductData($item, 'Category')) ?>, true));
            }
        };

        $('#<?= $uniqueId ?>').on('click', function (e) {//e.preventDefault();
            pushEcommerce('productClick', [processProductData(<?= json_encode($this->Feeder->filterProductData($item, 'Category')) ?>)]);
        });

        // Countdown Time-Limited-Deals

        $('[data-countdown]').each(function() {
            if ( (document.getElementById('<?= $browseItemId ?>')) != null ) {

                var countDownDate = new Date("<?php echo $itemTimeLimit ?>").getTime();

                // Update the count down every 1 second
                var x = setInterval(function () {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result
                    if (days < 6) {
                        document.getElementById('<?= $browseItemId ?>').innerHTML = days + " T " + hours + ":"
                            + minutes + ":" + seconds;
                    }
                }, 1000);
            }

        });

    </script>
<?php endif; ?>
