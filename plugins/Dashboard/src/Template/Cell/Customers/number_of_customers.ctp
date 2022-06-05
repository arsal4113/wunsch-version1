<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span><?= __('Nr. of Registered Customers (Total)') ?></span>
                    <h2 class="font-bold"><?= $numberOfCustomers->total ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span><?= __('Nr. of Registered Customers (Quarter)') ?></span>
                    <h2 class="font-bold"><?= $numberOfCustomers->quarter ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span><?= __('Nr. of Customers Registered With Catch') ?></span>
                    <h2 class="font-bold">
                        <?= $numberOfCustomers->catch ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span><?= __('Nr. of Customers Registered With Ebay') ?></span>
                    <h2 class="font-bold">
                        <?= $numberOfCustomers->ebay ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span><?= __('Nr. of customers to register with: Facebook') ?></span>
                    <h2 class="font-bold">
                        <?= $numberOfCustomers->fb ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span><?= __('Nr. of customers to register with: Google') ?></span>
                    <h2 class="font-bold">
                        <?= $numberOfCustomers->google ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span><?= __('Nr. of customers to register with: Twitter') ?></span>
                    <h2 class="font-bold">
                        <?= $numberOfCustomers->twitter ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span><?= __('Nr. of customers to register with: Instagram') ?></span>
                    <h2 class="font-bold">
                        <?= $numberOfCustomers->instagram ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>

