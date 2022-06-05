<div class="success-page container-fluid">
    <div class="widget">
        <div class="row">
            <div class="col widget-title"><h2><?= __('Congratulations!'); ?></h2></div>
        </div>
        <div class="widget-body">
            <div class="row">
                <div class="col">
                    <h3><?= __('Your order was placed'); ?></h3>
                </div>
            </div>
            <div class="row delivery-date">
                <div class="col">
                    <span><?= __('Estimated delivery: '); ?></span><span class="estimated"><?= $this->EbayCheckout->minMaxDate($minDate, $maxDate); ?></span><br/>
                    <span><?= __('We’ll send you an email confirmation soon.'); ?></span>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col">
                    <iframe src="https://www.knotch.it/extern/survey/<?= $knotchSurveyId ?>" frameborder="0" style="width:100%;height:260px;display:block;margin:auto"></iframe>
                </div>
            </div>
        </div>
        <div class="widget-bottom">
            <div class="row">
                <div class="col">
                    <?= __('eBay Money Back Guarantee'); ?> <a href="https://rover.ebay.com/rover/1/711-53200-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338696426&customid=&mpre=https%3A%2F%2Fpages.ebay.com%2Febay-money-back-guarantee%2F" target="_blank"><?= __('See details'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<img src="<?= $ebayTrackingPixelSrc ?>">

<script type="text/javascript">
    $('body').addClass('success-page-body');
</script>
