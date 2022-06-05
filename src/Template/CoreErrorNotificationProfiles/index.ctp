<div class="row mt">
    <div class="col-lg-9">
        <h3><i class="fa fa-angle-right"></i> <?= __('List of Core Error Notification Profiles') ?></h3>
    </div>
    <div class="col-lg-3">
        <div class="btn-group btn-group-justified btn-actions">
            <div class="btn-group">
                <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Core Error Notification Profile'), ['action' => 'add'], ['class' => 'btn btn-sm btn-info', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>

<section id="unseen">
    <?= $this->element('simple_search'); ?>
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('core_seller_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('code') ?></th>
                <th><?= $this->Paginator->sort('sub_code') ?></th>
                <th><?= $this->Paginator->sort('email_to') ?></th>
                <th><?= $this->Paginator->sort('email_cc') ?></th>
                <th><?= $this->Paginator->sort('email_bcc') ?></th>
                <th><?= $this->Paginator->sort('email_subject') ?></th>
                <th><?= $this->Paginator->sort('is_active') ?></th>
                <th><?= $this->Paginator->sort('is_running') ?></th>
                <th><?= $this->Paginator->sort('last_run') ?></th>
                <th><?= $this->Paginator->sort('run_interval') ?></th>
                <th><?= $this->Paginator->sort('next_run') ?></th>
                <th class="actions centered"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($coreErrorNotificationProfiles as $coreErrorNotificationProfile): ?>
        <tr>
            <td><?= $this->Number->format($coreErrorNotificationProfile->id) ?></td>
            <td>
                <?= $coreErrorNotificationProfile->has('core_seller') ? $this->Html->link($coreErrorNotificationProfile->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $coreErrorNotificationProfile->core_seller->id]) : '' ?>
            </td>
            <td><?= h($coreErrorNotificationProfile->name) ?></td>
            <td><?= h($coreErrorNotificationProfile->type) ?></td>
            <td><?= h($coreErrorNotificationProfile->code) ?></td>
            <td><?= h($coreErrorNotificationProfile->sub_code) ?></td>
            <td><?= h($coreErrorNotificationProfile->email_to) ?></td>
            <td><?= h($coreErrorNotificationProfile->email_cc) ?></td>
            <td><?= h($coreErrorNotificationProfile->email_bcc) ?></td>
            <td><?= h($coreErrorNotificationProfile->email_subject) ?></td>
            <td><?= h($coreErrorNotificationProfile->is_active) ?></td>
            <td><?= h($coreErrorNotificationProfile->is_running) ?></td>
            <td><?= h($coreErrorNotificationProfile->last_run) ?></td>
            <td><?= $this->Number->format($coreErrorNotificationProfile->run_interval) ?></td>
            <td><?= h($coreErrorNotificationProfile->next_run) ?></td>
            <td class="actions centered">
                <?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $coreErrorNotificationProfile->id], ['class' => 'btn btn-xs btn-default', 'escape' => false]) ?>
                <?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $coreErrorNotificationProfile->id], ['class' => 'btn btn-xs btn-warning', 'escape' => false]) ?>
                <?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $coreErrorNotificationProfile->id], ['class' => 'btn btn-xs btn-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $coreErrorNotificationProfile->id)]) ?>
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
    </div>
</section>
