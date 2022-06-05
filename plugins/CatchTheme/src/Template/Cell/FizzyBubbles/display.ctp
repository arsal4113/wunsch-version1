<?php
/** @var \Feeder\Model\Entity\FeederFizzyBubble $fizzyBubble */
if(!STATIC_MIN){
    echo $this->Html->script('Feeder.homepage-slider');
}
?>
<div id="bubble-banner">
    <div id="hover-background"></div>
    <div class="banner-container" id="banner">
        <?php if(count($fizzyBubbles) > 4): ?>
            <?php foreach($fizzyBubbles as $key => $fizzyBubble): ?>
            <?php if($key === 7) break; ?>
                <div data-index="<?= $key ?>" class="fizzy-bubble-container total-count-<?= count($fizzyBubbles) ?> bubble-<?= $key ?> <?= $key === 2 ? 'active' : '' ?>">
                    <a href="<?= $fizzyBubble->url ?>">
                        <div class="bubble-wrapper">
                            <?= $this->Html->image($fizzyBubble->image_src, ['class' => 'bubble-image', 'alt' => $fizzyBubble->img_alt_tag]) ?>
                            <div class="bubble-text">
                                <p class="title" style="color:<?= $fizzyBubble->title_color ?>; opacity:<?= $fizzyBubble->title_opacity / 100 ?>; background-color: <?= $fizzyBubble->title_background_color ?>;"><?= $fizzyBubble->title_text ?></p><br>
                                <p class="subline" style="color:<?= $fizzyBubble->subline_color ?>; opacity:<?= $fizzyBubble->subline_opacity / 100 ?>; background-color: <?= $fizzyBubble->subline_background_color ?>;"><?= $fizzyBubble->subline_text ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    $(function () {
        $('#bubble-banner .fizzy-bubble-container a').on('click', function (e) {
            push2dataLayer({
                'event': 'worldBubbleClick',
                'clickedItem': $(this).find('.title').text() + ' | ' +  $(this).find('.subline').text(),
                'clickedUrl': $(this).attr('href')
            });
        });
    });
</script>
