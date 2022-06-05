<?php

if (!STATIC_MIN) :
    echo $this->Html->script('Feeder.jquery-scrollto', ['block' => false]);
endif;

$my_world_link = $this->Html->link('&#x1F30D ' . __('My World'), [
    'controller' => 'Account',
    'action' => 'interests',
    'plugin' => 'ItoolCustomer',
    'view'
], [
    'escape' => false,
    'id' => 'discover-my-world'
]);

?>
<nav class="col-12" id="mega-navi">
    <div class="container">
        <div class="inner-container">
            <ul class="level-0" id="main-navi">
                <li class="has-children first">
                    <?= $my_world_link ?>
                </li>
                <?php
                foreach ($feederGuides as $feederGuide) {
                    $link = $this->Html->link(__(!empty($feederGuide->navigation_name) ? $feederGuide->navigation_name : $feederGuide->title), $feederGuide->url);
                    ?>
                    <li>
                        <?= $link ?>
                    </li>
                    <?php
                }
                ?>
                <li>
                </li>
                <?php
                foreach ($feederCategories ?? [] as $feederCategory) {
                    if ($feederCategory->is_invisible) continue;
                    $link = $this->Url->build([
                        'controller' => 'Browse',
                        'action' => 'view',
                        'plugin' => 'Feeder',
                        $feederCategory->id
                    ]);
                    $hasChildren = sizeof($feederCategory->subFeederCategories);
                    $hasActiveChildren = isset($parentId) && $feederCategory->id == $parentId;
                    $isActive = $feederCategory->id == $id;
                    ?>
                    <li class="<?= $isActive ? 'is-selected' : '' ?> <?= $hasActiveChildren ? 'has-active-children' : '' ?>">
                        <a href="<?= $link ?>" <?= $hasChildren ? 'class="has-children"' : '' ?>>
                            <?= __($feederCategory->name) ?>
                        </a>
                        <?php
                        if ($hasChildren) {
                            ?>
                            <ul class="level-1<?= $hasActiveChildren ? ' active' : '' ?>" id="navi-<?= $feederCategory->id ?>">
                                <?php
                                if ($feederCategory->banner_image) {
                                    ?>
                                    <a href="<?= $feederCategory->banner_url ?>">
                                        <?= $this->Html->image($feederCategory->banner_image, [
                                            'alt' => $feederCategory->banner_image_alt_tag,
                                            'title' => $feederCategory->banner_image_title_tag
                                        ]) ?>
                                    </a>
                                    <?php
                                }
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
                                        <a href="<?= $link ?>">
                                            <?= __($subFeederCategory->name) ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <div class="gradient left" rel="navi-<?= $feederCategory->id ?>"><</div>
                            <div class="gradient right" rel="navi-<?= $feederCategory->id ?>">></div>
                            <?php
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
                <li class="last">
                    <a id="more-categories" href="Javascript:;"><?= __('More categories') ?>..</a>
                </li>
            </ul>
        </div>
        <div class="gradient left" rel="main-navi"><</div>
        <div class="gradient right" rel="main-navi">></div>
    </div>
    <div class="layer"></div>
</nav>

<script>
    $(function ()
    {
        let animationCollection = [],
            timeoutCollection = [],
            intervalCollection = [],
            naviElements = $('#main-navi').children(),
            useIntervalAnimation = false,
            activeAnimationCount = 0,
            animated = false;

        try {
            naviElements[0].animate([
                {transform: 'translate(0px)'},
                {transform: 'translate(0px)'}
            ],{duration: 1,iteration: 1});
        } catch(e) {
            console.log("animate is not supported");
            useIntervalAnimation = true;
        }

        function checkScrollingText(reverse) {
            naviElements.each(function (index) {
                if (index === 5) {
                    return false;
                }
                let overshoot = $(this).children().width() - ($(window).width() - 30);
                if (overshoot > 10) {
                    animated = true;
                    activeAnimationCount++;
                    timeoutCollection[index] = setTimeout(function (element) {
                        animateOversizedText(element, overshoot, reverse, index);
                    }, 2000, this);
                }
            })
        }

        function animateOversizedText(element, overshoot, reverse, index) {
            if (useIntervalAnimation) {
                let anim = setInterval(animation, 17),
                    interpolInterval = 1 / ((20 * overshoot) / 17),
                    interpolValue = 0;

                animationCollection[index] = anim;
                function animation() {
                    if (interpolValue >= 1) {
                        clearInterval(animationCollection[index]);
                        activeAnimationCount--;
                        if (activeAnimationCount === 0) {
                            if (!reverse) {
                                animationCollection[index] = setTimeout(function () {
                                    checkScrollingText(true);
                                }, 2000);
                            } else {
                                animationCollection[index] = setTimeout(function () {
                                    checkScrollingText(false);
                                }, 4000);
                            }
                        }
                    } else {
                        element.style.transform = reverse ? 'translateX(' + ((-overshoot) + (overshoot * interpolValue)) + 'px)' :
                            'translateX(' + -(overshoot * interpolValue) + 'px)';
                        interpolValue += interpolInterval;
                    }
                }
            } else {
                if (reverse) {
                    intervalCollection[index] = element.animate([
                        {transform: 'translateX(' + -overshoot + 'px)'},
                        {transform: 'translateX(0px)'}
                    ], {duration: 20 * overshoot, iteration: 1});
                } else {
                    intervalCollection[index] = element.animate([
                        {transform: 'translateX(0px)'},
                        {transform: 'translateX(' + -overshoot + 'px)'}
                    ], {duration: 20 * overshoot, iteration: 1});
                }
                intervalCollection[index].onfinish = function() {
                    activeAnimationCount--;
                    if (!reverse) {
                        element.style.transform = 'translateX(' + -overshoot + 'px)';
                        if (activeAnimationCount === 0) {
                            animationCollection[index] = setTimeout(function () {
                                checkScrollingText(true)
                            }, 2000);
                        }
                    } else {
                        element.style.transform = 'translateX(0px)';
                        if (activeAnimationCount === 0) {
                            animationCollection[index] = setTimeout(function () {
                                checkScrollingText(false)
                            }, 4000);
                        }
                    }
                    if (activeAnimationCount === 0) {
                    }
                };
            }
        }

        function stopAnimation(){
            animated = false;
            $('#main-navi').children().each(function (index) {
                if (index === 5) {
                    return false;
                }
                $(this).attr('style', '');
                clearTimeout(animationCollection[index]);
                clearTimeout(timeoutCollection[index]);
                if (intervalCollection[index] !== undefined) {
                    if (useIntervalAnimation) {
                        clearInterval(intervalCollection[index]);
                    } else {
                        intervalCollection[index].cancel();
                    }
                }
            });
            activeAnimationCount = 0;
        }

        $(window).resize(function () {
            if (animated) {
                stopAnimation();
            }
            if ($(window).width() < 768) {
                checkScrollingText(false);
            }
        });

        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 740) {
                if (activeAnimationCount) {
                    stopAnimation()
                }
            } else {
                if (!animated && $(window).width() < 768) {
                    checkScrollingText(false);
                }
            }
        });

        if ($(window).width() < 767) {
            checkScrollingText(false);
        }

        $('#mega-navi .container .inner-container ul li').on('click', function (e)
        {
            e.stopPropagation();
            if (!$(this).hasClass('is-selected', 'has-active-children')) {
                push2dataLayer({
                    'event': 'iconNavigation',
                    'clickedItem': $(this).children('a').text().trim(),
                    'iconPosition': $(this).index() + 1
                });
            }
            productImpressionPosition = 1;
        });

        $('#more-categories, #more-categories-block').on('click', function (e)
        {
            e.preventDefault();
            $('#mobile-navi').show().addClass('menu-shown').css('z-index', '1000');
            if ($(this).attr("id") === 'more-categories-block') {
                push2dataLayer({
                    'event': 'categoryButton',
                    'currentCategory': '<?= isset($categoryName) ? $categoryName : '' ?>'
                });
            }
        });

        $('#discover-my-world').click(function (e)
        {
            var userNotLogged = !(typeof window.userLogedIn !== 'undefined' && window.userLogedIn);
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
        catcher.loginInterestSidebarNotLoggedInText = '<p class="additional-message"><span class="burger-menu-icon interest"></span><span class="wishlist-message"><?= __d('itool_customer', 'Please sign in or register to discover your own individual World.') ?></span></p>';

        if ($(window).width() < 768 || $('#mega-navi').is(":hidden")) return; // following js is not needed on mobile with touch

        var body = $('body'),
            header = $('header.row'),
            //search_form = $('#search-form'),
            messages = $('#messages'),
            banner = $('#banners-carousel'),
            bubble_banner = $('#bubble-banner'),
            help_page_banner = $('.help-page-banner'),
            cat_hero = $('.row.category-hero-container'),
            has_active_children = $('#mega-navi .is-selected ul, #mega-navi ul.level-1 li.is-selected').length,
            mega_navi = $('#mega-navi').addClass(has_active_children ? 'active-children': ''),
            mega_navi_height = mega_navi.children('.container').outerHeight(),
            mega_navi_layer = $('#mega-navi > .layer'),
            maga_navi_level0 = $('#mega-navi .container .inner-container ul.level-0'),
            maga_navi_level0_width = maga_navi_level0.outerWidth(),
            selected_category = $('#mega-navi .container .inner-container ul.level-0 li.is-selected'),
            categories_with_children = $('#mega-navi .container .inner-container ul li > a.has-children, #mega-navi .container .inner-container ul li > a.has-children ~'),
            subcategory_with_selected_children = $('#mega-navi ul.level-1 li.is-selected').parent().addClass('active');
        function checkLevel0 () {
            maga_navi_level0_width = maga_navi_level0.outerWidth();
            maga_navi_level0_elements_width = 0;
            maga_navi_level0.children('li').each(function () {
                maga_navi_level0_elements_width += $(this).outerWidth();
            });
            if (maga_navi_level0_elements_width < maga_navi_level0_width) {
                maga_navi_level0.parent().addClass('centered-tabs');
            }
            else if (maga_navi_level0.parent().hasClass('centered-tabs')) {
                maga_navi_level0.parent().removeClass('centered-tabs');
                maga_navi_level0.parent().trigger('scroll');
            }
        }
        checkLevel0();

        if (has_active_children) {
            //mega_navi.parent().css('padding-bottom', mega_navi_height / 2);
            mega_navi;
            subcategory_with_selected_children;
            subcategory_with_selected_children.parent().addClass('has-active-children');
        }

        categories_with_children.on('mouseover', function (e)
        {
            var sub_categories_height = $(this).siblings('ul.level-1').outerHeight();
            if (!has_active_children) {
                mega_navi_layer.show().css('border-top', 'solid ' + sub_categories_height + 'px white');
            }
        }).on('mouseout', function (e)
        {
            mega_navi_layer.hide();
        });

        function getHeaderStatus ()
        {
            var output = {
                headerHeight: header.outerHeight(),
                //searchFormHeight: search_form.outerHeight(),
                messageHeight: messages.outerHeight(),
                bubbleBannerHeight: bubble_banner.length ? bubble_banner.outerHeight() - 56 : 0,
                helpPageBannerHeight: help_page_banner.length ? help_page_banner.outerHeight() - 56 : 0,
                bannerHeight: banner.length ? banner.outerHeight() - 56 : 0,
                catHeroHeight: cat_hero.length ? cat_hero.outerHeight() : 0
            };

            return output;
        }

        $(window).on('load scroll resize', function (e)
        {
            window.setTimeout(function ()
            {
                var scroll_top = $(this).scrollTop(),
                    header_status = getHeaderStatus(),
                    threshold = header_status.headerHeight
                              //+ header_status.searchFormHeight
                              + header_status.messageHeight
                              + header_status.bannerHeight
                              + header_status.helpPageBannerHeight
                              + header_status.bubbleBannerHeight
                              + header_status.catHeroHeight
                              - mega_navi_height;
                if (scroll_top > 0 && scroll_top > threshold) {
                    body.css('margin-top', mega_navi_height);
                    mega_navi.addClass('fixed').css('top', header_status.headerHeight);
                } else {
                    body.css('margin-top', header_status.catHeroHeight ? '8px' : 'initial');
                    mega_navi.removeClass('fixed').css('top', -1);
                }
            }, 10);
            checkLevel0();
        });

        $('#mega-navi .gradient').on('click', function (e)
        {
            var navi_id = $(this).attr('rel'),
                navigation = navi_id === 'main-navi' ? $('#main-navi').parent() : $('#' + navi_id),
                navigation_position = navigation.scrollLeft(),
                scrolling = navigation.scrollLeft()
                          + ($(this).hasClass('left') ? -256 : 256);

            navigation.animate({
                'scrollLeft': scrolling
            }, 128);
        });

        mega_navi.find('.inner-container, ul.level-1').on('scroll', function (e)
        {
            var scroll_left = $(this).scrollLeft(),
                this_jsel = $(this).get(0),
                max_scroll = this_jsel.scrollWidth - this_jsel.clientWidth,
                gradient_left = $(this).siblings('.gradient.left'),
                gradient_right = $(this).siblings('.gradient.right');

            gradient_left.fadeIn(128); // because of my-world..
            gradient_right.fadeIn(128);
            if (!max_scroll) {
                gradient_left.stop().hide();
                gradient_right.stop().hide();
            } else if (scroll_left <= 0) {
                gradient_left.stop().hide();
            } else if (scroll_left >= max_scroll) {
                gradient_right.stop().hide();
            } else {
                gradient_left.fadeIn(128);
                gradient_right.fadeIn(128);
            }
        }).on('load', function (e)
        {
            if (selected_category.length) {
                if (!$(this).attr('id')) {
                    $(this).scrollTo(selected_category);
                } else {
                    $(this).closest('.inner-container').scrollTo($(this).closest('.has-active-children'));
                }
            }
        }).trigger('load').trigger('scroll');
    });
</script>
