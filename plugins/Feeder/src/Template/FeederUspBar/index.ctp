
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of USP Bar Texts') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Form->create(null, ['class' => 'form-horizontal style-form', 'url' => ['action' => 'activateUsp']]); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?= $this->Form->label(__('usp is active')); ?></label>
                <div class="col-sm-1">
                    <div class="i-checks">
                        <?= $this->Form->input('usp_is_active',
                            ['label' => false, 'type'=>'checkbox', 'class' => 'custom-checkbox', 'id' => 'usp_active', 'checked' => $uspIsActive == true ? true : false]) ?>
                    </div>
                </div>
                <div class="col-sm-2 ">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div class="col-sm-4"></div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Form->create(null, ['class' => 'form-horizontal style-form', 'url' => ['action' => 'addColors']]); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?= $this->Form->label(__('usp_font_color')); ?></label>
                <div class="col-sm-2">
                    <?= $this->Form->input('usp_font_color', ['label' => false, 'class' => 'form-control']) ?>
                    <div style="text-align: left;"><?= $uspFontColor ?></div>
                </div>
                <label class="col-sm-3 control-label"><?= $this->Form->label(__('usp_background_color')); ?></label>
                <div class="col-sm-2">
                    <?= $this->Form->input('usp_background_color', ['label' => false, 'class' => 'form-control']) ?>
                    <div style="text-align: left;"><?= $uspBackgroundColor ?></div>
                </div>
                <div class="col-sm-2 ">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New USP Bar Text'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?= $this->element('simple_search'); ?>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('usp_text') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('sort_order') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($feederUspBar as $feederUspBar): ?>
                                <tr>
                                    <td><?= $this->Number->format($feederUspBar->id) ?></td>
                                    <td><?= h($feederUspBar->usp_text) ?></td>
                                    <td><?= $this->Number->format($feederUspBar->sort_order) ?></td>
                                    <td><?= h($feederUspBar->modified) ?></td>
                                    <td><?= h($feederUspBar->created) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link(__('View'), ['action' => 'view', $feederUspBar->id]) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $feederUspBar->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $feederUspBar->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederUspBar->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $this->element('paginator'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>