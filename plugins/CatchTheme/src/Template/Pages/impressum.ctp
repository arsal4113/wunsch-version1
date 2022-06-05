<?php
$this->assign('title', 'Impressum | Catch');
$this->assign('description', 'Impressum - CATCH ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler ► Jetzt entdecken!');
?>

<script>
    pandata.pageType = 'Impressum';
</script>

<div class="col-12">
    <h1>Impressum</h1>
    <br/>
    <div>
        <div>Kundenservice:</div>
        <br>
        <p>Für Kontakt zu unserem CATCH Kundenservice steht Ihnen der CATCH Kundenservice unter
            <a href="mailto:catch@ebay.com">catch@ebay.com</a>
            zur Verfügung oder telefonisch unter +49 (0) 33203 851 400.</p>
        <p>Fragen und Antworten finden Sie in unseren FAQ <a href="/help-desk/help">hier</a>.</p>
    </div>
    <br/>
    <div>
        <div>Angaben gemäß § 5 TMG:</div>
        <p>Neleeco GmbH<br>
            Kurfürstendamm 125A<br>
            10711 Berlin</p>
    </div>
    <div>
        <div>Vertreten durch:</div>
        <p>Geschäftsführer: Silvio von Krüchten</p>
    </div>
    <div>
        <div>Kontakt:</div>
        <p>E-Mail: <a href="mailto:office@neleeco.de">office@neleeco.de</a> (kein Kundenservice)</p>
    </div>
    <div>
        <div>Registereintrag:</div>
        <p>HRB-Nr.: HRB 140345 B<br>
            Umsatzsteuer-ID: DE281766293</p>
    </div>
    <div>
        <div>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:</div>
        <p>Silvio von Krüchten<br>
            Neleeco GmbH<br>
            Kurfürstendamm 125A<br>
            10711 Berlin</p>
    </div>
    <div>
        <div>Rechtliche Hinweise zur Webseite</div>
        <p>Alle Texte, Bilder und weiter hier veröffentlichten Informationen unterliegen dem Urheberrecht des Anbieters,
            soweit nicht Urheberrechte Dritter bestehen. In jedem Fall ist eine Vervielfältigung, Verbreitung oder
            öffentliche Wiedergabe ausschließlich im Falle einer widerruflichen und nicht übertragbaren Zustimmung des
            Anbieters gestattet.<br>
            Für alle mittels Querverweis (Link) verbundenen Webinhalte übernimmt der Anbieter keine Verantwortung, da es
            sich hierbei nicht um eigene Inhalte handelt. Die verlinkten Seiten wurden auf rechtswidrige Inhalte überprüft,
            zum Zeitpunkt der Verlinkung waren solche nicht erkennbar. Verantwortlich für den Inhalt der verlinkten Seiten
            ist deren Betreiber. Der Anbieter hat hierzu keine allgemeine Überwachungs- und Prüfungspflicht. Bei
            Bekanntwerden einer Rechtsverletzung wird der entsprechende Link jedoch umgehend entfernt.</p>
        <br>
    </div>
</div>
<script>
    $(function() {
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    });
</script>
