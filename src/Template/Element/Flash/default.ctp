<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="alert alert-dismissable <?= h($class) ?>"><?= h($message) ?></div>
