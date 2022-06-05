<?php
$background = '#fff';
if (!empty($config->imageUrl)) {
    $imgUrl = $config->imageUrl;
    $background = "url('" . $this->Url->image($config->imageUrl) . "') top/cover no-repeat";
} else if (!empty($config->backgroundColor)) {
    $background = $config->backgroundColor;
}
?>
<div class="row design-3" style="background: <?= $background ?>">
    <div class="expandable-section-wrapper">
        <?php foreach($config->children as $child): ?>
        <div class="expandable-section">
            <div class="section-header">
                <p><?= $child->childTitle ?></p>
                <div class="arrow-wrapper">
                    <div class="arrow"></div>
                </div>
            </div>
            <div class="section-content">
                <p><?= $child->childText ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
