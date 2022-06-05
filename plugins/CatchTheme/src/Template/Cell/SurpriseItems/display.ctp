<?php

$itemsPerRow = 6;
if (!empty($items)) {
    ?>
    <div class="container-fluid" id="surprise-item-row">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 sick-slide-wrapper">
                        <div id="surprise-item-carousel">
                            <?php foreach ($items as $key => $item) : ?>
                                <?php
                                if (!isset($item->image_url) && empty($item->image_url)) {
                                    continue;
                                }
                                $uniqueId = md5($item->item_id . $item->title);
                                $timeLimited = false;
                                $surpriseItemId = md5($item->item_id);
                                $itemTimeLimit = $item->end_date;
                                $timeNow = Cake\I18n\Time::now();
                                $itemFastFree = ((isset($item->delivery_duration_de) && $item->delivery_duration_de <= 3) && (isset($item->delivery_cost_de) && $item->delivery_cost_de == 0));
                                $itemSoldOut = ($item->quantity && $item->quantity < 3);
                                $itemTopRated = (isset($item->rating) && $item->rating >= 4.5);
                                ?>
                                <div class="card-wrapper">
                                    <div class="surprise-item card" id="<?= $uniqueId ?>">
                                    <a href="<?= $this->Url->build([
                                        'controller' => 'Products',
                                        'action' => 'view',
                                        'plugin' => 'Feeder',
                                        $item->item_id,
                                        \Cake\Utility\Text::slug($item->title)
                                    ]); ?>" class="surprise-item-link">
                                        <div class="card-img-wrapper">
                                            <?= $this->Html->image('lazy-placeholder.png', [
                                                'data-lazy' => $item->thumbnail_url ?? $item->image_url,
                                                'class' => 'card-img-top lazy',
                                                'alt' => h($item->title)
                                            ]) ?>
                                        </div>
                                        <div class="card-label-wrapper">
                                            <?php if ($item->energy_efficiency ) : ?>
                                                <div class="eek-label-wrapper">
                                                    <div class="eek-label">
                                                        <span class="energy-rating-symbol <?= strtolower(str_replace('+', '-plus', $item->energy_efficiency)); ?>">
                                                            <?php echo $item->energy_efficiency ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($itemTimeLimit)) {
                                                $timeLimit = new Cake\I18n\Time ($itemTimeLimit);
                                                if ($timeLimit->isWithinNext(5) && isset($item->original_price) && $item->price < $item->original_price) {
                                                    $timeLimited = true;
                                                    ?>
                                                    <div class="row deals-label-wrapper">
                                                        <div class="col-6 col-lg-5 deal-label"><span><?= __('Deal') ?></span></div>
                                                        <div class="col-6 col-lg-7 deal-time-limit">
                                                            <span data-surprise-countdown="<?= $itemTimeLimit ?>" id="<?= $surpriseItemId ?>"></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else {
                                                    $timeLimited = false;
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
                                        <div class="deals-badge"><span>Deal %</span></div>
                                        <div class="row card-body">
                                            <p class="card-price col-12">
                                                <?php if (isset($item->original_price) && $item->price != $item->original_price) : ?>
                                                    <span class="additional-price-info marketing-price">
                                                        <?= \Cake\I18n\Number::currency($item->original_price, $item->currency); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <span class="item-price <?php if (isset($item->original_price) && $item->price != $item->original_price) {
                                                    echo "item-savings";} ?>"><?= $item->display_price; ?></span>
                                                    <?php if ($item->unit_price_measure ?? false && $item->unit_price_value ?? false) : ?>
                                                        <span class="additional-price-info base-price">
                                                            <?= \Cake\I18n\Number::currency($item->unit_price_value,
                                                                $item->currency); ?> / <?= $item->unit_price_measure ?>
                                                        </span>
                                                    <?php endif; ?>

                                            </p>
                                            <?php  if ($itemTopRated) : ?>
                                                <div class="col-6 card-ratings">
                                                    <div class="top-rated-badge  <?php echo $this->Feeder->averageCustomerReviews($item->rating)?>">*</div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <?php if (!$timeLimited) { ?>
                                        <?= $this->element('ItoolCustomer.wishlist_link', ['wishlistItems' => $wishlistItems, 'itemId' => $item->item_id, 'categoryId' => $item->category_id]); ?>
                                    <?php } ?>
                                    <script type="text/javascript">
                                        $('#<?= $uniqueId ?>').on('click', function (e) {//e.preventDefault();
                                            e.stopImmediatePropagation();
                                            pushEcommerce('productClick', [processProductData(<?= json_encode($this->Feeder->filterProductData($item, 'Recommendations')) ?>)]);
                                        });
                                    </script>

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
                                        // Countdown Time-Limited-Deals
                                        if ( (document.getElementById('<?= $surpriseItemId ?>')) != null )
                                        {
                                            $(function () {
                                                var countDownDate = new Date("<?php echo $itemTimeLimit ?>").getTime();

                                                // Update the count down every 1 second
                                                var y = setInterval(function () {
                                                    var now = new Date().getTime();
                                                    var distance = countDownDate - now;

                                                    // Time calculations for days, hours, minutes and seconds
                                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                    // Display the result
                                                    if (days < 6) {
                                                        document.getElementById('<?= $surpriseItemId ?>').innerHTML = days + " T " + hours + ":"
                                                            + minutes + ":" + seconds;
                                                    }
                                                }, 1000);
                                            });
                                        }
                                    </script>
                                </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#surprise-item-carousel').on('init', function(event, slick){
                $('.wishlist-item-link').wishlistify();
            });
            $('#surprise-item-carousel').slick({
                slidesToShow: 6,
                slidesToScroll: 6,
                lazyLoad: 'ondemand',
                responsive: [
                    {
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding: '90px'
                        }
                    },
                    {
                        breakpoint: 350,
                        settings: {
                            arrows: false,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding: '60px'

                        }
                    }
                ]
            });

            $('#surprise-item-carousel').on('afterChange', function (slick, currentSlide) {
                checkProductImpressions();//setTimeout('checkProductImpressions', 666);
            });
        });
    </script>
    <?php
}
