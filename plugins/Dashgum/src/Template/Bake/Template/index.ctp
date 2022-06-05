<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(15);
%>
<div class="row mt">
    <div class="col-lg-9">
        <h3><i class="fa fa-angle-right"></i> <?= __('List of <%= $pluralHumanName %>') ?></h3>
    </div>
    <div class="col-lg-3">
        <div class="btn-group btn-group-justified btn-actions">
            <div class="btn-group">
                <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New <%= $singularHumanName %>'), ['action' => 'add'], ['class' => 'btn btn-sm btn-info', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>

<section id="unseen">
    <?= $this->element('simple_search'); ?>
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
        <% foreach ($fields as $field): %>
        <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
        <% endforeach; %>
        <th class="actions centered"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
        <tr>
<%        foreach ($fields as $field) {
            $isKey = false;
            if (!empty($associations['BelongsTo'])) {
                foreach ($associations['BelongsTo'] as $alias => $details) {
                    if ($field === $details['foreignKey']) {
                        $isKey = true;
%>
            <td>
                <?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?>
            </td>
<%
                        break;
                    }
                }
            }
            if ($isKey !== true) {
                if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
%>
            <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                } else {
%>
            <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                }
            }
        }

        $pk = '$' . $singularVar . '->' . $primaryKey[0];
%>
            <td class="actions centered">
                <?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', <%= $pk %>], ['class' => 'btn btn-xs btn-default', 'escape' => false]) ?>
                <?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', <%= $pk %>], ['class' => 'btn btn-xs btn-warning', 'escape' => false]) ?>
                <?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', <%= $pk %>], ['class' => 'btn btn-xs btn-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?>
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
