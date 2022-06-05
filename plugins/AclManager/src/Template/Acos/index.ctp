<div class="row mt">
	<div class="col-lg-6">
		<h3><i class="fa fa-angle-right"></i> <?= __('List of ACOs') ?></h3>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-group-justified btn-actions">
			<div class="btn-group">
				<?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add new ACO'), ['action' => 'add'], ['class' => 'btn btn-sm btn-info', 'escape' => false]) ?>
			</div>
			<div class="btn-group">
				<button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
					<?= __('AROs') ?>
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><?= $this->Html->link(__('List of AROs'), ['controller' => 'Aros', 'action' => 'index', 'plugin' => 'AclManager']) ?></li>
					<li><?= $this->Html->link(__('Add new ARO'), ['controller' => 'Aros', 'action' => 'add', 'plugin' => 'AclManager']) ?></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="acos index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('parent_id') ?></th>
            <th><?= $this->Paginator->sort('model') ?></th>
            <th><?= $this->Paginator->sort('foreign_key') ?></th>
            <th><?= $this->Paginator->sort('alias') ?></th>
            <th><?= $this->Paginator->sort('lft') ?></th>
            <th><?= $this->Paginator->sort('rght') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($acos as $aco): ?>
        <tr>
            <td><?= $this->Number->format($aco->id) ?></td>
            <td><?= $this->Number->format($aco->parent_id) ?></td>
            <td><?= h($aco->model) ?></td>
            <td><?= $this->Number->format($aco->foreign_key) ?></td>
            <td><?= h($aco->alias) ?></td>
            <td><?= $this->Number->format($aco->lft) ?></td>
            <td><?= $this->Number->format($aco->rght) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $aco->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aco->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aco->id)]) ?>
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
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
