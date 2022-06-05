<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><?= h($coreConfiguration->configuration_group)  . ' | ' . h($coreConfiguration->configuration_path) ?></h2>
		<ol class="breadcrumb">
			<li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
			<li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<div class="btn-group btn-group-justified btn-actions">
				<div class="btn-group">
					<button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
						<?= __('Configurations') ?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><?= $this->Html->link(__('List of Configurations'), ['action' => 'index']) ?></li>
						<li><?= $this->Html->link(__('Add New Configuration'), ['action' => 'add']) ?></li>
						<li><?= $this->Html->link(__('Edit Configuration'), ['action' => 'edit', $coreConfiguration->id]) ?></li>
						<li class="divider"></li>
						<li><?= $this->Form->postLink(__('Delete Configuration'), ['action' => 'delete', $coreConfiguration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreConfiguration->id)]) ?> </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox">
		<div class="ibox-title">
			<h5><?= __('General Information') ?></h5>
			<div class="ibox-tools">
				<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			</div>
		</div>
		<div class="ibox-content">
			<div class="row">
				<div class="col-lg-12">
					<dl class="dl-horizontal">
						<dt><?= __('Seller') ?>:</dt>
						<dd><?= $coreConfiguration->has('core_seller') ? $this->Html->link($coreConfiguration->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $coreConfiguration->core_seller->id]) : '' ?></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt><?= __('Configuration Group') ?>:</dt>
						<dd><?= h($coreConfiguration->configuration_group) ?></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt><?= __('Configuration Path') ?>:</dt>
						<dd><?= h($coreConfiguration->configuration_path) ?></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt><?= __('Configuration Value') ?>:</dt>
						<dd><?= h($coreConfiguration->configuration_value) ?></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt><?= __('Created') ?>:</dt>
						<dd><?= h($coreConfiguration->created) ?></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt><?= __('Modified') ?>:</dt>
						<dd><?= h($coreConfiguration->modified) ?></dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>
