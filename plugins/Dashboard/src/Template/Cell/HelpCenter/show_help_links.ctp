<div class="col-lg-<?= $columnWidth; ?>">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-4">
                    <h4>
                        <?= __('Help Center'); ?>
                    </h4>
                </div>
                <div class="col-lg-4 col-lg-offset-4">
                    <?php
                    if (is_array($menus) && !empty($menus)) {
                        foreach ($menus as $menu) {
                            echo $this->Html->link(__($menu['name']), __($menu['link']), ['target' => '_blank', 'class' => 'btn btn-sm btn-outline btn-primary']);
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>