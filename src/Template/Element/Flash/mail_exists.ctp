<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?= ($message) ?>
    <?= __('Do you want to ')?>
    <?= $this->Html->link(__('login?'), $this->Url->build('/login'), ['style' => 'color: #484f4f; text-decoration: underline;']) ?>
</div>
