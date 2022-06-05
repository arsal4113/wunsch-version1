<?php
$this->Html->css('Feeder.raffle-page' . STATIC_MIN, ['block' => true, 'media' => 'all']);
$this->assign('title', __('Catch Gewinnspiel Ostern'));
$this->assign('description', __('Catch Gewinnspiel Ostern'));
?>

<?php $this->start('content-fluid'); ?>
<div class="raffle-banner easter">
    <div class="banner-img easter">
        <div class="header-text-container">
            <div class="text-wrapper">
                <h1 class="easter-header"><?= __('Das Oster Gewinnspiel') ?></h1>
                <p><?= __('Jetzt geht es auf die Ostereier Suche! Spiel mit und gewinne 1 Überraschungs-Paket mit coolen Produkten im Wert von insgesamt 50€.') ?></p>
            </div>
            <div class="redesign-button">
                <a href="https://www.instagram.com/p/BwUVUf9n14G/" target="_blank"><?= __('Zu unserem Gewinnspiel') ?></a>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="first-block">
        <div class="container">
            <h1><?= __('So einfach geht’s!') ?></h1>
            <p class="bold"><?= __('Teilnahmebedingungen für das „Oster“ Gewinnspiel') ?></p>
        </div>
    </div>
    <div class="text-content-wrapper">
        <div class="container">
            <p class="bold"><?= __('Allgemeines') ?></p>
            <p class="content bold"><?= __('Das Gewinnspiel „Oster“ unterliegt den vorliegenden Teilnahmebedingungen. Mit der Teilnahme akzeptiert der Teilnehmer diese Bedingungen und erkennt an, dass die Ergebnisse des Gewinnspiels in jeder Hinsicht endgültig sind. Sämtliche Entscheidungen im Zusammenhang mit diesem Gewinnspiel, darunter auch die Gewinnerermittlung, werden von eBay getroffen und sind in jeder Hinsicht endgültig und verbindlich. Teilnehmer, die sich nicht an diese Teilnahmebedingungen halten, werden nicht akzeptiert und sind von der Teilnahme am Gewinnspiel ausgeschlossen.') ?></p>
            <p><?= __('Diese Aktion steht in keiner Verbindung zu Instagram und wird in keiner Weise von Instagram gesponsert, unterstützt oder organisiert. ') ?></p>
            <p class="title bold">1. <?= __('Veranstalter') ?></p>
            <p><?= __('Veranstalter des Gewinnspiels ist die eBay Marketplaces GmbH Helvetiastraße 15-17, 3005 Bern, Schweiz (nachfolgend „eBay“ oder „Wir“).') ?></p>
            <p class="title bold">2. <?= __('Gewinnspielzeitraum') ?></p>
            <p><?= __('Das Gewinnspiel beginnt am 17.04.2019 um 10:00 Uhr MEZ und endet am 18.04.2019 um 23:59 Uhr MEZ (nachfolgend „Gewinnspielzeitraum“).') ?></p>
            <p class="title bold">3. <?= __('Teilnahmeberechtigung und -voraussetzung') ?></p>
            <p><?= __('Teilnahmeberechtigt sind natürliche Personen mit ständigem Wohnsitz in der Bundesrepublik Deutschland, die bei der Teilnahme mindestens 18 Jahre alt sind und über ein eBay Nutzerkonto verfügen, d.h. bei eBay angemeldet sind.  ') ?></p>
            <p><?= __('Die Teilnahme über Dritte, wie z.B. Gewinnspielagenturen, ist nicht gestattet.') ?></p>
            <p><?= __('Von der Teilnahme ausgeschlossen sind Mitarbeiter von eBay und seinen Tochtergesellschaften und Partnerunternehmen, deren Vertreter, deren Angehörige sowie alle anderen Personen, die mit der Durchführung des Gewinnspiels betraut sind.') ?></p>
            <p><?= __('Die Teilnahme am Gewinnspiel ist erfordert eine aktive Beteiligung des Teilnehmers. Diese ist unter Punkt 4 dieser Teilnahmebedingungen genau definiert und kann nur auf www.ebay.de und der entsprechenden Version der eBay App für Mobilgeräte stattfinden.') ?></p>
            <p><?= __('Die Teilnahme am Gewinnspiel ist kostenlos.') ?></p>
            <p class="title bold">4. <?= __('Ablauf des Gewinnspiels') ?></p>
            <p><?= __('Die Teilnahme am Gewinnspiel ist über ein internetfähiges Mobil- oder Desktopgerät möglich und setzt einen eigenen Instagram Account voraus.') ?></p>
            <p><?= __('Um sich für die Verlosung zu qualifizieren, muss der Teilnehmer innerhalb des Gewinnspielzeitraums die folgende Aktion vollständig durchführen:') ?></p>
            <ul>
                <li><?= __('Um teilzunehmen, muss der Teilnehmer unter eines der vier „erscheinenden“ Instagram Ostereier Posts kommentieren. ') ?></li>
                <li><?= __('Jeder Teilnehmer kann mehrmals teilnehmen. D.h. je mehr qualifizierende Gewinnspiel-Handlungen er durchführt, desto höher 	sind seine Gewinnchancen (d.h. wenn der Teilnehmer während des Gewinnspiel-Zeitraums z.B. unter allen 4 Posts kommentiert,  	nimmt er 4 Mal teil). Jedoch kann ein Teilnehmer nur einmal gewinnen.') ?></li>
            </ul>
            <p><?= __('Unter allen Teilnehmern, die sich für die Verlosung qualifiziert haben, wird der Gewinn ausgelost.') ?></p>
            <p><?= __('Wir behalten uns vor, Teilnehmer auszuschließen, die sich nicht an diese Regeln halten.') ?></p>
            <p class="title bold">5. <?= __('Ermittlung der Gewinner und Gewinn') ?></p>
            <p><?= __('Es gibt 1 Hauptgewinn, welcher per Zufall ausgelost wird.') ?></p>
            <p><?= __('Der Gewinner/ die Gewinnerin wird per Zufall unter allen Teilnehmern, die sich für die Verlosung qualifiziert haben, ermittelt.') ?></p>
            <p><?= __('Der Gewinn ist ein Catch Paket mit einem Warenwert von 50€ .') ?></p>
            <p><?= __('Die Gewinne sind nicht übertragbar und werden nicht ausgezahlt.') ?></p>
            <p class="title bold">6. <?= __('Gewinnbenachrichtigung und Mitwirkungspflicht des Gewinners') ?></p>
            <p><?= __('Nach der Verlosung werden die Gewinner am 23.04.2019 per Instagram Direktnachricht benachrichtigt.') ?></p>
            <p><?= __('Die Gewinnbenachrichtigung wird an den Account versendet, die am Gewinnspiel mit der aufgeforderten Mechanik teilgenommen hat. Wir sind nicht verpflichtet, im Falle einer unzustellbaren Benachrichtigung weitere Nachforschungen anzustellen.') ?></p>
            <p ><?= __('Die Gewinne werden innerhalb von 30 Tagen nach Ende des Gewinnspielzeitraums per Post versendet.') ?></p>
            <p><?= __('Dies ist jedoch nur möglich, wenn uns der Teilnehmer seine vollständige Postanschrift per Instagram Direktnachricht in Antwort auf die Gewinnbenachrichtigung hin mitteilt. Meldet sich der Gewinner nicht innerhalb von 7 Tagen nach Absenden der Gewinnbenachrichtigung bei uns, so verfällt der Anspruch auf den Gewinn. Wir sind nicht verpflichtet, weitere Nachforschungen anzustellen. eBay behält sich weiterhin das Recht vor, die Teilnahmeberechtigung und Identität der Gewinner zu überprüfen. ') ?></p>
            <p><?= __('Wird ein Gewinner aus den in diesen Teilnahmebedingungen festgelegten Gründen vom Gewinnspiel ausgeschlossen, so behält sich eBay das Recht vor, einen anderen Gewinner zu ermitteln.') ?></p>
            <p class="title bold">7. <?= __('Teilnahmeausschluss') ?></p>
            <p><?= __('Jeder Versuch das Gewinnspiel zu manipulieren, führt automatisch zum Ausschluss von der Teilnahme.') ?></p>
            <p><?= __('eBay behält sich das Recht vor, Teilnehmer, die sich nicht an diese Teilnahmebedingungen oder an die Nutzungsbedingungen von eBay halten, von der Teilnahme auszuschließen.') ?></p>
            <p><?= __('Sollte das Nutzerkonto des Teilnehmers – gleich aus welchen Gründen – während des Gewinnspielzeitraums oder kurz danach gesperrt, aufgehoben oder eingeschränkt sein, kann der Teilnehmer ggf. von der Teilnahme am Gewinnspiel ausgeschlossen werden.') ?></p>
            <p class="title bold">8. <?= __('Datenschutz') ?></p>
            <p><?= __('Damit die Durchführung dieses Gewinnspiels möglich ist, benötigen wir vom Teilnehmer personenbezogene Daten, wie z.B. Namen und Adressen. Personenbezogene Daten, die uns im Rahmen der Teilnahme an dem Gewinnspiel übermittelt werden, werden von uns ausschließlich zur Durchführung und Abwicklung des Gewinnspiels gespeichert, verarbeitet und genutzt. Eine Weitergabe der personenbezogenen Daten an Dritte findet nur dann statt, wenn dies gesetzlich erlaubt, erforderlich oder vorgeschrieben ist oder zum Zwecke der Weitergabe an Dritte, die aus irgendeinem Grunde direkt mit dem Gewinnspiel in Verbindung stehen. Darüber hinaus versenden wir keine unerwünschten E-Mails zu kommerziellen Zwecken, wenn dies nicht zuvor vom Empfänger beantragt wurde. ') ?></p>
            <p><?= __('Die Daten der Teilnehmer werden nach Abschluss des Gewinnspiels gelöscht. Empfänger der im Rahmen des Gewinnspiels bereitgestellten personenbezogenen Daten ist eBay. ') ?></p>
            <p class="title bold">9. <?= __('Schlussbestimmungen') ?></p>
            <p><?= __('Wir haften nicht für die Verfügbarkeit des Gewinnspieles, insbesondere übernehmen wir keine Haftung für technische Störungen oder Ausfälle im Zusammenhang mit Kommunikationsnetzwerken oder Online-Systemen. Wir übernehmen keine Haftung für abgesendete, aber nicht zugegangene Nachrichten im Sinne dieser Teilnahmebedingungen.') ?></p>
            <p><?= __('Wir haften nicht für die Verfügbarkeit des Gewinnspieles, insbesondere übernehmen wir keine Haftung für technische Störungen oder Ausfälle im Zusammenhang mit Kommunikationsnetzwerken oder Online-Systemen. Wir übernehmen keine Haftung für abgesendete, aber nicht zugegangene Nachrichten im Sinne dieser Teilnahmebedingungen.') ?></p>
            <p><?= __('Diese Haftungsbeschränkungen gelten nicht für Schäden aus der Verletzung des Lebens, des Körpers oder der Gesundheit, die auf einer vorsätzlichen oder fahrlässigen Pflichtverletzung seitens eBay beruhen. Ebenso bleibt die Haftung für sonstige Schäden, die auf einer vorsätzlichen oder grob fahrlässigen Pflichtverletzung seitens eBay beruhen, unberührt.') ?></p>
            <p><?= __('Diese Teilnahmebedingungen unterliegen deutschem Recht. Soweit zulässig: Alle Parteien erklären sich damit einverstanden, dass Berlin Gerichtsstand in Bezug auf jegliche Forderungen oder Streitfälle ist, die sich aus diesen Teilnahmebedingungen ergeben.') ?></p>
        </div>
    </div>
</div>
<?php $this->end(); ?>
<script>
    $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
</script>
