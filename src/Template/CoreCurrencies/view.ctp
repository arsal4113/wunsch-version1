<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Core Currency'), ['action' => 'edit', $coreCurrency->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Core Currency'), ['action' => 'delete', $coreCurrency->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreCurrency->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Core Currencies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Core Currency'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="coreCurrencies view large-10 medium-9 columns">
    <h2><?= h($coreCurrency->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Code') ?></h6>
            <p><?= h($coreCurrency->code) ?></p>
            <h6 class="subheader"><?= __('Symbol') ?></h6>
            <p><?= h($coreCurrency->symbol) ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($coreCurrency->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($coreCurrency->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($coreCurrency->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($coreCurrency->modified) ?></p>
        </div>
    </div>
</div>
