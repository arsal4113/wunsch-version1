<div class="col-lg-6 col-12 design-2a block-<?= $blockKey ?>">
    <?php foreach($config->categoryIds as $key => $category): ?>
        <?php if($key === 5) break; ?>
        <div class="category-wrapper big-screen-cat category-<?= $key ?>">
            <a href="<?= $category->url_path ?>">
                <?= $this->Html->image($category->image, ['class' => 'category-image', 'alt' => 'background']) ?>
                <div class="subtitle"><span class="category-name"><?= $category->name ?></span></div>
            </a>
        </div>
    <?php endforeach; ?>
    <div id="mobile-slider">
        <?php foreach($config->categoryIds as $key => $category): ?>
            <div class="slider-category">
                <a href="<?= $category->url_path ?>">
                    <?= $this->Html->image($category->image, ['class' => 'category-image', 'alt' => 'background']) ?>
                    <div class="subtitle"><span class="category-name"><?= $category->name ?></span></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        $(function () {
            $(document).ready(function () {
                $('.design-2a.block-<?= $blockKey ?> #mobile-slider').slick({
                    infinite: false,
                    arrows: false,
                    slidesToShow: 3,
                    initialSlide: 1,
                    variableWidth: true,
                    centerPadding: "0",
                    centerMode: true,
                    lazyLoad: 'ondemand'
                })
            });
        });
    </script>
</div>
