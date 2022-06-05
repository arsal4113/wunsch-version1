<div class="row">
    <div class="col-lg-6">
        <?= $this->Form->label(__('Anzeigen: ')); ?>
    </div>
    <div class="col-lg-6">
        <?= $this->Form->input('Limit', [
            'type' => 'select',
            'options' => [6 => 6, 12 => 12, 24 => 24, 48 => 48, 96 => 96],
            'class' => 'col-lg-7 form-control input-sm',
            'default' => isset($limit) ? [$limit] : [],
            'label' => false,
            'div' => false,
            'id' => 'selectLimit']); ?>
    </div>
</div>
<?php $this->start('script'); ?>
<?= $this->fetch('script') ?>
<script>
    var url = window.location.href;
    var isSearch = window.location.href.match(/.+(\?)/) ? true: false;
    var isLimit = window.location.href.match(/(\?|\&)limit=([0-9]+)/) ? true : false;
    $("#selectLimit").change(function (){
        var limit = $(this).val();
        if (isLimit) {
            window.location.href = url.replace(/(\?|\&)(limit)=[0-9]+/, '$1$2=' + limit);
        } else {
            isSearch? url += '&' : url += '?';
            window.location.href = url + 'limit=' + limit;
        }
    });
</script>
<?php $this->end(); ?>
