<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Core Currencies'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="coreCurrencies form large-10 medium-9 columns">
    <?= $this->Form->create($coreCurrency); ?>
    <fieldset>
        <legend><?= __('Add Core Currency') ?></legend>
        <?php
            echo $this->Form->input('code');
            echo $this->Form->input('symbol');
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
