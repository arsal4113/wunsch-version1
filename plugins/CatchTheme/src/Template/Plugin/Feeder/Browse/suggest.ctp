<?php if (!empty($suggestions)) : ?>
    <ul id="item-list">
        <?php foreach ($suggestions as $suggestion) : ?>
            <li><a href="<?= $searchUrl ?? '/' ?>?search=<?= urlencode($suggestion) ?>"><?= $this->Text->highlight(
                        $suggestion,
                        $search,
                        ['format' => '<span>\1</span>']
                    ); ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
