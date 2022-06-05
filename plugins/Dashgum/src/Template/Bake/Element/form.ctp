<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });
%>
<div class="row mt">
<% if (strpos($action, 'add') === false): %>
    <div class="col-lg-8">
        <h3><i class="fa fa-angle-right"></i> <?= __('Edit <%= $singularHumanName %>') ?></h3>
    </div>
    <div class="col-lg-4">
        <div class="btn-group btn-group-justified btn-actions">
            <div class="btn-group">
                <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of <%= $pluralHumanName %>'), ['action' => 'index'], ['class' => 'btn btn-sm btn-info', 'escape' => false]) ?>
            </div>
            <div class="btn-group">
                <?= 
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $<%= $singularVar %>-><%= $primaryKey[0] %>],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $<%= $singularVar %>-><%= $primaryKey[0] %>)]
                    )
                   ?>
            </div>
        </div>
    </div>
<% else: %>
    <div class="col-lg-9">
        <h3><i class="fa fa-angle-right"></i> <?= __('Add New <%= $singularHumanName %>') ?></h3>
    </div>
    <div class="col-lg-3">
        <div class="btn-group btn-group-justified btn-actions">
            <div class="btn-group">
                <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of <%= $pluralHumanName %>'), ['action' => 'index'], ['class' => 'btn btn-sm btn-info', 'escape' => false]) ?>
            </div>
        </div>
    </div>    
<% endif; %>
</div>
<section id="unseen">
    <?= $this->Form->create($<%= $singularVar %>, ['class' => 'form-horizontal style-form']); ?>
<%
        foreach ($fields as $field) {
            if (in_array($field, $primaryKey)) {
                continue;
            }
            if (isset($keyFields[$field])) {
                $fieldData = $schema->column($field);
                if (!empty($fieldData['null'])) {
%>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= $field %>')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => 'form-control', 'options' => $<%= $keyFields[$field] %>, 'empty' => true]) ?>
        </div>
    </div>
<%
                } else {
%>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= $field %>')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => 'form-control', 'options' => $<%= $keyFields[$field] %>]) ?>
        </div>
    </div>
<%
                }
                continue;
            }
            if (!in_array($field, ['created', 'modified', 'updated'])) {
                $fieldData = $schema->column($field);
                if (($fieldData['type'] === 'date') && (!empty($fieldData['null']))) {
%>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= $field %>')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => 'form-control', 'empty' => true, 'default' => '']) ?>
        </div>
    </div>
<%
                } else {
%>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= $field %>')); ?></label>
        <div class="col-sm-10">
<%
                    $class = "form-control";
					if ($fieldData['type'] === 'boolean') {
						$class = "custom-checkbox";
					}   
%>
            <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => '<%= $class %>']) ?>
        </div>
    </div>
<%
                }
            }
        }
        if (!empty($associations['BelongsToMany'])) {
            foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
%>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= $assocData['property'] %>._ids')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
<%
            }
        }
%>
    <div class="btn-group form-actions">
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-default btn-sm btn-success']) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
    </div>    
    <?= $this->Form->end() ?>
</section>
