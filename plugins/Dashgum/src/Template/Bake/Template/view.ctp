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
<div class="row mt">
    <div class="col-lg-9">
        <h3><i class="fa fa-angle-right"></i> <?= h($<%= $singularVar %>-><%= $displayField %>) ?></h3>
    </div>
    <div class="col-lg-3">
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
                    <li><?= $this->Form->postLink(__('Delete <%= $singularHumanName %>'), ['action' => 'delete', <%= $pk %>], ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section id="unseen">
    <h4 class="mb"><i class="fa fa-angle-right"></i> <?= __('General Information') ?></h4>
<% if ($groupedFields['string']) : %>
<% foreach ($groupedFields['string'] as $field) : %>
	<div class="row"> 
    	<div class="form-group">
<% if (isset($associationFields[$field])) :
            $details = $associationFields[$field];
%>
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= Inflector::humanize($details['property']) %>')); ?></label>
        <div class="col-sm-10">
            <p><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></p>
        </div>
<% else : %>
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= Inflector::humanize($field) %>')); ?></label>
        <div class="col-sm-10">
            <p><?= h($<%= $singularVar %>-><%= $field %>) ?></p>
        </div>
<% endif; %>
    	</div>  
	</div>         
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['number']) : %>
<% foreach ($groupedFields['number'] as $field) : %>
	<div class="row"> 
    	<div class="form-group">
    	    <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= Inflector::humanize($field) %>')); ?></label>
    	    <div class="col-sm-10">
    	        <p><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></p>
    	    </div>
    	</div>
	</div>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['date']) : %>
<% foreach ($groupedFields['date'] as $field) : %>
	<div class="row"> 
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= Inflector::humanize($field) %>')); ?></label>
	        <div class="col-sm-10">
	            <p><?= h($<%= $singularVar %>-><%= $field %>) ?></p>
	        </div>
	    </div>
	</div>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['boolean']) : %>
<% foreach ($groupedFields['boolean'] as $field) : %>
	<div class="row">
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= Inflector::humanize($field) %>')); ?></label>
	        <div class="col-sm-10">
	            <p><?= $<%= $singularVar %>-><%= $field %> ? __('Yes') : __('No'); ?></p>
	        </div>
	    </div>
	</div>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['text']) : %>
<% foreach ($groupedFields['text'] as $field) : %>
	<div class="row"> 
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('<%= Inflector::humanize($field) %>')); ?></label>
	        <div class="col-sm-10">
	            <?= $this->Text->autoParagraph(h($<%= $singularVar %>-><%= $field %>)); ?>
	        </div>
	    </div>
	</div>
<% endforeach; %>
<% endif; %>
<%
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    %>
    <?php if (!empty($<%= $singularVar %>-><%= $details['property'] %>)) { ?>
        <div class="clearfix"></div>
        <br/>
        <h4 class="mb"><i class="fa fa-angle-right"></i> <?= __('Related <%= $otherPluralHumanName %>') ?></h4>
        <table class="table table-bordered table-striped table-condensed">
            <tr>
<% foreach ($details['fields'] as $field): %>
                <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
<% endforeach; %>
                <th class="actions centered"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($<%= $singularVar %>-><%= $details['property'] %> as $<%= $otherSingularVar %>): ?>
            <tr>
                <%- foreach ($details['fields'] as $field): %>
                <td><?= h($<%= $otherSingularVar %>-><%= $field %>) ?></td>
                <%- endforeach; %>
                <%- $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; %>
                <td class="actions centered">
                    <?= $this->Html->link(__('View'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', <%= $otherPk %>]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => '<%= $details['controller'] %>', 'action' => 'edit', <%= $otherPk %>]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => '<%= $details['controller'] %>', 'action' => 'delete', <%= $otherPk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $otherPk %>)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php } ?>
<% endforeach; %>
</section>
