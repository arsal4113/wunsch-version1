<?php
if(isset($authUser)) {
    $event = new \Cake\Event\Event('Template.render.sidebar', $this, ['user' => $authUser, 'sidebar' => '', 'view' => $this]);
    $this->eventManager()->dispatch($event);
    $sidebar = $event->getResult();
    if (!empty($sidebar)) {
        $menu = $this->Sidebar->removeMenu($sidebar, $authUser['permissions']);
    }
}
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <?= $this->Html->image('/img/profile_small.png', ['alt' => 'avatar', 'class' => '', 'width' => '30px']) ?>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"> <strong
                                    class="font-bold"><?= isset($authUser['email']) ? $authUser['email'] : '' ?></strong></span>
                            <span class="text-muted text-xs block"><?= isset($authUser['core_seller_name']) ? $authUser['core_seller_name'] : '' ?> <b
                                    class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><?= $this->Html->link(__('Log out'), ['controller' => 'CoreUsers', 'action' => 'logout', 'prefix' => false, 'plugin' => false]) ?></li>
                    </ul>
                    <span>
                        <?= $this->Html->link('Dashboard', ['controller' => 'Dashboards', 'action' => 'index', 'plugin' => 'Dashboard']) ?>
                    </span>
                </div>
                <div
                    class="logo-element"><?= $this->Html->image('/img/profile_small.png', ['alt' => 'avatar', 'class' => '', 'width' => '30px']) ?></div>
            </li>

            <?php
            foreach ($menu as $key => $group): ?>
                <?php
                $group['class'] = "";
                $group['collapse'] = "";
                foreach ($group['links'] as $link) {
                    if (isset($link['link'])) {
                        if ($link['link']['plugin'] == $this->request->params['plugin'] &&
                            $link['link']['controller'] == $this->request->params['controller'] &&
                            $link['link']['action'] == $this->request->params['action']
                        ) {
                            $group['class'] = "active";
                            $group['collapse'] = "in";
                        }
                    } else if (isset($link['links']) && !empty($link['links'])) {
                        if ($link['links'][0]['link']['plugin'] == $this->request->params['plugin'] &&
                            $link['links'][0]['link']['controller'] == $this->request->params['controller'] &&
                            $link['links'][0]['link']['action'] == $this->request->params['action']
                        ) {
                            $group['class'] = "active";
                            $group['collapse'] = "in";
                        }
                    }
                }
                ?>
                <li class="<?= $group['class'] ?>">
                    <?php
                        if(isset($group['isGroup']) && !$group['isGroup']){ ?>
                            <a href=<?= $this->Url->build($group['links']['link']) ?>>
                                <i class="fa <?= $group['icon'] ?>"></i>
                                <span><?= __($group['name']) ?></span>
                            </a>
                    <?php } else { ?>
                        <a href="#">
                            <i class="fa <?= $group['icon'] ?>"></i>
                            <span><?= __($group['name']) ?></span>
<!--                            <span class="fa arrow"></span>-->
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <?php foreach ($group['links'] as $link) : ?>
                                <?php if (isset($link['links']) && !empty($link['links'])) {
                                    $class = "";
                                    $collapse = "";
                                    if ($link['links'][0]['link']['plugin'] == $this->request->params['plugin'] &&
                                        $link['links'][0]['link']['controller'] == $this->request->params['controller'] &&
                                        $link['links'][0]['link']['action'] == $this->request->params['action']
                                    ) {
                                        $class = "active";
                                        $collapse = "in";
                                    }
                                    ?>
                                    <li class="<?= $class ?>">
                                        <a href="#">
                                            <span><?= __($link['name']) ?></span>
                                            <span class="fa arrow"></span>
                                        </a>
                                        <ul class="nav nav-third-level collapse <?= $collapse ?>">
                                            <?php foreach ($link['links'] as $_link) :
                                                $_class = "";
                                                if(sizeof($this->request->params['pass']) > 0 && $_link['link'][0] == $this->request->params['pass'][0]) {
                                                    $_class = "active";
                                                } ?>
                                                <li class="<?= $_class ?>">
                                                    <?= $this->Html->link(__($_link['name']), $_link['link']) ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php } elseif(isset($link['link']) && !empty($link['link'])) { ?>
                                    <?php
                                        $class = "";
                                        if (
                                            $link['link']['plugin'] == $this->request->params['plugin'] &&
                                            $link['link']['controller'] == $this->request->params['controller'] &&
                                            $link['link']['action'] == $this->request->params['action']
                                        ) {
                                            $class = "active";
                                        }
                                    ?>
                                    <li class="<?= $class ?>">
                                        <?php echo $this->Html->link(__($link['name']), $link['link']); ?>
                                    </li>
                                <?php } ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php endforeach; ?>
            <br/><br/>
        </ul>

    </div>
</nav>
