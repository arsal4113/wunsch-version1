<?php
$this->assign('title', 'Umfrage | Fashion. Sport. Lifestyle. Tech Trends. | Catch by eBay');
$this->assign('description', 'Nehme an unserer Umfrage teil und gewinne mit Glück 500€ - CATCH by eBay ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler');
?>
<div class="col-12 about-us-wrapper">
    <div class="row">
        <div class="col-12">
            <iframe src="https://partner.customervoice360.com/uc/eyesquare/a9c4/" width="100%" height="1000" frameBorder="0"></iframe>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    });
</script>
