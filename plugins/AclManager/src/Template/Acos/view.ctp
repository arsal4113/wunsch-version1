<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Aco'), ['action' => 'edit', $aco->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Aco'), ['action' => 'delete', $aco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aco->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aco'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Aros Acos'), ['controller' => 'ArosAcos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aros Aco'), ['controller' => 'ArosAcos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Aros'), ['controller' => 'Aros', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aro'), ['controller' => 'Aros', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="acos view large-10 medium-9 columns">
    <h2><?= h($aco->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Model') ?></h6>
            <p><?= h($aco->model) ?></p>
            <h6 class="subheader"><?= __('Alias') ?></h6>
            <p><?= h($aco->alias) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aco->id) ?></p>
            <h6 class="subheader"><?= __('Parent Id') ?></h6>
            <p><?= $this->Number->format($aco->parent_id) ?></p>
            <h6 class="subheader"><?= __('Foreign Key') ?></h6>
            <p><?= $this->Number->format($aco->foreign_key) ?></p>
            <h6 class="subheader"><?= __('Lft') ?></h6>
            <p><?= $this->Number->format($aco->lft) ?></p>
            <h6 class="subheader"><?= __('Rght') ?></h6>
            <p><?= $this->Number->format($aco->rght) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related ArosAcos') ?></h4>
    <?php if (!empty($aco->aros_acos)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Aro Id') ?></th>
            <th><?= __('Aco Id') ?></th>
            <th><?= __(' Create') ?></th>
            <th><?= __(' Read') ?></th>
            <th><?= __(' Update') ?></th>
            <th><?= __(' Delete') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($aco->aros_acos as $arosAcos): ?>
        <tr>
            <td><?= h($arosAcos->id) ?></td>
            <td><?= h($arosAcos->aro_id) ?></td>
            <td><?= h($arosAcos->aco_id) ?></td>
            <td><?= h($arosAcos->_create) ?></td>
            <td><?= h($arosAcos->_read) ?></td>
            <td><?= h($arosAcos->_update) ?></td>
            <td><?= h($arosAcos->_delete) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'ArosAcos', 'action' => 'view', $arosAcos->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'ArosAcos', 'action' => 'edit', $arosAcos->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ArosAcos', 'action' => 'delete', $arosAcos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arosAcos->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Aros') ?></h4>
    <?php if (!empty($aco->aros)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Parent Id') ?></th>
            <th><?= __('Model') ?></th>
            <th><?= __('Foreign Key') ?></th>
            <th><?= __('Alias') ?></th>
            <th><?= __('Lft') ?></th>
            <th><?= __('Rght') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($aco->aros as $aros): ?>
        <tr>
            <td><?= h($aros->id) ?></td>
            <td><?= h($aros->parent_id) ?></td>
            <td><?= h($aros->model) ?></td>
            <td><?= h($aros->foreign_key) ?></td>
            <td><?= h($aros->alias) ?></td>
            <td><?= h($aros->lft) ?></td>
            <td><?= h($aros->rght) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Aros', 'action' => 'view', $aros->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Aros', 'action' => 'edit', $aros->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Aros', 'action' => 'delete', $aros->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aros->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
