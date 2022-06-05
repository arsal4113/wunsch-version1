<div class="row menu-categories">
    <div class="col-12 category-navigation">
        <div class="container">
            <ul id="mobile-menu" class="burger-navbar burger-menu">
                <?php
                foreach ($feederCategories as $feederCategory) {
                    if ($feederCategory->is_invisible) continue;
                    $link = $this->Url->build([
                        'controller' => 'Browse',
                        'action' => 'view',
                        'plugin' => 'Feeder',
                        $feederCategory->id
                    ]);
                    $isActive = $feederCategory->id == $id;
                    $hasChildren = sizeof($feederCategory->subFeederCategories);
                    $hasActiveChildren = isset($parentId) && $feederCategory->id == $parentId;
                    ?>
                    <li class="<?= $isActive ? 'is-selected' : '' ?> <?= $hasActiveChildren ? 'has-active-hildren' : '' ?>">
                        <a href="<?= $link ?>" <?= $hasChildren ? 'class="has-children"' : '' ?>>
                            <?= __($feederCategory->name) ?>
                        </a>
                        <?php
                        if ($hasChildren) {
                            ?>
                            <ul class="level-1<?= $hasActiveChildren ? ' active' : '' ?>" id="navi-<?= $feederCategory->id ?>">
                                <?php
                                foreach ($feederCategory->subFeederCategories as $subFeederCategory) {
                                    if ($subFeederCategory->is_invisible) continue;
                                    $link = $this->Url->build([
                                        'controller' => 'Browse',
                                        'action' => 'view',
                                        'plugin' => 'Feeder',
                                        $subFeederCategory->id
                                    ]);
                                    $isActive = $subFeederCategory->id == $id;
                                    ?>
                                    <li <?= $isActive ? 'class="is-selected"' : '' ?>>
                                        <a href="<?= $link ?>" data-category-path="<?= __($feederCategory->name) ?> > <?= __($subFeederCategory->name) ?>">
                                            <?= __($subFeederCategory->name) ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<script>
    $(function ()
    {
        var mobile_navi = $('#mobile-navi'),
            cats_with_childs = mobile_navi.find('a.has-children');

        cats_with_childs.on('click', function (e)
        {
            e.preventDefault();

            var active_cats_with_childs = mobile_navi.find('a.has-children.is-active'),
                sibling_cats = $(this).parent().siblings('li'),
                sub_cat_sibling = $(this).siblings('ul.level-1');

            if ($(this).hasClass('is-active')) {
                mobile_navi.removeClass('under-cats');
                $(this).removeClass('is-active');
                sub_cat_sibling.hide();
                sibling_cats.show(128);
            } else {
                mobile_navi.addClass('under-cats');
                $(this).addClass('is-active');
                sub_cat_sibling.show();
                active_cats_with_childs.removeClass('is-active');
                sibling_cats.hide(128);
            }
        });

        $('#mobile-navi .container ul > li > a:not(.has-children)').on('click', function (e)
        {
            e.stopPropagation();
            if (!$(this).parent().hasClass('is-selected', 'has-active-children')) {
                push2dataLayer({
                    'event': 'mobileNavigation',
                    'clickedItem': $(this).data('category-path') ? $(this).data('category-path') : $(this).text().trim(),
                    'iconPosition': $(this).parent().index() + 1
                });
            }
        });
    });
</script>
