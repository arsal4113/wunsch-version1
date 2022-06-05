<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Quizzes') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Quiz'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?= $this->element('simple_search'); ?>

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('url_path') ?></th>
                                <th><?= $this->Paginator->sort('meta_description') ?></th>
                                <th><?= $this->Paginator->sort('robot_tag') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederQuizzes as $feederQuiz): ?>
                                <tr>
                                    <td><?= $this->Number->format($feederQuiz->id) ?></td>
                                    <td><?= h($feederQuiz->name) ?></td>
                                    <td><?= h($feederQuiz->url_path) ?></td>
                                    <td><?= h($feederQuiz->meta_description) ?></td>
                                    <td><?= h($feederQuiz->robot_tag) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederQuiz->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederQuiz->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederQuiz->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederQuiz->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $this->element('paginator'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
