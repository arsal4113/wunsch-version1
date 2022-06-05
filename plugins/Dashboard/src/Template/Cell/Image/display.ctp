<div class="col-lg-<?= $columnWidth; ?>" style="margin: 0px; padding: 0px;">
    <div class="widget style1 gray-bg">
        <div class="row">
            <div class="col-lg-12">
                <?php echo $this->Html->image($imageUrl, ['width' => '100%', 'height' => '200px', 'style' => 'object-fit: cover']) ?>
                <?php if(!empty($imageCaption)): ?>
                    <div class="image-caption"><?= $imageCaption ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>