<?php
/** @var \Feeder\Model\Entity\FeederHomepage $feederHomepage */
$this->Html->css('HelpDesk.help-desk' . STATIC_MIN, ['block' => true]);
$this->assign('title', 'Hilfe & Kontakt | Catch dir deine Welt');
$this->assign('description', 'Hilfe & Kontakt | CATCH ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler ► Jetzt entdecken');
?>

<?php $this->start('content-fluid') ?>

<div class="help-page-banner">
    <div class="banner-img" style="<?= (isset($headerImage) && !empty($headerImage)) ? 'background:url(' . $this->Url->image($headerImage) . ') no-repeat center;' :'' ?>">
        <div class="header-text"><p><?= __('Help & Contact') ?></p></div>
    </div>
</div>
<div class="help-page-content">
    <?= $this->cell('Feeder.MegaNavi') ?>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-11 container row-content-wrapper">
                <div class="container">
                    <div class="faq-block">
                        <?php /** @var \HelpDesk\Model\Entity\HelpDeskFaq $helpDeskFaq */ ?>
                        <?php /** @var \HelpDesk\Model\Entity\HelpDeskCategory $helpDeskCategory */ ?>
                        <?php foreach ($helpDeskCategories as $helpDeskCategory) : ?>
                            <section>
                                <div class="help-category"><?= $helpDeskCategory -> category ?></div>
                                <?php foreach ($helpDeskFaqs as $helpDeskFaq) : ?>
                                    <?php if (($helpDeskCategory -> id) == ($helpDeskFaq -> help_desk_category_id)): ?>
                                        <div class="item-title">
                                            <p><?= $helpDeskFaq -> question ?></p>
                                            <span></span>
                                        </div>
                                        <div class="item-content">
                                            <p><?= $helpDeskFaq -> answer ?></p>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </section>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-12 extra-info-block">
                <div class="row">
                    <div class="col-lg-11 col-12 info-content-wrapper">
                        <div class="ebay-block">
                            <div class="row-header">
                                <p class="ebay"><?= __('Frag den') ?> <?= $this->Html->image($catchLogo, ['alt' => __('CATCH'), 'id' => 'logo', 'fullBase' => true]) ?> <?= __('Kundenservice') ?></p>
                            </div>
                            <div class="content-block">
                                <p><?= __('Du hast Fragen zu deiner Bestellung oder Retoure? Dann wende dich bitte an den eBay Kundenservice. Zwischen 08:00 – 22:00 Uhr sind wir telefonisch für Dich unter 033203 – 851400 erreichbar.') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>

<script>
    $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-colour.svg'); ?>', type: 'white'});
    $(document).ready(function () {
        $('.item-title').unbind().on({
            click: function (e) {
                $( this ).toggleClass('active');
                $( this ).next().slideToggle(300);
            }
        });
    });
</script>
