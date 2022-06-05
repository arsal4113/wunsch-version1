<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4 text-left">
                    <i class="fa fa-shopping-bag fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span><?= __('Turnover (Current Week)') ?></span>
                    <h2 class="font-bold"><?= $this->Number->precision($currentWeekTurnover, 2) ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
