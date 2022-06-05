<p><?= __('Feed import results: {0}', $feedImportJob->file_name) ?></p>
<hr/>
<p>
    <?= '<b>' . __('Total: ') . '</b>' . $feedImportJob->info['total'] ?> |
    <?= '<b>' . __('Success: ') . '</b>' . $feedImportJob->info['success'] ?> |
    <?= '<b>' . __('Error: ') . '</b>' . $feedImportJob->info['error'] ?>
</p>
<?php if(!empty($feedImportJob->info['error_messages'])): ?>
    <hr/>
    <?= '<b>' . __('Error messages') . '</b>' ?><br/><br/>
    <ol>
        <?php foreach($feedImportJob->info['error_messages'] as $errorMessage): ?>
            <?php if(is_array($errorMessage)): ?>
                <?php foreach($errorMessage['message'] as $messageCode => $messages): ?>
                    <?php foreach($messages as $singleMessage): ?>
                        <li><?= __('Row: {0}', [$errorMessage['entity']]) . ', ' . __('Col: {0}', [$messageCode]) . ', ' . __('Error message: {0}', [$singleMessage])  ?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <li><?= $errorMessage  ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>