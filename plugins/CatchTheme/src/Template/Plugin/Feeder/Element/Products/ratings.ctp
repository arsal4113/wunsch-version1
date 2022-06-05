<div class="title-rating-wrapper">
    <div class="rating">
        <?php if ($ratingCount) { ?>
            <div class="stars">
                <?php
                $avgRating = floatval($ebayItem['rating']['avg_rating']);
                for ($x = 0; $x < 5; $x++) {
                    if ($avgRating >= 1) {
                        echo $this->Html->image(
                            'Feeder.full-star.svg',
                            [
                                'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                'alt' => 'full star',
                                'class' => 'star star-' . $x
                            ]);
                        $avgRating -= 1;
                    } else {
                        if ($avgRating >= 0.5) {
                            echo $this->Html->image(
                                'Feeder.half-star.svg',
                                [
                                    'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                    'alt' => 'half star',
                                    'class' => 'star star-' . $x
                                ]);
                            $avgRating = 0;
                        } else {
                            echo $this->Html->image(
                                'Feeder.empty-star.svg',
                                [
                                    'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                    'alt' => 'empty star',
                                    'class' => 'star star-' . $x
                                ]);
                        }
                    }
                } ?>
            </div>
            <div class="product-ratings">
                <p>
                    <a id="scrollable"
                       href="#item-review-section"><?php
                        $ratingString = "product rating";
                        if ($ratingCount !== 1) {
                            $ratingString = \Cake\Utility\Inflector::pluralize($ratingString);
                        }
                        $ratingString = $ratingCount . ' ' . __($ratingString);
                        echo h($ratingString);
                        ?></a>
                </p>
            </div>
        <?php } else { ?>
            <p><?= __('We have no ratings yet.') ?></p>
        <?php } ?>
    </div>
</div>
