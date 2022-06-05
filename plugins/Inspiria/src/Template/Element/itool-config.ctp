<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cogs fa-spin"></i>
        </div>
        <div class="skin-setttings">
            <div class="title"><?= __('Configuration') ?></div>
            <div class="setings-item">
                <?= $this->cell('SuperUserSellerSwitch'); ?>
            </div>
            <div class="setings-item">
                <span><?= __('Collapse menu') ?></span>
                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                        <label class="onoffswitch-label" for="collapsemenu">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                <span><?= __('User dashboard') ?></span>
                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="userdashboard" class="onoffswitch-checkbox" id="userdashboard">
                        <label class="onoffswitch-label" for="userdashboard">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>