<?php use Cake\Utility\Inflector; ?>
    <div class="col-lg-12">
        <a class="collapse-link">
            <div class="ibox collapsed">
                <div class="ibox-title">
                    <h5><?= __('Search Box') ?> -
                        <small><?= __('Find {0} here', str_replace('Core ', '', Inflector::humanize(Inflector::underscore($this->name)))) ?></small>
                    </h5>
                    <div class="ibox-tools">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
        </a>
        <div class="ibox-content">
            <?= $this->Form->create(null, ['id' => 'search-form', 'class' => 'form-horizontal', 'type' => 'GET']); ?>
            <div class="row">
                <?php foreach ($availableColumns as $availableColumn): ?>
                    <div class="col-lg-6 alex">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left;">
                                 <?= $this->Form->label($availableColumn['label']); ?> 
                            </label>
                            <div class="col-sm-8">
                            <?= $this->Form->input($availableColumn['name'], ['type' => $availableColumn['type'], 'options' => $availableColumn['options'], 'label' => false, 'empty' => true, 'class' => 'form-control input-sm', 'id' => $availableColumn['id'], 'div' => false, 'placeholder' => __('Type {0} here...', $availableColumn['label'])]); ?></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="btn-group" style="float: right;">
                <?= $this->Form->button('<i class="fa fa-search"></i>' . ' ' . __('Search'), ['id' => 'submit-button', 'class' => 'btn btn-primary btn-sm']); ?>
                <?= $this->Form->button('<i class="fa fa-eraser"></i>' . ' ' . __('Reset'), ['id' => 'search-reset', 'class' => 'btn btn-danger btn-sm']); ?>
            </div>

            <?= $this->Form->end(); ?>
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
<?php $this->start('script'); ?>
<?= $this->fetch('script') ?>
    <script>
        $("#search-reset").click(function (e) {
            e.preventDefault();
            var url = window.location.origin + window.location.pathname
            window.location.href = url; 
        });

        $(function(){
        	$('input[id = "date-time-picker"]').daterangepicker({
        		autoUpdateInput: false,
        		locale: {
            		format: 'DD.MM.YYYY'
        		}
        	});

        	$('input[id = "date-time-picker"]').on('apply.daterangepicker', function(ev, picker) {
      			$(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
  			});
        });
    </script>
<?php $this->end(); ?>