<?php

/**
 * @var \Cake\View\Helper\UrlHelper $this->Url
 */
?>
<div class="row">
    <div class="col-12">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark navigation">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <?php foreach ($feederCategories as $key => $feederCategory): ?>
                                    <?php /** @var \Feeder\Model\Entity\FeederCategory $feederCategory */ ?>
                                    <li class="nav-item <?= $feederCategory->id == $id || ($id === null && $key === 0) ? 'active' : '' ?>">
                                        <a class="nav-link" href="<?= $this->Url->build([
                                            'controller' => 'Browse',
                                            'action' => 'view',
                                            'plugin' => 'Feeder',
                                            $feederCategory->id
                                        ]) ?>"><? $this->Html->image($feederCategory->image) ?><? __($feederCategory->name) ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
