<div class="col-sm-2">
    <?= $this->Form->input($image, ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
</div>
<label class="col-sm-1 control-label"><?= $this->Form->label(__('AltTag')); ?></label>
<div class="col-sm-3">
    <?= $this->Form->input($image . '_alt_tag', ['label' => false, 'class' => 'form-control', 'type' => 'text']) ?>
</div>
<label class="col-sm-1 control-label"><?= $this->Form->label(__('TitleTag')); ?></label>
<div class="col-sm-3">
    <?= $this->Form->input($image . '_title_tag', ['label' => false, 'class' => 'form-control', 'type' => 'text']) ?>
</div>
