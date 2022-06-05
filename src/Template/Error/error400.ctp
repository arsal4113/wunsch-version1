<?php
/**
 * The original logic of this class has been changed. There is now an if statement
 * which always shows a custom 404 page for the customer when debug mode is off
 */
use Cake\Core\Configure;

if (Configure::read('debug')):

    //activate this line instead of $this->layout = 'customError404'; to get the default error page
    $this->layout = 'dev_error';
    #$this->layout = 'MightyGuru.layoutfor404';

    $this->assign('title', $message);
    $this->assign('template-name', 'error400.ctp');

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

    <?= $this->element('auto_table_warning') ?>

    <?php
        if (extension_loaded('xdebug')):
            xdebug_print_function_stack();
    endif;
    $this->end();
endif;?>

<?php
if (!Configure::read('debug')):
    //custom error page layout
    $this->layout = 'CatchTheme.layoutfor404';

endif;?>

<h2><?= h($message) ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= sprintf(
        __d('cake', 'The requested address %s was not found on this server.'),
        "<strong>'{$url}'</strong>"
    ) ?>
</p>
