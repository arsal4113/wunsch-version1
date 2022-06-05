<div class="col-lg-<?= $columnWidth; ?>">
    <div class="widget style1 gray-bg">
        <div class="row">
            <div class="col-xs-12 text-right">
                <h2 style="font-style: italic;">
                    <?= $quote; ?>
                    <?php if(!empty($quoteAuthor)): ?>
                    <small>&ndash; <?= $quoteAuthor; ?></small>
                    <?php endif; ?>
                </h2>
            </div>
        </div>
    </div>
</div>