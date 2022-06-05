<?php
$this->Paginator->templates([
    'ellipsis' => false
]);
?>


<?php
if (isset($urlParams)) {
    echo $this->Paginator->options([
        'url' => isset($urlParams) ? $urlParams : []
    ]);} ?>
<div class="row paginator">
    <div class="col-lg-12">
        <div class="pagination pull-left">
            <?=
            $this->Paginator->counter(
                __('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}')
            );
            ?>
        </div>
        <?php if (str_replace(",", "", $this->Paginator->counter('{{pages}}')) > 1): ?>
            <ul class="pagination pull-right">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers(['first' => __('First page'), 'last' => __('Last page')]) ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
        <?php endif; ?>
        <div class="pagination pagination-limiter pull-right">
            <?= $this->Paginator->limitControl(['20' => '20', '50' => '50', '100' => '100', '250' => '250', '500' => '500']) ?>
        </div>
    </div>
</div>
