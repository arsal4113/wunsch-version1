<?php
    $event = new \Cake\Event\Event('Template.render.sidebar', $this, ['sidebar' => '', 'view' => $this]);
    $this->eventManager()->dispatch($event);
    if (!empty($event->result['sidebar'])) {
        ksort($event->result['sidebar']);
        $menu = $this->Sidebar->removeMenu($event->result['sidebar'], $authUser['permissions']);
    }

    $this->request->params['plugin'];
    $this->request->params['controller'];
    $this->request->params['action'];
?>

<aside>
	<div id="sidebar" class="nav-collapse">
		<ul class="sidebar-menu" id="nav-accordion">
            <li class="sub-menu">
                <?= $this->cell('SuperUserSellerSwitch'); ?>
            </li>
            <?php foreach($menu as $key => $group): ?>
                <?php
                    $group['class'] = "";
                    foreach($group['links'] as $link) {
                        if( $link['link']['plugin'] == $this->request->params['plugin'] &&
                            $link['link']['controller'] == $this->request->params['controller'] &&
                            $link['link']['action'] == $this->request->params['action']
                        ) {
                            $group['class'] = "active";
                        }
                    }
                ?>
                <li class="sub-menu">
                    <a class="<?= $group['class'] ?>" href="javascript:;" >
                        <i class="fa <?= $group['icon']?>"></i>
                        <span><?= __($group['name']) ?></span>
                    </a>
                    <ul class="sub">
                        <?php foreach($group['links'] as $link) : ?>
                            <?php
                                $class = "";
                                if( $link['link']['plugin'] == $this->request->params['plugin'] &&
                                    $link['link']['controller'] == $this->request->params['controller'] &&
                                    $link['link']['action'] == $this->request->params['action']
                                ) {
                                    $class = "active";
                                }
                            ?>
                            <li class="<?= $class ?>">
                                <?= $this->Html->link(__($link['name']), $link['link']) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
    	</ul>
	</div>
</aside>