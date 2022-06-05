<%
use Cake\Utility\Inflector;

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
    ->map(function($field) use ($immediateAssociations) {
        foreach ($immediateAssociations as $alias => $details) {
            if ($field === $details['foreignKey']) {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function($fields, $value) {
        return $fields + $value;
    }, []);

$groupedFields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function($field) use ($schema, $associationFields) {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field])) {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($<%= $singularVar %>-><%= $displayField %>) ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-5">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('<%= $pluralHumanName %>') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of <%= $pluralHumanName %>'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New <%= $singularHumanName %>'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit <%= $singularHumanName %>'), ['action' => 'edit', <%= $pk %>]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete <%= $singularHumanName %>'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?> </li>
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
<% if ($groupedFields['string']) : %>
<% foreach ($groupedFields['string'] as $field) : %>
                    <dl class="dl-horizontal">
<% if (isset($associationFields[$field])) :
    $details = $associationFields[$field];
%>
                        <dt><?= __('<%= Inflector::humanize($details['property']) %>') ?>:</dt>
                        <dd><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></dd>
<% else : %>
                        <dt><?= __('<%= Inflector::humanize($field) %>') ?>:</dt>
                        <dd><?= h($<%= $singularVar %>-><%= $field %>) ?></dd>
<% endif; %>
                    </dl>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['number']) : %>
<% foreach ($groupedFields['number'] as $field) : %>
                    <dl class="dl-horizontal">
                        <dt><?= __('<%= Inflector::humanize($field) %>') ?>:</dt>
                        <dd><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></dd>
                    </dl>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['date']) : %>
<% foreach ($groupedFields['date'] as $field) : %>
                    <dl class="dl-horizontal">
                        <dt><?= __('<%= Inflector::humanize($field) %>') ?>:</dt>
                        <dd><?= h($<%= $singularVar %>-><%= $field %>) ?></dd>
                    </dl>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['boolean']) : %>
<% foreach ($groupedFields['boolean'] as $field) : %>
                    <dl class="dl-horizontal">
                        <dt><?= __('<%= Inflector::humanize($field) %>') ?>:</dt>
                        <dd><?= $<%= $singularVar %>-><%= $field %> ? __('Yes') : __('No'); ?></dd>
                    </dl>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['text']) : %>
<% foreach ($groupedFields['text'] as $field) : %>
                    <dl class="dl-horizontal">
                        <dt><?= __('<%= Inflector::humanize($field) %>') ?>:</dt>
                        <dd><?= $this->Text->autoParagraph(h($<%= $singularVar %>-><%= $field %>)); ?></dd>
                    </dl>
<% endforeach; %>
<% endif; %>
                </div>
            </div>
        </div>
    </div>

<%
    $relations = $associations['HasMany'] + $associations['BelongsToMany'];
    foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
%>
    <?php if (!empty($<%= $singularVar %>-><%= $details['property'] %>)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related <%= Inflector::humanize(Inflector::underscore($otherPluralHumanName)) %>') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
<% foreach ($details['fields'] as $field): %>
                            <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
<% endforeach; %>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($<%= $singularVar %>-><%= $details['property'] %> as $<%= $otherSingularVar %>): ?>
                        <tr>
<% foreach ($details['fields'] as $field): %>
                            <td><?= h($<%= $otherSingularVar %>-><%= $field %>) ?></td>
<% endforeach; %>
<% $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; %>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', <%= $otherPk %>]) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => '<%= $details['controller'] %>', 'action' => 'edit', <%= $otherPk %>]) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => '<%= $details['controller'] %>', 'action' => 'delete', <%= $otherPk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $otherPk %>)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<% endforeach; %>
</div>
