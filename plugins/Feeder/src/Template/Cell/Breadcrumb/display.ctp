<?php foreach($breadcrumbItems as $name => $link) : ?>
    <?php if ($link !== null) : ?>
        <?= $this->Html->link($name, $link); ?> <span> / </span>
    <?php else : ?>
        <span class="breadcrumb-item-name"><?= Cake\Utility\Text::truncate($name, 20) ?></span>
    <?php endif; ?>
<?php endforeach; ?>

