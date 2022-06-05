<?php
$this->Html->css('Feeder.pillar-page' . STATIC_MIN, ['block' => true, 'media' => 'all']);
$this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true, 'media' => 'all']);
$this->Html->script('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]);
$this->Html->script('slick', ['block' => true]);

$metaTags = [
    'title' => 'title_tag',
    'robotTag' => 'robots_tag',
    'description' => 'meta_tag',
    'facebook_og_url' => 'facebook_og_url',
    'facebook_og_title' => 'facebook_og_title',
    'facebook_og_description' => 'facebook_og_description',
    'facebook_og_image' => 'facebook_og_image'
];

foreach ($metaTags as $key => $metaTag) {
    if (!empty($pillarPage->{$metaTag})) {
        $this->assign($key, $pillarPage->{$metaTag});
    }
}
?>

<div class="col-12 pillar-page">
    <?php
    if ($blockConfig)
    {
        foreach( $blockConfig as $key => $block)
        {
            if ($block->hasSibling && $block->hasSibling === "next") {
                echo '<div class="row sibling-design">';
            }

            echo $this->element('Feeder.PillarPageBlocks/design_' . $block->designId, [
                'config' => $block,
                'wishlistItems' => $wishlistItems,
                'blockKey' => $key
            ]);

            if ($block->hasSibling && $block->hasSibling === "previous") {
                echo '</div>';
            }
        }
    }
    ?>
</div>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167210490-1"></script>
<script>
    /*window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-167210490-1');*/
    gtag('set', {'content_group2': '<?= $pillarPage->title_tag ?>'});
    $(function () {
        $('.design-3 .section-header').click(function () {
            const parent = $(this).parent();
            parent.find('.section-content').stop().slideToggle();
            parent.find('.arrow').toggleClass('rotated');
        });
    });
</script>
