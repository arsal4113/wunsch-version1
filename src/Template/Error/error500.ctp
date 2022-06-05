<?php
/**
 * The original logic of this class has been changed. There is now an if statement
 * which always shows a custom 404 page for the customer when debug mode is off
 */
use Cake\Core\Configure;
use Cake\Error\Debugger;

if (Configure::read('debug')):

    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
    <?php if (!empty($error->params)) : ?>
    <strong>SQL Query Params: </strong>
    <?= Debugger::dump($error->params) ?>
<?php endif; ?>
    <?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>

<?php
if (!Configure::read('debug')):

    $this->layout = 'CatchTheme.layoutfor404';

endif;
?>

<h2><?= __d('cake', 'An Internal Error Has Occurred') ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= h($message) ?>
</p>
