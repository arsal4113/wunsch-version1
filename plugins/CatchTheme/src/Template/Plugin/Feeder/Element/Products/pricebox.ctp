<div class="buy-section border-radius">
    <div class="row">
        <div class="col-12">
            <div class="price-box">
                                        <span id="price">
                                    <?php
                                    $price = 999999999;
                                    $displayPrice = '';
                                    $originalPrice = null;
                                    $lowestItem = null;
                                    $unitPriceDisplay = null;
                                    for ($x = 0; $x < count($items); $x++) {
                                        $items[$x]['price']['display_price'] = str_replace('.',
                                                ',', \Cake\I18n\Number::precision($items[$x]['price']['amount'], 2)). ' ' . ($items[$x]['price']['currency'] == 'EUR') ? '$euro;' : $items[$x]['price']['currency'];
                                        if (floatval($items[$x]['price']['amount']) < $price) {
                                            $price = floatval($items[$x]['price']['amount']);
                                            $displayPrice = str_replace('.',
                                                ',', \Cake\I18n\Number::precision($items[$x]['price']['amount'], 2)). ' ' . ($items[$x]['price']['currency'] == 'EUR') ? '$euro;' : $items[$x]['price']['currency'];

                                            if (!empty($items[$x]['marketing_price']['original_price']['value'])) {
                                                $originalPrice = str_replace('.',
                                                    ',', \Cake\I18n\Number::precision($items[$x]['price']['value'], 2)). ' ' . ($items[$x]['marketing_price']['original_price']['currency'] == 'EUR') ? '$euro;' : $items[$x]['marketing_price']['original_price']['currency'];
                                            } else {
                                                $originalPrice = null;
                                            }
                                            $unitPriceDisplay = $items[$x]['unit_price_display'];
                                            $lowestItem = $items[$x];

                                        }
                                    }
                                    echo $displayPrice;
                                    ?></span> <span class="uvp"><strike><?= $originalPrice ?></strike></span> <br/>
                <span class="mwst"><?= __('(incl. tax)'); ?></span> <br/>
                <?php
                $discounted = false;
                if (
                    !empty($lowestItem['marketing_price']['discount_percentage'])
                    && !empty($lowestItem['marketing_price']['discount_amount']['value'])
                ) {
                    $discounted = true;
                    echo '<span class="discount">' . __('You save') . ' ' . $lowestItem['marketing_price']['discount_amount']['currency'] . ' ' . str_replace('.',
                            ',',
                            \Cake\I18n\Number::precision($lowestItem['marketing_price']['discount_amount']['value'],
                                2)) . ' (-' . \Cake\I18n\Number::precision($lowestItem['marketing_price']['discount_percentage'],
                            0) . '%*)</span><br />';
                }
                ?>
                <span class="unit-price"><?= $unitPriceDisplay; ?></span> <br/>
            </div>
        </div>
    </div>
