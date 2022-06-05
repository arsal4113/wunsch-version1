<div class="row">
    <div class="rating-bottom-wrapper col-12">
        <div class="contact-info-wrapper-contact">
            <?php if ($ratingCount) { ?>
                <div class="row">
                    <div class="average-left offset-md-3 col-md-2">
                        <div class="center-content">
                            <h1><?= h(round((floatval($ebayItem['rating']['avg_rating'] * 10))) / 10) ?></h1>
                            <div class="stars-middle">
                                <?php
                                $avgRating = floatval($ebayItem['rating']['avg_rating']);
                                for ($x = 0; $x < 5; $x++) {
                                    if ($avgRating >= 1) {
                                        echo $this->Html->image(
                                            'Feeder.full-star.svg',
                                            [
                                                'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                                'alt' => 'full star',
                                                'class' => 'star-middle star-' . $x
                                            ]);
                                        $avgRating -= 1;
                                    } else {
                                        if ($avgRating >= 0.5) {
                                            echo $this->Html->image(
                                                'Feeder.half-star.svg',
                                                [
                                                    'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                                    'alt' => 'half star',
                                                    'class' => 'star-middle star-' . $x
                                                ]);
                                            $avgRating = 0;
                                        } else {
                                            echo $this->Html->image(
                                                'Feeder.empty-star.svg',
                                                [
                                                    'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                                    'alt' => 'empty star',
                                                    'class' => 'star-middle star-' . $x
                                                ]);
                                        }
                                    }
                                } ?>
                            </div>
                            <p class="small-rating-count"><?= h($ratingString) ?></p>
                        </div>
                    </div>
                    <div class="average-right col-md-3">
                        <div class="rating-counts">
                            <div class="table">
                                <?php
                                for ($y = 0; $y < 5; $y++) {
                                    $height = 8;
                                    $margin = 0;
                                    $percentage = round(($ebayItem['rating']['histogram'][$y]['count'] / $ratingCount) * 100);
                                    if ($percentage === 2) {
                                        $height = 6;
                                        $margin = 1;
                                    }
                                    if ($percentage < 2) {
                                        $height = 4;
                                        $margin = 2;
                                    }
                                    ?>
                                    <div class="tr">
                                        <div class="td td-middle">
                                            <?php for ($z = 0; $z < $ebayItem['rating']['histogram'][$y]['stars']; $z++) {
                                                echo $this->Html->image(
                                                    'Feeder.little-star-grey.svg',
                                                    ['alt' => '*',]);
                                            } ?>
                                        </div>
                                        <div class="td td-big">
                                            <div class="percentage-bar-outline">
                                                <div style="<?php if ($percentage == 100) {
                                                    echo 'border-radius:5px;';
                                                } ?>width:<?= h($percentage) ?>%;height:<?= h($height) ?>px;position:absolute;top:<?= h($margin) ?>px"
                                                     class="percentage-bar"></div>
                                            </div>
                                        </div>
                                        <div class="td td-small">
                                            <span><?= h($ebayItem['rating']['histogram'][$y]['count']) ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div id="no-ratings-available">
                    <h4><?= __('We have no ratings yet.') ?></h4>
                </div>
            <?php } ?>
        </div>
    </div>
    <!--Costumer Review Section-->
</div>
