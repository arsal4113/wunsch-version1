<div class="row design-5 block-<?= $blockKey ?>">
    <div class="col-12 text-content">
        <?= $config->headline ?>
        <div class="textfield"><?= $config->text ?></div>
        <div class="subtitle"><span><?= $config->subtitle ?></span></div>
    </div>
    <div class="col-12 item-slider">
        <div id="slick-item-slider">
            <?php
            foreach($config->itemIds as $item){
                echo $this->element('Feeder.Browse/item', [
                    'item' => $item
                ]);
            }
            ?>
        </div>
    </div>
    <script>
        $(function () {
            $(document).ready(function () {
                const itemCount = <?= count($config->itemIds) ?>;
                let centerMode = true;

                if(itemCount === 1){
                    centerMode = false;
                }
                $('#slick-item-slider .browse-col').removeClass('col-6 col-md-3');
                $('.block-<?= $blockKey ?> #slick-item-slider').slick({
                    infinite: true,
                    centerMode: false,
                    slidesToShow: 6,
                    slidesToScroll: 6,
                    lazyLoad: 'ondemand',
                    slide: '.browse-col',
                    rows: 0,
                    responsive: [
                        {
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                                arrows: false,
                                centerMode: centerMode
                            }
                        },
                        {
                            breakpoint: 450,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerMode: true,
                                arrows: false
                            }
                        }
                    ]
                });
            });
        });
    </script>
</div>
