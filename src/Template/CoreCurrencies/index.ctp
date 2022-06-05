<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Core Currency'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="coreCurrencies index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('code') ?></th>
            <th><?= $this->Paginator->sort('symbol') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($coreCurrencies as $coreCurrency): ?>
        <tr>
            <td><?= $this->Number->format($coreCurrency->id) ?></td>
            <td><?= h($coreCurrency->code) ?></td>
            <td><?= h($coreCurrency->symbol) ?></td>
            <td><?= h($coreCurrency->name) ?></td>
            <td><?= h($coreCurrency->created) ?></td>
            <td><?= h($coreCurrency->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $coreCurrency->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $coreCurrency->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coreCurrency->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreCurrency->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
