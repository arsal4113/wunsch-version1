<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });
%>
<div class="row wrapper border-bottom white-bg page-heading">
<% if (strpos($action, 'add') === false): %>
    <div class="col-sm-5">
        <h2><?= __('Edit <%= $singularHumanName %>') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of <%= $pluralHumanName %>'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
    </div>
<% else: %>
    <div class="col-sm-8">
        <h2><?= __('Add New <%= $singularHumanName %>') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of <%= $pluralHumanName %>'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
            </div>
        </div>
    </div>
<% endif; %>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
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
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('<%= $field %>')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => 'form-control', 'options' => $<%= $keyFields[$field] %>, 'empty' => true]) ?>
                        </div>
                    </div>
<%
            } else {
%>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('<%= $field %>')); ?></label>
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
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('<%= $field %>')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => 'form-control', 'empty' => true, 'default' => '']) ?>
                        </div>
                    </div>
<%
            } else {
%>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('<%= $field %>')); ?></label>
                        <div class="col-sm-10">
<%
                $class = "form-control";
                if ($fieldData['type'] === 'boolean') {
                    $class = "custom-checkbox";

%>
                            <div class="i-checks">
<%
                }
%>
                            <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => '<%= $class %>']) ?>
<%
                if ($fieldData['type'] === 'boolean') {
%>
                            </div>
<%
                }
%>
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
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('<%= $assocData['property'] %>._ids')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
<%
        }
    }
%>
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
