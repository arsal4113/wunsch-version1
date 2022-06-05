<?php
$this->Html->css('Feeder.influencer' . STATIC_MIN, ['block' => true]);
$this->Html->script('slick', ['block' => true]);
echo $this->Html->script('Feeder.simple-slider');
$this->assign('title', $influencer->title_tag);
$this->assign('robotTag', $influencer->robot_tag);
$this->assign('description', h($influencer->meta_description ?? ''));
?>

<div class="col-12 content-wrapper">
    <div class="top-section-wrapper">
        <div class="background-element"></div>
        <?php if ($influencer->area_3_video) { ?>
            <div class="image-container mobile">
                <video height="100%" width="100%" preload="none" onclick="this.paused ? this.play() : this.pause();" poster="<?= $this->Url->image($influencer->area_3_image) ?>" autoplay="false">
                    <source src="<?= $this->Url->image($influencer->area_3_video) ?>" type="video/mp4"/>
                </video>
            </div>
        <?php } else { ?>
        <div class="image-container mobile">
            <?= $this->Html->image($influencer->area_3_image) ?>
        </div>
        <?php } ?>
        <div class="message-container">
            <h1 class="headline"><?= $influencer->area_1_headline ?> <span id="scroller">Am Gewinnspiel teilnehmen</span><span class="arrow">&#x2193;</span></h1>
            <h2 class="description"><?= $influencer->area_1_text ?></h2>
        </div>
        <?php if ($influencer->area_3_video) { ?>
        <div class="image-container desktop">
            <video height="100%" width="100%" preload="none" onclick="this.paused ? this.play() : this.pause();" autoplay="false" poster="<?= $this->Url->image($influencer->area_3_image) ?>">
                <source src="<?= $this->Url->image($influencer->area_3_video) ?>" type="video/mp4"/>
            </video>
        </div>
        <?php } else { ?>
        <div class="image-container desktop">
            <?= $this->Html->image($influencer->area_3_image) ?>
        </div>
        <?php } ?>
        <div class="worlds-container">
            <div class="worlds-cart">
                <?php foreach($influencer->feeder_influencer_mini_categories as $index => $mini_category): ?>
                    <?php if($index === 7) break; ?>
                    <a class="world-wrapper" href="<?= $mini_category->url ?>">
                        <?= $this->Html->image($mini_category->image)  ?>
                        <p class="world-name"><?= $mini_category->name ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="newsletter-floater">
            <div class="info">
                <p><?= $influencer->area_2_text ?></p>
            </div>
            <?= $this->element('ItoolCustomer.newsletter',
                ['newsletterLabel' => 'influencer', 'buttonText' => __('Participate')]); ?>
            <a class="terms" href="<?= $influencer->area_2_link ?>"><?= __('Conditions of Participation') ?></a>
        </div>
    </div>
    <div class="floating-slider-container">
        <div id="toggle-button"><div class="icon"></div></div>
        <div class="slider-rail">
            <div id="slider-cart">
                <div class="slider-image-container">
                    <?= $this->Html->image($influencer->area_5_image_1)  ?>
                </div>
                <div class="slider-image-container">
                    <?= $this->Html->image($influencer->area_5_image_2)  ?>
                </div>
                <div class="slider-image-container">
                    <?= $this->Html->image($influencer->area_5_image_3)  ?>
                </div>
                <div class="slider-image-container double">
                    <?= $this->Html->image($influencer->area_5_image_4)  ?>
                    <?= $this->Html->image($influencer->area_5_image_5)  ?>
                </div>
                <div class="slider-image-container">
                    <?= $this->Html->image($influencer->area_5_image_6)  ?>
                </div>
            </div>
        </div>
        <p class="slider-description"><?= $this->Html->link($influencer->area_5_text, '/catchdirdeinewelt', ['escape' => false, 'style' => 'color:inherit']) ?></p>
    </div>
    <div class="row mid-section-wrapper">
        <div class="left-side-container">
            <?= $this->Html->image($influencer->area_6_image_1, ['class' => 'small-left'])  ?>
            <?= $this->Html->image($influencer->area_6_image_2 , ['class' => 'big-mid'])  ?>
            <p class="message desktop"><?= $influencer->area_7_text ?></p>
            <p class="message mobile"><?= $influencer->area_7_text_mobile ?></p>
        </div>
        <div class="right-side-container">
            <?= $this->Html->image($influencer->area_6_image_3, ['class' => 'medium-bot'])  ?>
        </div>
    </div>
    <div class="newsletter-floater-wrapper" id="mobile-floater">
        <div class="newsletter-floater">
            <div class="info">
                <p><?= $influencer->area_2_text ?></p>
            </div>
            <?= $this->element('ItoolCustomer.newsletter',
                ['newsletterLabel' => 'influencer', 'buttonText' => __('Participate')]); ?>
            <a class="terms" href="#"><?= __('Conditions of Participation') ?></a>
        </div>
        <p class="second-message"><?= $influencer->area_7_text ?></p>
    </div>
    <div class="discover-worlds-wrapper">
        <div class="world-container">
            <div class="big-image">
                <a target="_blank" href="<?= $influencer->area_8_ig_link ?>" class="insta-name">
                    <span>@<?= $influencer->area_8_ig_name ?></span>
                </a>
                <?= $this->Html->image($influencer->area_8_image) ?>
                <div class="fader"></div>
                <div class="world-description">
                    <p class="world-name"><?= $influencer->area_8_headline_1 ?></p>
                    <p class="world-name"><?= $influencer->area_8_headline_2 ?></p>
                    <p class="world-topic"><?= $influencer->area_8_subline ?></p>
                </div>
            </div>
            <div class="product-container">
                <?php if(isset($first_items)): ?>
                    <?php foreach($first_items as $key => $item): ?>
                        <?php if($key === 4){break;}?>
                        <a target="_blank" href="<?= $this->Url->build([
                            'controller' => 'Products',
                            'action' => 'view',
                            'plugin' => 'Feeder',
                            '?' => [
                                'categoryId' => $influencer->area_8_world_id
                            ],
                            $item->item_id,
                            \Cake\Utility\Text::slug($item->title)
                        ]); ?>">
                            <div class="product">
                                <?= $this->Html->image($item->image_url)  ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="product-slider-rail" id="first-product-slider">
                <div class="product-slider-cart">
                    <?php if(isset($first_items)): ?>
                        <?php foreach($first_items as $key => $item): ?>
                            <?php if($key === 10){break;}?>
                            <a target="_blank" href="<?= $this->Url->build([
                                'controller' => 'Products',
                                'action' => 'view',
                                'plugin' => 'Feeder',
                                '?' => [
                                    'categoryId' => $influencer->area_8_world_id
                                ],
                                $item->item_id,
                                \Cake\Utility\Text::slug($item->title)
                            ]); ?>">
                                <div class="product">
                                    <?= $this->Html->image($item->image_url)  ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="button-container">
                <a href="<?= $influencer->area_8_button_link ?>" class="button">Alle Produkte anzeigen</a>
            </div>
        </div>
        <div class="mobile-message-container">
            <p>Mit trendigen, ausgefallenen und lustigen Produkten sorgt Catch jede Woche aufs Neue für inspirierende Überraschungen</p>
        </div>
        <div class="world-container">
            <div class="big-image">
                <a target="_blank" href="<?= $influencer->area_9_ig_link ?>" class="insta-name">
                    <span>@<?= $influencer->area_9_ig_name ?></span>
                </a>
                <?= $this->Html->image($influencer->area_9_image)  ?>
                <div class="fader"></div>
                <div class="world-description">
                    <p class="world-name"><?= $influencer->area_9_headline_1 ?></p>
                    <p class="world-name"><?= $influencer->area_9_headline_2 ?></p>
                    <p class="world-topic"><?= $influencer->area_9_subline ?></p>
                </div>
            </div>
            <div class="product-container">
                <?php if(isset($second_items)): ?>
                    <?php foreach($second_items as $key => $item): ?>
                        <?php if($key === 4){break;}?>
                        <a target="_blank" href="<?= $this->Url->build([
                            'controller' => 'Products',
                            'action' => 'view',
                            'plugin' => 'Feeder',
                            '?' => [
                                'categoryId' => $influencer->area_9_world_id
                            ],
                            $item->item_id,
                            \Cake\Utility\Text::slug($item->title)
                        ]); ?>">
                            <div class="product">
                                <?= $this->Html->image($item->image_url)  ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="product-slider-rail" id="second-product-slider">
                <div class="product-slider-cart">
                    <?php if(isset($second_items)): ?>
                        <?php foreach($second_items as $key => $item): ?>
                            <?php if($key === 10){break;}?>
                            <a target="_blank" href="<?= $this->Url->build([
                                'controller' => 'Products',
                                'action' => 'view',
                                'plugin' => 'Feeder',
                                '?' => [
                                    'categoryId' => $influencer->area_9_world_id
                                ],
                                $item->item_id,
                                \Cake\Utility\Text::slug($item->title)
                            ]); ?>">
                                <div class="product">
                                    <?= $this->Html->image($item->image_url)  ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="button-container">
                <a href="<?= $influencer->area_9_button_link ?>" class="button">Alle Produkte anzeigen</a>
            </div>
        </div>
    </div>
    <div class="row bottom-wrapper">
        <div class="col-lg-6 col-12 left-container">
            <p class="text">Mit trendigen, ausgefallenen und lustigen Produkten
                sorgt Catch jede Woche aufs Neue für inspirierende Überraschungen.</p>
        </div>
        <div class="col-lg-6 col-12 right-container">
            <div class="text-wrapper">
                <p class="headline">Dein Catch Universum</p>
                <p class="text">Alles unter 100€ Kostenloser Versand eBay Garantie</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        const floatingSlider = $('.floating-slider-container');
        const worldsCart = $('.worlds-cart');
        let miniWorldCount = <?= count($influencer->feeder_influencer_mini_categories) ?>;
        let maxWidth = undefined;
        let minWidth = undefined;
        function setDevice(){
            const width = $(window).width();
            if(width >= 1400) {
                minWidth = 803;
                maxWidth = 1219;
                worldsCart.removeAttr('style');
            } else if(width < 1400 && width >= 1024) {
                minWidth = 548;
                maxWidth = $(window).width() - 62;
                worldsCart.removeAttr('style');
            } else if(width < 1024 && width >= 768) {
                minWidth = 346;
                maxWidth = $(window).width() - 62;
                worldsCart.width(miniWorldCount * 72);
            } else {
                worldsCart.width(miniWorldCount * 65.72);
            }
        }
        setDevice();
        $(window).resize(function () {
            setDevice();
        });

        $(document).ready(function () {
            const imageSlider = floatingSlider.simple_slider({
                sliderRail: '.slider-rail',
                sliderCart: '#slider-cart'
            });

            const worldsSlider = $('.worlds-container').simple_slider({
                sliderRail: '.worlds-container',
                sliderCart: '.worlds-container .worlds-cart'
            });

            const firstProductSlider = $('#first-product-slider').simple_slider({
                sliderRail: '#first-product-slider',
                sliderCart: '#first-product-slider .product-slider-cart'
            });

            const secondProductSlider = $('#second-product-slider').simple_slider({
                sliderRail: '#second-product-slider',
                sliderCart: '#second-product-slider .product-slider-cart'
            });

            $('#scroller').click(function () {
                document.getElementById('mobile-floater').scrollIntoView(false);
            });

            /** in- and decreases image-overlay width on button click and fits the slider to the new width */
            const cartWidth = $('#slider-cart').width();
            $('#toggle-button').click(function () {
                if (floatingSlider.hasClass('expanded')){
                    floatingSlider.removeClass('expanded');
                    imageSlider.simple_slider('setMinLeft', -cartWidth + (minWidth - 23));
                } else {
                    floatingSlider.addClass('expanded');
                    imageSlider.simple_slider('setMinLeft', -cartWidth + (maxWidth - 23));
                }
            });
        });
    });
</script>

