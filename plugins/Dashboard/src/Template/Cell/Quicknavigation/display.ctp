<?php if(!empty($menus)): ?>
<div class="col-lg-<?= $columnWidth ?>">
    <div class="style1 cloud-bg" style="margin-top: 10px; margin-bottom: 10px; padding: 20px;">
        <p class="text-right"><span class="label label-info"><?= $labelText ?></span></p>
        <br/>
        <div class="text-center">
            <?php $colors = ['info', 'primary', 'default', 'warning', 'success']; ?>

            <?php foreach($menus as $menu): ?>
                <?= $this->Html->link("<i class=\"fa " . $menu['icon'] . "\"></i>". " ". $menu['name'], $menu['link'], ['escape' => false, 'class' => 'btn btn-' . $colors[array_rand($colors)]]); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>