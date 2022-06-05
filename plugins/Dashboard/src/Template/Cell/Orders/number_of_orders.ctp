<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Nr. of Orders (Total)') ?></span>
                    <h2 class="font-bold"><?= $numberOfOrders->total ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Nr. of Orders (Quarter)') ?></span>
                    <h2 class="font-bold"><?= $numberOfOrders->quarter ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Order Estimate (Quarter)') ?></span>
                    <h2 class="font-bold"><?= $numberOfOrders->quarterEstimate ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Nr. of Unique Buyers (Total)') ?></span>
                    <h2 class="font-bold"><?= $numberOfOrders->uniqueBuyersTotal ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Nr. of Unique Buyers (Quarter)') ?></span>
                    <h2 class="font-bold"><?= $numberOfOrders->uniqueBuyersQuarter ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Nr. of Registered Buyers (Total)') ?></span>
                    <h2 class="font-bold"><?= $numberOfOrders->registeredBuyersTotal ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Nr. of Registered Buyers (Quarter)') ?></span>
                    <h2 class="font-bold"><?= $numberOfOrders->registeredBuyersQuarter ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('GMB (Total)') ?></span>
                    <h2 class="font-bold"><?= $this->Number->currency($numberOfOrders->turnoverTotal, 'EUR') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('GMB (Quarter)') ?></span>
                    <h2 class="font-bold"><?= $this->Number->currency($numberOfOrders->turnoverQuarter, 'EUR') ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
