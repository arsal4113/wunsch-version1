<?php use Cake\Utility\Inflector; ?>
<div class="row">    
	<div class="col-xs-12">
		<div class="search-box input-group">
			<div class="input-group-btn search-panel">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span id="search_concept"><?= !empty($this->request->data['search_param']) ? Inflector::humanize($this->request->data['search_param']) : __('Filter by') ?></span> 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<?php foreach($availableColumns as $availableColumn) { ?>
						<li><a href="#<?= $availableColumn; ?>"><?= Inflector::humanize($availableColumn); ?></a></li>
					<?php } ?>
				</ul>
			</div>
			<?= $this->Form->create(); ?>
			<div class="input-group">
				<input type="hidden" name="search_param" value="<?= !empty($this->request->data['search_param']) ? $this->request->data['search_param'] : '' ?>" id="search_param">         
				<input type="text" class="form-control" name="search_value" placeholder="<?= __('Search term...') ?>" value="<?= !empty($this->request->data['search_value']) ? $this->request->data['search_value'] : '' ?>">
				<span class="input-group-btn">
					<?= $this->Form->button('<span class="glyphicon glyphicon-search"></span>', ['class' => 'btn btn-default', 'escape' => false]); ?>
				</span>
			</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>
<?php $this->start('script'); ?>
	<script type="text/javascript">
		$(document).ready(function(e){
			$('.search-panel .dropdown-menu').find('a').click(function(e) {
				e.preventDefault();
				var param = $(this).attr("href").replace("#","");
				var concept = $(this).text();
				$('.search-panel span#search_concept').text(concept);
				$('.input-group #search_param').val(param);
			});
		});
	</script>
<?php $this->end(); ?>