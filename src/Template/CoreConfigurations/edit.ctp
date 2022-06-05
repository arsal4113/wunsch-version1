i<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
		<h2><?= __('Edit Configuration') ?></h2>
		<ol class="breadcrumb">
			<li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
			<li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
		</ol>
	</div>
	<div class="col-sm-7">
		<div class="title-action">
			<div class="btn-group btn-group-justified btn-actions">
				<div class="btn-group">
					<?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Configurations'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
				</div>
				<div class="btn-group">
					<?=
					$this->Form->postLink(
						__('Delete'),
						['action' => 'delete', $coreConfiguration->id],
						['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $coreConfiguration->id)]
					)
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox">
		<div class="ibox-content">
			<div class="row">
				<div class="col-lg-12">
					<?= $this->Form->create($coreConfiguration, ['class' => 'form-horizontal style-form']); ?>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?= $this->Form->label(__('Seller')); ?></label>
						<div class="col-sm-10">
							<?= $this->Form->input('core_seller_id', ['empty' => true, 'options' => $coreSellers, 'label' => false, 'class' => 'form-control']) ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?= $this->Form->label(__('configuration_group')); ?></label>
						<div class="col-sm-10">
							<?= $this->Form->input('configuration_group', ['label' => false, 'class' => 'form-control']) ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?= $this->Form->label(__('configuration_path')); ?></label>
						<div class="col-sm-10">
							<?= $this->Form->input('configuration_path', ['label' => false, 'class' => 'form-control']) ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?= $this->Form->label(__('configuration_value')); ?></label>
						<div class="col-sm-10">
							<?= $this->Form->input('configuration_value', ['label' => false, 'class' => 'form-control']) ?>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
							<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
						</div>
					</div>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->start('script') ?>
<script>
	$(document).ready(function () {
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});
	});
</script>
<?php $this->end() ?>