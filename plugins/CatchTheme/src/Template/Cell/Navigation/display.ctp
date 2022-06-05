<?php

/**
 * @var \Cake\View\Helper\UrlHelper $this ->Url
 */
?>

<div class="row">
    <div class="col-12">
        <div class="container">
            <div class="row" style="overflow: hidden;">
                <span class="navbar-control navbar-prev"></span>
                <span class="sub-navbar-control navbar-prev"></span>
                <nav class="navbar navbar-expand navbar-dark navigation" id="category-navigation">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto level-0">
                            <li class="nav-item">
                                <?=
                                $this->Html->link('<div class="img-wrapper my-world"><div class="image-background">'. $this->Html->image("eye-icon.svg") .'</div></div>
                                    <div class="category-name">' .  __('My World') . '</div>',
                                    [
                                        'controller' => 'Account',
                                        'action' => 'interests',
                                        'plugin' => 'ItoolCustomer',
                                        'view'
                                    ], [
                                        'escape' => false,
                                        'class' => 'nav-link',
                                        'id' => 'discover-my-world'
                                    ]);
                                ?>
                            </li>
                            <?php
                            $activeParent = null;
                            if (isset($feederCategories) && is_array($feederCategories)) {
                                foreach ($feederCategories as $key => $feederCategory) {
                                    $imageData = [
                                        'data-src' => $feederCategory->image ? $this->Url->image($feederCategory->image) : $this->Url->image('placeholder.png'),
                                        'data-src-selected' => $feederCategory->image_selected ? $this->Url->image($feederCategory->image_selected) : $this->Url->image('placeholder-inv.png'),
                                        'alt' => $feederCategory->image_alt_tag,
                                        'title' => $feederCategory->image_title_tag
                                    ];
                                    $image = $feederCategory->image
                                        ? $this->Html->image($feederCategory->image, $imageData)
                                        : $this->Html->image('placeholder.png', $imageData);
                                    $imageSelected = $feederCategory->image_selected
                                        ? $this->Html->image($feederCategory->image_selected, $imageData)
                                        : $this->Html->image('placeholder-inv.png', $imageData);
                                    $itemClasses = ['nav-item'];
                                    $subCategories = $feederCategory->sub_categories;
                                    //$subCategoriesIds = [];
                                    if (sizeof($subCategories)) {
                                        $itemClasses[] = 'has-children';
                                        foreach ($subCategories as $subCategory) {
                                            //$subIds[] = $subCategory->id;
                                            if ($id == $subCategory->id) {
                                                $itemClasses[] = 'has-active-children';
                                                $activeParent = $feederCategory->id;
                                                $image = $imageSelected;
                                            }
                                        }
                                    }
                                    if ($id == $feederCategory->id) {
                                        $itemClasses[] = 'active';
                                        $activeParent = $feederCategory->id;
                                        $image = $imageSelected;
                                    }
                                    ?>
                                    <li id="nav-item-<?= $feederCategory->id ?>"
                                        class="<?= implode($itemClasses, " ") ?>"
                                        ref="nav-sub-<?= $feederCategory->id ?>" <?php if ($feederCategory->is_invisible) {
                                        echo 'style="display:none"';
                                    } ?> >
                                        <a class="nav-link" id="nav-item-link-<?= $feederCategory->id ?>"
                                           data-title="<?= ($feederCategory->title_tag) ? $feederCategory->title_tag : $feederCategory->name ?>"
                                           href="<?= $this->Url->build([
                                               'controller' => 'Browse',
                                               'action' => 'view',
                                               'plugin' => 'Feeder',
                                               $feederCategory->id
                                           ]) ?>">
                                            <div class="img-wrapper"><?= $image ?></div>
                                            <div class="category-name"><?= __($feederCategory->name) ?></div>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
                <span class="navbar-control navbar-next active"></span>
                <span class="sub-navbar-control navbar-next active"></span>
            </div>

            <div class="row sub-nav" style="display:none">
                <div id="category-subnav" class="hide-before">
                    <?php
                    if (isset($feederCategories) && is_array($feederCategories)) {
                        foreach ($feederCategories as $key => $feederCategory) {
                            if (sizeof($feederCategory->sub_categories)) {
                                ?>
                                <ul id="nav-sub-<?= $feederCategory->id ?>" class="navbar-nav mr-auto level-1 <?= $activeParent == $feederCategory->id ? 'active' : '' ?>">
                                <?php
                                foreach ($feederCategory->sub_categories as $key => $subCategory) {
                                    $itemClasses = ['nav-item'];
                                    if ($id == $subCategory->id) {
                                        $itemClasses[] = 'active';
                                    }
                                    if (!$subCategory->is_invisible) { ?>
                                        <li id="nav-item-<?= $subCategory->id ?>"
                                            class="<?= implode($itemClasses, " ") ?>">
                                            <a class="nav-link" id="nav-item-link-<?= $subCategory->id ?>"
                                               data-title="<?= ($subCategory->title_tag) ? $subCategory->title_tag : $subCategory->name ?>" <?php if ($subCategory->is_invisible) {
                                                echo 'style="display:none"';
                                            } ?>
                                               href="<?= $this->Url->build([
                                                   'controller' => 'Browse',
                                                   'action' => 'view',
                                                   'plugin' => 'Feeder',
                                                   $subCategory->id
                                               ]) ?>">
                                                <div class="category-name"><?= __($subCategory->name) ?></div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            </ul>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- pandata additional tracking-pushes on nav-tem click events -->
<script type="text/javascript">
    var not_active_items = $('.nav-item:visible > a');
    not_active_items.on('click', function (e) {
        var items_wrapper = $(this).parent();
        if (!items_wrapper.hasClass('active')) {
            var item_label = $(this).children('.category-name').text();
            push2dataLayer({
                'event': 'iconNavigation',
                'clickedItem': item_label,
                'iconPosition': items_wrapper.index() + 1
            });
            productImpressionPosition = 1;
        }
    });
</script>

<script type="text/javascript">
    $(function () {
        // sliding categories controls
        var sub_categories_links = $('.navbar-nav .nav-item.has-children > a'),
            sub_categories_lists = $('.navbar-nav .nav-item.has-children > ul');
        sub_categories_visible_list = sub_categories_lists.find('.nav-item.active').parent('ul'),
            actual_sub_categories = $('.nav-item.has-children.active > ul'),
            category_active_parent = sub_categories_visible_list.siblings('.nav-link'),
            navi = $('#category-navigation'),
            header_navi = $('#header #category-navigation'),
            item_width = 108,
            first_active_item = navi.find('.nav-item.active').first(),
            first_active_container = first_active_item.parents('.nav-item.has-children').first();

        // pre-operation routine
        sub_categories_lists.hide();
        sub_categories_visible_list.show();
        actual_sub_categories.show();


        /*sub_categories_links.on('click', function (e) no more required as of WD-775
        {
            if (!$(this).hasClass('active'))
                $(this).toggleClass('active').siblings('ul').toggle(125);
        });*/

        function toHex(decimal) {

            output = decimal.toString(16);

            return (output.length == 1)
                ? '0' + output
                : output;
        }

        // gradient backgrunds calculation
        var navi_items = $('.navbar-nav.level-0 > .nav-item'),
            start_color = 'fed11c',
            end_color = 'f17e00',
            gradient_ratio = 1 / navi_items.length;

        navi_items.each(function (index) {
            var item_ratio = index * gradient_ratio,
                red_component = Math.ceil(parseInt(end_color.substring(0, 2), 16) * item_ratio + parseInt(start_color.substring(0, 2), 16) * (1 - item_ratio)),
                green_component = Math.ceil(parseInt(end_color.substring(2, 4), 16) * item_ratio + parseInt(start_color.substring(2, 4), 16) * (1 - item_ratio)),
                blue_component = Math.ceil(parseInt(end_color.substring(4, 6), 16) * item_ratio + parseInt(start_color.substring(4, 6), 16) * (1 - item_ratio));

            //$(this).find('.img-wrapper').css('background-color', '#' + toHex(red_component) + toHex(green_component) + toHex(blue_component));
        });

        $('#discover-my-world').click(function (e) {
            var userNotLogged = !(typeof window.userLogedIn != 'undefined' && window.userLogedIn);
            var login_sidebar = $('.burger-container .burger-wrapper .row.menu-account .container');
            if (userNotLogged) {
                push2dataLayer({
                    'event': 'headerInteraction',
                    'clickedItem': 'user'
                });
                e.preventDefault();
                catcher.showMenu();
                login_sidebar.children('.additional-message').remove();
                login_sidebar.prepend(catcher.loginInterestSidebarNotLoggedInText);
                catcher.redirectAfterLogin = $(this).attr('href');
            }
        });
        catcher.loginInterestSidebarNotLoggedInText = '<p class="additional-message"><span class="burger-menu-icon interest"></span><span  class="wishlist-message"><?= __d('itool_customer',
            'Please sign in or register to discover your own individual World.') ?></span></p>';
    });
</script>
