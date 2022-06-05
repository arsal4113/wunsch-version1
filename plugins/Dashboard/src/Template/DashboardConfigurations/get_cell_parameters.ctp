<div class="form-group">
    <label class="col-sm-2 control-label"><?= $this->Form->label(__('cell_configuration')); ?></label>
    <div class="col-sm-10">
        <?= $this->Form->input('cell_configuration', ['label' => false, 'class' => 'form-control', 'value' => $parameters]) ?>
        <br>
        <p><strong><?= __('Method Description') ?>:</strong></p>
        <pre><?php echo(str_replace("     ", " ", $docComment)) ?></pre>
        <p><strong><?= __('Notes') ?>:</strong></p>
        <p>
            <i>*<?= __('Please do not change following parameters: dashboardType, currentSellerId, currentUserId.') ?></i>
        </p>
    </div>
</div>