<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Average Orders Per Day (Quarter)') ?></span>
                    <h2 class="font-bold"><?= $this->Number->precision($averageOrdersPerDayInQuarter, 2) ?></h2>
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
                    <span><?= __('Average GMB Per Day (Quarter)') ?></span>
                    <h2 class="font-bold"><?= $this->Number->currency($averageRevenuePerDayInQuarter, 'EUR') ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
