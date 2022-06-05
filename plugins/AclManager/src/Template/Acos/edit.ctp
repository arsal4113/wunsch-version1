<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aco->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aco->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Acos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Aros Acos'), ['controller' => 'ArosAcos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aros Aco'), ['controller' => 'ArosAcos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Aros'), ['controller' => 'Aros', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aro'), ['controller' => 'Aros', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="acos form large-10 medium-9 columns">
    <?= $this->Form->create($aco); ?>
    <fieldset>
        <legend><?= __('Edit Aco') ?></legend>
        <?php
            echo $this->Form->input('parent_id');
            echo $this->Form->input('model');
            echo $this->Form->input('foreign_key');
            echo $this->Form->input('alias');
            echo $this->Form->input('lft');
            echo $this->Form->input('rght');
            echo $this->Form->input('aros._ids', ['options' => $aros]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
