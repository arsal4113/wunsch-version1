<?php


namespace EbayCheckout\Test\GlobalTraits;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use App\Model\Entity\CoreUser;


trait CartItem
{
    public function getItem()
    {
        $product = [
            'type' => 'CONFIGURABLE',
            'parent_id' => '324086594399',
            'title' => 'Cat Eye Square Ladies Sunglasses Retro Fashion Plastic Frame Black Brown',
            'description' => '<meta name="viewport" content="width=device-width, initial-scale=1.0"><div style="background-color: white !important; border:1px solid #ccc !important; width: 90% !important; padding: 6px !important; margin: auto !important; text-align: left !important; font-size:14px !important; line-height:24px !important;">Wenn Sie von dem US Marktplatz bestellen, können für die Pakete Steuern und Zollgebühren anfallen, die der Käufer später tragen muss.<h2 style="font-size:18px !important;">Cat Eye Quadratisch Damen Sonnenbrille Retro Mode Plastik Rahmen Schwarz Braune</h2><div>Das Datenblatt dieses Produkts wurde ursprünglich auf Englisch verfasst. Unten finden Sie eine automatische Übersetzung ins Deutsche. Sollten Sie irgendwelche Fragen haben, kontaktieren Sie uns.</div><br /><br /></div><html><head></head><body><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><meta content="width=device-width, initial-scale=1.0" name="viewport"/><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><div style="text-align: center;"><font face="Arial" size="5">Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400</font></div><div style="text-align: center;"><font face="Arial" size="5"><br/></font></div><div style="text-align: center;"><font face="Arial" size="5"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4">Sonnenbrillenmaße:</font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">1 Sonnenbrillenbreite ............ 144 mm (5,7 ")</font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">2 Brückenbreite .................... 16 mm (0,6 ")</font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">3 Sonnenbrillen Höhe ........... 56 mm (2,2 ")</font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.  </font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4">Zahlung</font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel.</font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse. Die Bestellung wird innerhalb von 24 Stunden von Montag bis Freitag nach Zahlungseingang versandt. Die geschätzte Zeit beträgt 2-5 Werktage in den USA und 10-15 Werktage für internationale Ziele. Diese Gebühren gehen zu Lasten des Käufers. </font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">Kundenzufriedenheit ist für uns von höchster Wichtigkeit. Wenn der Artikel nicht zu Ihnen passt, senden Sie ihn einfach im Originalzustand an uns zurück, um eine vollständige Rückerstattung oder einen Umtausch zu erhalten. Rücksendungen werden innerhalb von 30 Tagen nach dem Kauf akzeptiert. Wenn Sie Fragen haben, zögern Sie nicht, uns zu kontaktieren.</font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#333333" size="2">-top exklusiv</font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font><div style="display: none"><div typeof="Product" vocab="https://schema.org/"><span property="description">Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400 Sonnenbrillenmaße: 1 Sonnenbrillenbreite ............ 144 mm (5,7 ") 2 Brückenbreite .................... 16 mm (0,6 ") 3 Sonnenbrillen Höhe ........... 56 mm (2,2 ") Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.   Zahlung Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel. Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse. Die Bestellung wird innerhalb von 24 Stunde</span></div></div></body></html><table>
  <tbody>
    <tr>
      <td>Magnification Strength</td>
      <td>None</td>
    </tr>
    <tr>
      <td>Lens Material</td>
      <td>Polycarbonate</td>
    </tr>
    <tr>
      <td>Modified Item</td>
      <td>No</td>
    </tr>
    <tr>
      <td>Frame Width</td>
      <td>5.7"</td>
    </tr>
    <tr>
      <td>Pattern</td>
      <td>Solid</td>
    </tr>
    <tr>
      <td>Style</td>
      <td>Cat Eye</td>
    </tr>
    <tr>
      <td>UV Protection</td>
      <td>UV400</td>
    </tr>
    <tr>
      <td>Theme</td>
      <td>Cat</td>
    </tr>
    <tr>
      <td>Theme</td>
      <td>Designer</td>
    </tr>
    <tr>
      <td>Theme</td>
      <td>Retro</td>
    </tr>
    <tr>
      <td>Department</td>
      <td>Women</td>
    </tr>
    <tr>
      <td>Frame Color</td>
      <td>Multi-Color</td>
    </tr>
    <tr>
      <td>Type</td>
      <td>Sunglasses</td>
    </tr>
    <tr>
      <td>Brand</td>
      <td>Pacific Shades</td>
    </tr>
    <tr>
      <td>Frame Material</td>
      <td>Plastic</td>
    </tr>
    <tr>
      <td>Vintage</td>
      <td>No</td>
    </tr>
    <tr>
      <td>Lens Height</td>
      <td>1.7"</td>
    </tr>
    <tr>
      <td>Gender</td>
      <td>Women</td>
    </tr>
    <tr>
      <td>Bridge Width</td>
      <td>0.6"</td>
    </tr>
    <tr>
      <td>Lens Color</td>
      <td>Multi-Color</td>
    </tr>
    <tr>
      <td>Occasion</td>
      <td>Party/Cocktail</td>
    </tr>
    <tr>
      <td>Model</td>
      <td>Square</td>
    </tr>
    <tr>
      <td>Features</td>
      <td>Full Frame</td>
    </tr>
    <tr>
      <td>Lens Technology</td>
      <td>Polycarbonate</td>
    </tr>
    <tr>
      <td>MPN</td>
      <td>S71584163</td>
    </tr>
  </tbody>
</table>',
            'item_web_url' => 'https://www.ebay.com/itm/Cat-Eye-Square-Ladies-Sunglasses-Retro-Fashion-Plastic-Frame-Black-Brown-/324086594399',
            'items' => [
                0 => [
                    'itemId' => 'v1|324086594399|513135076726',
                    'itemEndDate' => '2020-12-30',
                    'estimatedAvailabilities' => [
                        0 => ['estimatedAvailabilityStatus' => 'IN_STOCK']
                    ],
                    'price' => [
                        'amount' => '13.03',
                        'currency' => 'USD',
                        'display_price' => 'US 13,03 $',
                    ],
                    'marketing_price' => [
                        'discount_percentage' => NULL,
                        'original_price' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                        'discount_amount' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                    ],
                    'unit_pricing_measure' => '',
                    'unit_price' => [
                        'value' => '',
                        'currency' => '',
                    ],
                    'energy_efficiency_class' => '',
                    'item_web_url' => 'https://www.ebay.com/itm/Cat-Eye-Square-Ladies-Sunglasses-Retro-Fashion-Plastic-Frame-Black-Brown-/324086594399?var=513135076726',
                    'item_url' => '',
                    'short_description' => 'Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400 Sonnenbrillenmaße: 1 Sonnenbrillenbreite ............ 144 mm (5,7 ") 2 Brückenbreite .................... 16 mm (0,6 ") 3 Sonnenbrillen Höhe ........... 56 mm (2,2 ") Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.   Zahlung Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel. Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse.',
                    'subtitle' => '',
                    'location' => [
                        'city' => 'Los Angeles',
                        'country' => 'US',
                        'postalCode' => '',
                        'stateOrProvince' => 'California',
                    ],
                    'quantity' => 10,
                    'quantity_type' => 'MORE_THAN',
                    'max_buy_quantity' => '',
                    'sold_quantity' => 0,
                    'availability_status' => 'IN_STOCK',
                    'item_end_date' => NULL,
                    'return_terms' => [
                        'extended_holiday_returns_offered' => '',
                        'refund_method' => '',
                        'restocking_fee_percentage' => '',
                        'return_shipping_cost_payer' => 'SELLER',
                        'return_accepted' => true,
                        'return_instructions' => 'Widerrufsbelehrung gem&auml;&szlig; Richtline 2011/83/EU &uuml;ber die Rechte der Verbraucher vom 25. Oktober 2011
 Widerrufsrecht
 Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gr&uuml;nden diesen Vertrag zu widerrufen.
 Die Widerrufsfrist betr&auml;gt vierzehn Tagen ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Bef&ouml;rderer ist, die Waren in Besitz genommen haben bzw. hat.
 Um Ihr Widerrufsrecht auszu&uuml;ben, m&uuml;ssen Sie uns mittels einer eindeutigen Erkl&auml;rung (z.B. ein mit der Post versandter Brief, Telefax oder E-Mail) &uuml;ber Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie k&ouml;nnen daf&uuml;r das beigef&uuml;gte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist.
 Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung &uuml;ber die Aus&uuml;bung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
 Folgen des Widerrufs
 Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschlie&szlig;lich der Lieferkosten (mit Ausnahme der zus&auml;tzlichen Kosten, die sich daraus ergeben, dass Sie eine andere Art der Lieferung als die von uns angebotene, g&uuml;nstigste Standardlieferung gew&auml;hlt haben), unverz&uuml;glich und sp&auml;testens binnen vierzehn Tagen ab dem Tag zur&uuml;ckzuzahlen, an dem die Mitteilung &uuml;ber Ihren Widerruf dieses Vertrags bei uns eingegangen ist. F&uuml;r diese R&uuml;ckzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der urspr&uuml;nglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdr&uuml;cklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser R&uuml;ckzahlung Entgelte berechnet. Wir k&ouml;nnen die R&uuml;ckzahlung verweigern, bis wir die Waren wieder zur&uuml;ckerhalten haben oder bis Sie den Nachweis erbracht haben, dass Sie die Waren zur&uuml;ckgesandt haben, je nachdem, welches der fr&uuml;here Zeitpunkt ist.
 Sie haben die Waren unverz&uuml;glich und in jedem Fall sp&auml;testens binnen vierzehn Tagen ab dem Tag, an dem Sie uns &uuml;ber den Widerruf dieses Vertrags unterrichten, an uns zur&uuml;ckzusenden oder zu &uuml;bergeben. Die Frist ist gewahrt, wenn Sie die Waren vor Ablauf der Frist von vierzehn Tagen absenden.
 Sie tragen die unmittelbaren Kosten der R&uuml;cksendung der Waren.
 Sie m&uuml;ssen f&uuml;r einen etwaigen Wertverlust der Waren nur aufkommen, wenn dieser Wertverlust auf einen zur Pr&uuml;fung der Beschaffenheit, Eigenschaften und Funktionsweise der Waren nicht notwendigen Umgang mit ihnen zur&uuml;ckzuf&uuml;hren ist.
 Muster-Widerrufsformular
 (Wenn Sie den Vertrag widerrufen wollen, dann f&uuml;llen Sie bitte dieses Formular aus und senden Sie es zur&uuml;ck.)
 - Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag &uuml;ber den Kauf der folgenden Waren (*)/die Erbringung der folgenden Dienstleistung (*)
 - Bestellt am (*)/erhalten am (*)
 - Name des/der Verbraucher(s)
 - Anschrift des/der Verbraucher(s)
 - Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)
 - Datum
 (*) Unzutreffendes streichen.',
                        'return_method' => '',
                        'return_period' => [
                            'unit' => 'CALENDAR_DAY',
                            'value' => 30,
                        ],
                    ],
                    'seller' => [
                        'feedback_percentage' => '99.5',
                        'feedback_score' => 10667,
                        'username' => 'top-exclusive',
                        'account_type' => '',
                        'legal_info' => [
                            'email' => '',
                            'fax' => '',
                            'imprint' => '',
                            'legal_contact_first_name' => '',
                            'legal_contact_last_name' => '',
                            'name' => '',
                            'phone' => '',
                            'registration_number' => '',
                            'legal_address' => [
                                'address_line_1' => '',
                                'address_line_2' => '',
                                'city' => '',
                                'country' => '',
                                'country_name' => '',
                                'county' => '',
                                'postal_code' => '',
                                'state_or_province' => '',
                            ],
                            'terms_of_service' => '',
                            'vat_details' => [
                                'issuing_country' => '',
                                'vat_id' => '',
                            ],
                        ],
                    ],
                    'attributes' => [
                        0 => [
                            'name' => 'Farbe',
                            'value' => 'Schwarz',
                        ],
                        1 => [
                            'name' => 'Glasfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        2 => [
                            'name' => 'Stil',
                            'value' => 'Cat Eye',
                        ],
                        3 => [
                            'name' => 'Gläserhöhe',
                            'value' => '4.3cm',
                        ],
                        4 => [
                            'name' => 'Anlass',
                            'value' => 'party/cocktail',
                        ],
                        5 => [
                            'name' => 'Gläserfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        6 => [
                            'name' => 'Thema',
                            'value' => 'Designer, Retro, Cat',
                        ],
                        7 => [
                            'name' => 'Gestellmaterial',
                            'value' => 'Plastik',
                        ],
                        8 => [
                            'name' => 'Modell',
                            'value' => 'Quadrat',
                        ],
                        9 => [
                            'name' => 'Herstellernummer',
                            'value' => 'S71584163',
                        ],
                        10 => [
                            'name' => 'Rahmenbreite',
                            'value' => '14.5cm',
                        ],
                        11 => [
                            'name' => 'Gestellfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        12 => [
                            'name' => 'Rahmenfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        13 => [
                            'name' => 'Stegbreite',
                            'value' => '1.5cm',
                        ],
                        14 => [
                            'name' => 'Rahmenmaterial',
                            'value' => 'Plastik',
                        ],
                        15 => [
                            'name' => 'Produktart',
                            'value' => 'Sonnenbrille',
                        ],
                        16 => [
                            'name' => 'Vergrößerung Stärke',
                            'value' => 'Keiner',
                        ],
                        17 => [
                            'name' => 'Abteilung',
                            'value' => 'Damen',
                        ],
                        18 => [
                            'name' => 'Geschlecht',
                            'value' => 'Damen',
                        ],
                        19 => [
                            'name' => 'Gläsermaterial',
                            'value' => 'Polycarbonat',
                        ],
                        20 => [
                            'name' => 'Besonderheiten',
                            'value' => 'Komplettes Gestell',
                        ],
                        21 => [
                            'name' => 'Vintage',
                            'value' => 'Nein',
                        ],
                        22 => [
                            'name' => 'Marke',
                            'value' => 'Pacific Shades',
                        ],
                        23 => [
                            'name' => 'Modifizierte Artikel',
                            'value' => 'Nein',
                        ],
                        24 => [
                            'name' => 'UV Schutz',
                            'value' => 'UV400',
                        ],
                        25 => [
                            'name' => 'UV-Schutz',
                            'value' => 'UV400',
                        ],
                        26 => [
                            'name' => 'Muster',
                            'value' => 'Solid',
                        ],
                        27 => [
                            'name' => 'Charakter',
                            'value' => 'Claire',
                        ],
                        28 => [
                            'name' => 'Gläsertechnologie',
                            'value' => 'Polycarbonat',
                        ],
                    ],
                    'shipping_options' => [
                    ],
                    'ship_to_locations' => [
                        'region_excluded' => [
                            0 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'Africa',
                            ],
                            1 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'South America',
                            ],
                            2 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Australia',
                            ],
                            3 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Marshall Islands',
                            ],
                            4 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Micronesia',
                            ],
                            5 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nauru',
                            ],
                            6 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Niue',
                            ],
                            7 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Palau',
                            ],
                            8 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Solomon Islands',
                            ],
                            9 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tonga',
                            ],
                            10 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tuvalu',
                            ],
                            11 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vanuatu',
                            ],
                            12 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Wallis and Futuna',
                            ],
                            13 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Brunei Darussalam',
                            ],
                            14 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cambodia',
                            ],
                            15 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Philippines',
                            ],
                            16 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Taiwan',
                            ],
                            17 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Thailand',
                            ],
                            18 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vietnam',
                            ],
                            19 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mexico',
                            ],
                            20 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Pierre and Miquelon',
                            ],
                            21 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United States',
                            ],
                            22 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Russian Federation',
                            ],
                            23 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Albania',
                            ],
                            24 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Andorra',
                            ],
                            25 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bosnia and Herzegovina',
                            ],
                            26 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Estonia',
                            ],
                            27 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'France',
                            ],
                            28 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United Kingdom',
                            ],
                            29 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guernsey',
                            ],
                            30 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Italy',
                            ],
                            31 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Croatia, Republic of',
                            ],
                            32 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Latvia',
                            ],
                            33 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lithuania',
                            ],
                            34 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Malta',
                            ],
                            35 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Macedonia',
                            ],
                            36 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Moldova',
                            ],
                            37 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montenegro',
                            ],
                            38 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Poland',
                            ],
                            39 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Romania',
                            ],
                            40 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'San Marino',
                            ],
                            41 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Serbia',
                            ],
                            42 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovakia',
                            ],
                            43 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovenia',
                            ],
                            44 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Spain',
                            ],
                            45 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Svalbard and Jan Mayen',
                            ],
                            46 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Ukraine',
                            ],
                            47 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belarus',
                            ],
                            48 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cyprus',
                            ],
                            49 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Afghanistan',
                            ],
                            50 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Armenia',
                            ],
                            51 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Azerbaijan Republic',
                            ],
                            52 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bangladesh',
                            ],
                            53 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bhutan',
                            ],
                            54 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'China',
                            ],
                            55 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Georgia',
                            ],
                            56 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'India',
                            ],
                            57 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kazakhstan',
                            ],
                            58 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kyrgyzstan',
                            ],
                            59 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mongolia',
                            ],
                            60 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nepal',
                            ],
                            61 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Pakistan',
                            ],
                            62 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Sri Lanka',
                            ],
                            63 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Korea, South',
                            ],
                            64 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tajikistan',
                            ],
                            65 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkmenistan',
                            ],
                            66 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Uzbekistan',
                            ],
                            67 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bahrain',
                            ],
                            68 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Iraq',
                            ],
                            69 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Yemen',
                            ],
                            70 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jordan',
                            ],
                            71 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Qatar',
                            ],
                            72 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kuwait',
                            ],
                            73 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lebanon',
                            ],
                            74 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Oman',
                            ],
                            75 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saudi Arabia',
                            ],
                            76 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkey',
                            ],
                            77 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Anguilla',
                            ],
                            78 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Antigua and Barbuda',
                            ],
                            79 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belize',
                            ],
                            80 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Costa Rica',
                            ],
                            81 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominica',
                            ],
                            82 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominican Republic',
                            ],
                            83 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'El Salvador',
                            ],
                            84 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Grenada',
                            ],
                            85 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guadeloupe',
                            ],
                            86 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guatemala',
                            ],
                            87 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Haiti',
                            ],
                            88 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Honduras',
                            ],
                            89 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jamaica',
                            ],
                            90 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Martinique',
                            ],
                            91 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montserrat',
                            ],
                            92 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Netherlands Antilles',
                            ],
                            93 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nicaragua',
                            ],
                            94 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Panama',
                            ],
                            95 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Puerto Rico',
                            ],
                            96 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Kitts-Nevis',
                            ],
                            97 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Lucia',
                            ],
                            98 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Vincent and the Grenadines',
                            ],
                            99 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Trinidad and Tobago',
                            ],
                            100 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turks and Caicos Islands',
                            ],
                        ],
                        'region_included' => [
                            0 => [
                                'region_type' => 'WORLDWIDE',
                                'region_name' => 'Worldwide',
                            ],
                        ],
                    ],
                    'images' => [
                        0 => 'https://i.ebayimg.com/images/g/sboAAOSwBrRdx08Q/s-l1600.jpg',
                        1 => 'https://i.ebayimg.com/images/g/qCQAAOSwXzBdxoGx/s-l1600.jpg',
                        2 => 'https://i.ebayimg.com/images/g/Bs0AAOSwe2ZdxoHb/s-l1600.jpg',
                        3 => 'https://i.ebayimg.com/images/g/JUEAAOSwGEFdxoG7/s-l1600.jpg',
                        4 => 'https://i.ebayimg.com/images/g/PmsAAOSwm5NdxoHU/s-l1600.jpg',
                    ],
                    'enabled_for_guest_checkout' => false,
                    'eligible_for_inline_checkout' => true,
                ],
                1 => [
                    'itemId' => 'v1|324086594399|513135076727',
                    'itemEndDate' => '2020-12-30',
                    'price' => [
                        'amount' => '12.04',
                        'currency' => 'USD',
                        'display_price' => 'US 12,04 $',
                    ],
                    'marketing_price' => [
                        'discount_percentage' => NULL,
                        'original_price' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                        'discount_amount' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                    ],
                    'unit_pricing_measure' => '',
                    'unit_price' => [
                        'value' => '',
                        'currency' => '',
                    ],
                    'energy_efficiency_class' => '',
                    'item_web_url' => 'https://www.ebay.com/itm/Cat-Eye-Square-Ladies-Sunglasses-Retro-Fashion-Plastic-Frame-Black-Brown-/324086594399?var=513135076727',
                    'item_url' => '',
                    'short_description' => 'Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400 Sonnenbrillenmaße: 1 Sonnenbrillenbreite ............ 144 mm (5,7 ") 2 Brückenbreite .................... 16 mm (0,6 ") 3 Sonnenbrillen Höhe ........... 56 mm (2,2 ") Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.   Zahlung Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel. Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse.',
                    'subtitle' => '',
                    'location' => [
                        'city' => 'Los Angeles',
                        'country' => 'US',
                        'postalCode' => '',
                        'stateOrProvince' => 'California',
                    ],
                    'quantity' => 10,
                    'quantity_type' => 'MORE_THAN',
                    'max_buy_quantity' => '',
                    'sold_quantity' => 0,
                    'availability_status' => 'IN_STOCK',
                    'item_end_date' => NULL,
                    'return_terms' => [
                        'extended_holiday_returns_offered' => '',
                        'refund_method' => '',
                        'restocking_fee_percentage' => '',
                        'return_shipping_cost_payer' => 'SELLER',
                        'return_accepted' => true,
                        'return_instructions' => 'Widerrufsbelehrung gem&auml;&szlig; Richtline 2011/83/EU &uuml;ber die Rechte der Verbraucher vom 25. Oktober 2011
 Widerrufsrecht
 Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gr&uuml;nden diesen Vertrag zu widerrufen.
 Die Widerrufsfrist betr&auml;gt vierzehn Tagen ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Bef&ouml;rderer ist, die Waren in Besitz genommen haben bzw. hat.
 Um Ihr Widerrufsrecht auszu&uuml;ben, m&uuml;ssen Sie uns mittels einer eindeutigen Erkl&auml;rung (z.B. ein mit der Post versandter Brief, Telefax oder E-Mail) &uuml;ber Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie k&ouml;nnen daf&uuml;r das beigef&uuml;gte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist.
 Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung &uuml;ber die Aus&uuml;bung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
 Folgen des Widerrufs
 Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschlie&szlig;lich der Lieferkosten (mit Ausnahme der zus&auml;tzlichen Kosten, die sich daraus ergeben, dass Sie eine andere Art der Lieferung als die von uns angebotene, g&uuml;nstigste Standardlieferung gew&auml;hlt haben), unverz&uuml;glich und sp&auml;testens binnen vierzehn Tagen ab dem Tag zur&uuml;ckzuzahlen, an dem die Mitteilung &uuml;ber Ihren Widerruf dieses Vertrags bei uns eingegangen ist. F&uuml;r diese R&uuml;ckzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der urspr&uuml;nglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdr&uuml;cklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser R&uuml;ckzahlung Entgelte berechnet. Wir k&ouml;nnen die R&uuml;ckzahlung verweigern, bis wir die Waren wieder zur&uuml;ckerhalten haben oder bis Sie den Nachweis erbracht haben, dass Sie die Waren zur&uuml;ckgesandt haben, je nachdem, welches der fr&uuml;here Zeitpunkt ist.
 Sie haben die Waren unverz&uuml;glich und in jedem Fall sp&auml;testens binnen vierzehn Tagen ab dem Tag, an dem Sie uns &uuml;ber den Widerruf dieses Vertrags unterrichten, an uns zur&uuml;ckzusenden oder zu &uuml;bergeben. Die Frist ist gewahrt, wenn Sie die Waren vor Ablauf der Frist von vierzehn Tagen absenden.
 Sie tragen die unmittelbaren Kosten der R&uuml;cksendung der Waren.
 Sie m&uuml;ssen f&uuml;r einen etwaigen Wertverlust der Waren nur aufkommen, wenn dieser Wertverlust auf einen zur Pr&uuml;fung der Beschaffenheit, Eigenschaften und Funktionsweise der Waren nicht notwendigen Umgang mit ihnen zur&uuml;ckzuf&uuml;hren ist.
 Muster-Widerrufsformular
 (Wenn Sie den Vertrag widerrufen wollen, dann f&uuml;llen Sie bitte dieses Formular aus und senden Sie es zur&uuml;ck.)
 - Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag &uuml;ber den Kauf der folgenden Waren (*)/die Erbringung der folgenden Dienstleistung (*)
 - Bestellt am (*)/erhalten am (*)
 - Name des/der Verbraucher(s)
 - Anschrift des/der Verbraucher(s)
 - Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)
 - Datum
 (*) Unzutreffendes streichen.',
                        'return_method' => '',
                        'return_period' => [
                            'unit' => 'CALENDAR_DAY',
                            'value' => 30,
                        ],
                    ],
                    'seller' => [
                        'feedback_percentage' => '99.5',
                        'feedback_score' => 10667,
                        'username' => 'top-exclusive',
                        'account_type' => '',
                        'legal_info' => [
                            'email' => '',
                            'fax' => '',
                            'imprint' => '',
                            'legal_contact_first_name' => '',
                            'legal_contact_last_name' => '',
                            'name' => '',
                            'phone' => '',
                            'registration_number' => '',
                            'legal_address' => [
                                'address_line_1' => '',
                                'address_line_2' => '',
                                'city' => '',
                                'country' => '',
                                'country_name' => '',
                                'county' => '',
                                'postal_code' => '',
                                'state_or_province' => '',
                            ],
                            'terms_of_service' => '',
                            'vat_details' => [
                                'issuing_country' => '',
                                'vat_id' => '',
                            ],
                        ],
                    ],
                    'attributes' => [
                        0 => [
                            'name' => 'Farbe',
                            'value' => 'BRAUN LANDSCHILDKRÖTE',
                        ],
                        1 => [
                            'name' => 'Glasfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        2 => [
                            'name' => 'Stil',
                            'value' => 'Cat Eye',
                        ],
                        3 => [
                            'name' => 'Gläserhöhe',
                            'value' => '4.3cm',
                        ],
                        4 => [
                            'name' => 'Anlass',
                            'value' => 'party/cocktail',
                        ],
                        5 => [
                            'name' => 'Gläserfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        6 => [
                            'name' => 'Thema',
                            'value' => 'Designer, Retro, Cat',
                        ],
                        7 => [
                            'name' => 'Gestellmaterial',
                            'value' => 'Plastik',
                        ],
                        8 => [
                            'name' => 'Modell',
                            'value' => 'Quadrat',
                        ],
                        9 => [
                            'name' => 'Herstellernummer',
                            'value' => 'S71584163',
                        ],
                        10 => [
                            'name' => 'Rahmenbreite',
                            'value' => '14.5cm',
                        ],
                        11 => [
                            'name' => 'Gestellfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        12 => [
                            'name' => 'Rahmenfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        13 => [
                            'name' => 'Stegbreite',
                            'value' => '1.5cm',
                        ],
                        14 => [
                            'name' => 'Rahmenmaterial',
                            'value' => 'Plastik',
                        ],
                        15 => [
                            'name' => 'Produktart',
                            'value' => 'Sonnenbrille',
                        ],
                        16 => [
                            'name' => 'Vergrößerung Stärke',
                            'value' => 'Keiner',
                        ],
                        17 => [
                            'name' => 'Abteilung',
                            'value' => 'Damen',
                        ],
                        18 => [
                            'name' => 'Geschlecht',
                            'value' => 'Damen',
                        ],
                        19 => [
                            'name' => 'Gläsermaterial',
                            'value' => 'Polycarbonat',
                        ],
                        20 => [
                            'name' => 'Besonderheiten',
                            'value' => 'Komplettes Gestell',
                        ],
                        21 => [
                            'name' => 'Vintage',
                            'value' => 'Nein',
                        ],
                        22 => [
                            'name' => 'Marke',
                            'value' => 'Pacific Shades',
                        ],
                        23 => [
                            'name' => 'Modifizierte Artikel',
                            'value' => 'Nein',
                        ],
                        24 => [
                            'name' => 'UV Schutz',
                            'value' => 'UV400',
                        ],
                        25 => [
                            'name' => 'UV-Schutz',
                            'value' => 'UV400',
                        ],
                        26 => [
                            'name' => 'Muster',
                            'value' => 'Solid',
                        ],
                        27 => [
                            'name' => 'Charakter',
                            'value' => 'Claire',
                        ],
                        28 => [
                            'name' => 'Gläsertechnologie',
                            'value' => 'Polycarbonat',
                        ],
                    ],
                    'shipping_options' => [
                    ],
                    'ship_to_locations' => [
                        'region_excluded' => [
                            0 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'Africa',
                            ],
                            1 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'South America',
                            ],
                            2 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Australia',
                            ],
                            3 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Marshall Islands',
                            ],
                            4 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Micronesia',
                            ],
                            5 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nauru',
                            ],
                            6 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Niue',
                            ],
                            7 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Palau',
                            ],
                            8 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Solomon Islands',
                            ],
                            9 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tonga',
                            ],
                            10 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tuvalu',
                            ],
                            11 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vanuatu',
                            ],
                            12 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Wallis and Futuna',
                            ],
                            13 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Brunei Darussalam',
                            ],
                            14 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cambodia',
                            ],
                            15 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Philippines',
                            ],
                            16 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Taiwan',
                            ],
                            17 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Thailand',
                            ],
                            18 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vietnam',
                            ],
                            19 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mexico',
                            ],
                            20 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Pierre and Miquelon',
                            ],
                            21 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United States',
                            ],
                            22 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Russian Federation',
                            ],
                            23 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Albania',
                            ],
                            24 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Andorra',
                            ],
                            25 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bosnia and Herzegovina',
                            ],
                            26 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Estonia',
                            ],
                            27 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'France',
                            ],
                            28 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United Kingdom',
                            ],
                            29 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guernsey',
                            ],
                            30 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Italy',
                            ],
                            31 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Croatia, Republic of',
                            ],
                            32 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Latvia',
                            ],
                            33 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lithuania',
                            ],
                            34 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Malta',
                            ],
                            35 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Macedonia',
                            ],
                            36 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Moldova',
                            ],
                            37 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montenegro',
                            ],
                            38 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Poland',
                            ],
                            39 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Romania',
                            ],
                            40 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'San Marino',
                            ],
                            41 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Serbia',
                            ],
                            42 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovakia',
                            ],
                            43 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovenia',
                            ],
                            44 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Spain',
                            ],
                            45 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Svalbard and Jan Mayen',
                            ],
                            46 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Ukraine',
                            ],
                            47 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belarus',
                            ],
                            48 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cyprus',
                            ],
                            49 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Afghanistan',
                            ],
                            50 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Armenia',
                            ],
                            51 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Azerbaijan Republic',
                            ],
                            52 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bangladesh',
                            ],
                            53 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bhutan',
                            ],
                            54 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'China',
                            ],
                            55 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Georgia',
                            ],
                            56 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'India',
                            ],
                            57 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kazakhstan',
                            ],
                            58 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kyrgyzstan',
                            ],
                            59 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mongolia',
                            ],
                            60 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nepal',
                            ],
                            61 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Pakistan',
                            ],
                            62 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Sri Lanka',
                            ],
                            63 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Korea, South',
                            ],
                            64 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tajikistan',
                            ],
                            65 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkmenistan',
                            ],
                            66 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Uzbekistan',
                            ],
                            67 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bahrain',
                            ],
                            68 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Iraq',
                            ],
                            69 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Yemen',
                            ],
                            70 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jordan',
                            ],
                            71 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Qatar',
                            ],
                            72 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kuwait',
                            ],
                            73 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lebanon',
                            ],
                            74 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Oman',
                            ],
                            75 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saudi Arabia',
                            ],
                            76 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkey',
                            ],
                            77 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Anguilla',
                            ],
                            78 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Antigua and Barbuda',
                            ],
                            79 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belize',
                            ],
                            80 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Costa Rica',
                            ],
                            81 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominica',
                            ],
                            82 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominican Republic',
                            ],
                            83 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'El Salvador',
                            ],
                            84 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Grenada',
                            ],
                            85 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guadeloupe',
                            ],
                            86 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guatemala',
                            ],
                            87 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Haiti',
                            ],
                            88 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Honduras',
                            ],
                            89 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jamaica',
                            ],
                            90 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Martinique',
                            ],
                            91 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montserrat',
                            ],
                            92 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Netherlands Antilles',
                            ],
                            93 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nicaragua',
                            ],
                            94 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Panama',
                            ],
                            95 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Puerto Rico',
                            ],
                            96 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Kitts-Nevis',
                            ],
                            97 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Lucia',
                            ],
                            98 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Vincent and the Grenadines',
                            ],
                            99 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Trinidad and Tobago',
                            ],
                            100 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turks and Caicos Islands',
                            ],
                        ],
                        'region_included' => [
                            0 => [
                                'region_type' => 'WORLDWIDE',
                                'region_name' => 'Worldwide',
                            ],
                        ],
                    ],
                    'images' => [
                        0 => 'https://i.ebayimg.com/images/g/UAkAAOSwCN5dx08D/s-l1600.jpg',
                        1 => 'https://i.ebayimg.com/images/g/Bx4AAOSwe2ZdxoJQ/s-l1600.jpg',
                        2 => 'https://i.ebayimg.com/images/g/YH4AAOSwrphdxoJo/s-l1600.jpg',
                        3 => 'https://i.ebayimg.com/images/g/oQkAAOSwwJ5dxoJZ/s-l1600.jpg',
                        4 => 'https://i.ebayimg.com/images/g/tZ4AAOSwHGtdxoJi/s-l1600.jpg',
                    ],
                    'enabled_for_guest_checkout' => false,
                    'eligible_for_inline_checkout' => true,
                ],
                2 => [
                    'itemId' => 'v1|324086594399|513135076728',
                    'itemEndDate' => '2020-12-02',
                    'price' => [
                        'amount' => '12.99',
                        'currency' => 'USD',
                        'display_price' => 'US 12,99 $',
                    ],
                    'marketing_price' => [
                        'discount_percentage' => NULL,
                        'original_price' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                        'discount_amount' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                    ],
                    'unit_pricing_measure' => '',
                    'unit_price' => [
                        'value' => '',
                        'currency' => '',
                    ],
                    'energy_efficiency_class' => '',
                    'item_web_url' => 'https://www.ebay.com/itm/Cat-Eye-Square-Ladies-Sunglasses-Retro-Fashion-Plastic-Frame-Black-Brown-/324086594399?var=513135076728',
                    'item_url' => '',
                    'short_description' => 'Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400 Sonnenbrillenmaße: 1 Sonnenbrillenbreite ............ 144 mm (5,7 ") 2 Brückenbreite .................... 16 mm (0,6 ") 3 Sonnenbrillen Höhe ........... 56 mm (2,2 ") Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.   Zahlung Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel. Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse.',
                    'subtitle' => '',
                    'location' => [
                        'city' => 'Los Angeles',
                        'country' => 'US',
                        'postalCode' => '',
                        'stateOrProvince' => 'California',
                    ],
                    'quantity' => 10,
                    'quantity_type' => 'MORE_THAN',
                    'max_buy_quantity' => '',
                    'sold_quantity' => 0,
                    'availability_status' => 'IN_STOCK',
                    'item_end_date' => NULL,
                    'return_terms' => [
                        'extended_holiday_returns_offered' => '',
                        'refund_method' => '',
                        'restocking_fee_percentage' => '',
                        'return_shipping_cost_payer' => 'SELLER',
                        'return_accepted' => true,
                        'return_instructions' => 'Widerrufsbelehrung gem&auml;&szlig; Richtline 2011/83/EU &uuml;ber die Rechte der Verbraucher vom 25. Oktober 2011
 Widerrufsrecht
 Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gr&uuml;nden diesen Vertrag zu widerrufen.
 Die Widerrufsfrist betr&auml;gt vierzehn Tagen ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Bef&ouml;rderer ist, die Waren in Besitz genommen haben bzw. hat.
 Um Ihr Widerrufsrecht auszu&uuml;ben, m&uuml;ssen Sie uns mittels einer eindeutigen Erkl&auml;rung (z.B. ein mit der Post versandter Brief, Telefax oder E-Mail) &uuml;ber Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie k&ouml;nnen daf&uuml;r das beigef&uuml;gte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist.
 Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung &uuml;ber die Aus&uuml;bung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
 Folgen des Widerrufs
 Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschlie&szlig;lich der Lieferkosten (mit Ausnahme der zus&auml;tzlichen Kosten, die sich daraus ergeben, dass Sie eine andere Art der Lieferung als die von uns angebotene, g&uuml;nstigste Standardlieferung gew&auml;hlt haben), unverz&uuml;glich und sp&auml;testens binnen vierzehn Tagen ab dem Tag zur&uuml;ckzuzahlen, an dem die Mitteilung &uuml;ber Ihren Widerruf dieses Vertrags bei uns eingegangen ist. F&uuml;r diese R&uuml;ckzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der urspr&uuml;nglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdr&uuml;cklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser R&uuml;ckzahlung Entgelte berechnet. Wir k&ouml;nnen die R&uuml;ckzahlung verweigern, bis wir die Waren wieder zur&uuml;ckerhalten haben oder bis Sie den Nachweis erbracht haben, dass Sie die Waren zur&uuml;ckgesandt haben, je nachdem, welches der fr&uuml;here Zeitpunkt ist.
 Sie haben die Waren unverz&uuml;glich und in jedem Fall sp&auml;testens binnen vierzehn Tagen ab dem Tag, an dem Sie uns &uuml;ber den Widerruf dieses Vertrags unterrichten, an uns zur&uuml;ckzusenden oder zu &uuml;bergeben. Die Frist ist gewahrt, wenn Sie die Waren vor Ablauf der Frist von vierzehn Tagen absenden.
 Sie tragen die unmittelbaren Kosten der R&uuml;cksendung der Waren.
 Sie m&uuml;ssen f&uuml;r einen etwaigen Wertverlust der Waren nur aufkommen, wenn dieser Wertverlust auf einen zur Pr&uuml;fung der Beschaffenheit, Eigenschaften und Funktionsweise der Waren nicht notwendigen Umgang mit ihnen zur&uuml;ckzuf&uuml;hren ist.
 Muster-Widerrufsformular
 (Wenn Sie den Vertrag widerrufen wollen, dann f&uuml;llen Sie bitte dieses Formular aus und senden Sie es zur&uuml;ck.)
 - Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag &uuml;ber den Kauf der folgenden Waren (*)/die Erbringung der folgenden Dienstleistung (*)
 - Bestellt am (*)/erhalten am (*)
 - Name des/der Verbraucher(s)
 - Anschrift des/der Verbraucher(s)
 - Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)
 - Datum
 (*) Unzutreffendes streichen.',
                        'return_method' => '',
                        'return_period' => [
                            'unit' => 'CALENDAR_DAY',
                            'value' => 30,
                        ],
                    ],
                    'seller' => [
                        'feedback_percentage' => '99.5',
                        'feedback_score' => 10667,
                        'username' => 'top-exclusive',
                        'account_type' => '',
                        'legal_info' => [
                            'email' => '',
                            'fax' => '',
                            'imprint' => '',
                            'legal_contact_first_name' => '',
                            'legal_contact_last_name' => '',
                            'name' => '',
                            'phone' => '',
                            'registration_number' => '',
                            'legal_address' => [
                                'address_line_1' => '',
                                'address_line_2' => '',
                                'city' => '',
                                'country' => '',
                                'country_name' => '',
                                'county' => '',
                                'postal_code' => '',
                                'state_or_province' => '',
                            ],
                            'terms_of_service' => '',
                            'vat_details' => [
                                'issuing_country' => '',
                                'vat_id' => '',
                            ],
                        ],
                    ],
                    'attributes' => [
                        0 => [
                            'name' => 'Farbe',
                            'value' => 'Schwarz & Braun',
                        ],
                        1 => [
                            'name' => 'Glasfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        2 => [
                            'name' => 'Stil',
                            'value' => 'Cat Eye',
                        ],
                        3 => [
                            'name' => 'Gläserhöhe',
                            'value' => '4.3cm',
                        ],
                        4 => [
                            'name' => 'Anlass',
                            'value' => 'party/cocktail',
                        ],
                        5 => [
                            'name' => 'Gläserfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        6 => [
                            'name' => 'Thema',
                            'value' => 'Designer, Retro, Cat',
                        ],
                        7 => [
                            'name' => 'Gestellmaterial',
                            'value' => 'Plastik',
                        ],
                        8 => [
                            'name' => 'Modell',
                            'value' => 'Quadrat',
                        ],
                        9 => [
                            'name' => 'Herstellernummer',
                            'value' => 'S71584163',
                        ],
                        10 => [
                            'name' => 'Rahmenbreite',
                            'value' => '14.5cm',
                        ],
                        11 => [
                            'name' => 'Gestellfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        12 => [
                            'name' => 'Rahmenfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        13 => [
                            'name' => 'Stegbreite',
                            'value' => '1.5cm',
                        ],
                        14 => [
                            'name' => 'Rahmenmaterial',
                            'value' => 'Plastik',
                        ],
                        15 => [
                            'name' => 'Produktart',
                            'value' => 'Sonnenbrille',
                        ],
                        16 => [
                            'name' => 'Vergrößerung Stärke',
                            'value' => 'Keiner',
                        ],
                        17 => [
                            'name' => 'Abteilung',
                            'value' => 'Damen',
                        ],
                        18 => [
                            'name' => 'Geschlecht',
                            'value' => 'Damen',
                        ],
                        19 => [
                            'name' => 'Gläsermaterial',
                            'value' => 'Polycarbonat',
                        ],
                        20 => [
                            'name' => 'Besonderheiten',
                            'value' => 'Komplettes Gestell',
                        ],
                        21 => [
                            'name' => 'Vintage',
                            'value' => 'Nein',
                        ],
                        22 => [
                            'name' => 'Marke',
                            'value' => 'Pacific Shades',
                        ],
                        23 => [
                            'name' => 'Modifizierte Artikel',
                            'value' => 'Nein',
                        ],
                        24 => [
                            'name' => 'UV Schutz',
                            'value' => 'UV400',
                        ],
                        25 => [
                            'name' => 'UV-Schutz',
                            'value' => 'UV400',
                        ],
                        26 => [
                            'name' => 'Muster',
                            'value' => 'Solid',
                        ],
                        27 => [
                            'name' => 'Charakter',
                            'value' => 'Claire',
                        ],
                        28 => [
                            'name' => 'Gläsertechnologie',
                            'value' => 'Polycarbonat',
                        ],
                    ],
                    'shipping_options' => [
                    ],
                    'ship_to_locations' => [
                        'region_excluded' => [
                            0 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'Africa',
                            ],
                            1 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'South America',
                            ],
                            2 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Australia',
                            ],
                            3 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Marshall Islands',
                            ],
                            4 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Micronesia',
                            ],
                            5 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nauru',
                            ],
                            6 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Niue',
                            ],
                            7 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Palau',
                            ],
                            8 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Solomon Islands',
                            ],
                            9 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tonga',
                            ],
                            10 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tuvalu',
                            ],
                            11 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vanuatu',
                            ],
                            12 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Wallis and Futuna',
                            ],
                            13 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Brunei Darussalam',
                            ],
                            14 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cambodia',
                            ],
                            15 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Philippines',
                            ],
                            16 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Taiwan',
                            ],
                            17 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Thailand',
                            ],
                            18 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vietnam',
                            ],
                            19 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mexico',
                            ],
                            20 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Pierre and Miquelon',
                            ],
                            21 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United States',
                            ],
                            22 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Russian Federation',
                            ],
                            23 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Albania',
                            ],
                            24 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Andorra',
                            ],
                            25 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bosnia and Herzegovina',
                            ],
                            26 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Estonia',
                            ],
                            27 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'France',
                            ],
                            28 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United Kingdom',
                            ],
                            29 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guernsey',
                            ],
                            30 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Italy',
                            ],
                            31 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Croatia, Republic of',
                            ],
                            32 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Latvia',
                            ],
                            33 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lithuania',
                            ],
                            34 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Malta',
                            ],
                            35 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Macedonia',
                            ],
                            36 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Moldova',
                            ],
                            37 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montenegro',
                            ],
                            38 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Poland',
                            ],
                            39 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Romania',
                            ],
                            40 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'San Marino',
                            ],
                            41 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Serbia',
                            ],
                            42 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovakia',
                            ],
                            43 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovenia',
                            ],
                            44 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Spain',
                            ],
                            45 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Svalbard and Jan Mayen',
                            ],
                            46 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Ukraine',
                            ],
                            47 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belarus',
                            ],
                            48 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cyprus',
                            ],
                            49 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Afghanistan',
                            ],
                            50 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Armenia',
                            ],
                            51 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Azerbaijan Republic',
                            ],
                            52 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bangladesh',
                            ],
                            53 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bhutan',
                            ],
                            54 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'China',
                            ],
                            55 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Georgia',
                            ],
                            56 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'India',
                            ],
                            57 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kazakhstan',
                            ],
                            58 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kyrgyzstan',
                            ],
                            59 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mongolia',
                            ],
                            60 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nepal',
                            ],
                            61 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Pakistan',
                            ],
                            62 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Sri Lanka',
                            ],
                            63 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Korea, South',
                            ],
                            64 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tajikistan',
                            ],
                            65 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkmenistan',
                            ],
                            66 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Uzbekistan',
                            ],
                            67 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bahrain',
                            ],
                            68 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Iraq',
                            ],
                            69 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Yemen',
                            ],
                            70 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jordan',
                            ],
                            71 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Qatar',
                            ],
                            72 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kuwait',
                            ],
                            73 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lebanon',
                            ],
                            74 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Oman',
                            ],
                            75 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saudi Arabia',
                            ],
                            76 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkey',
                            ],
                            77 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Anguilla',
                            ],
                            78 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Antigua and Barbuda',
                            ],
                            79 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belize',
                            ],
                            80 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Costa Rica',
                            ],
                            81 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominica',
                            ],
                            82 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominican Republic',
                            ],
                            83 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'El Salvador',
                            ],
                            84 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Grenada',
                            ],
                            85 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guadeloupe',
                            ],
                            86 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guatemala',
                            ],
                            87 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Haiti',
                            ],
                            88 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Honduras',
                            ],
                            89 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jamaica',
                            ],
                            90 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Martinique',
                            ],
                            91 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montserrat',
                            ],
                            92 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Netherlands Antilles',
                            ],
                            93 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nicaragua',
                            ],
                            94 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Panama',
                            ],
                            95 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Puerto Rico',
                            ],
                            96 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Kitts-Nevis',
                            ],
                            97 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Lucia',
                            ],
                            98 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Vincent and the Grenadines',
                            ],
                            99 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Trinidad and Tobago',
                            ],
                            100 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turks and Caicos Islands',
                            ],
                        ],
                        'region_included' => [
                            0 => [
                                'region_type' => 'WORLDWIDE',
                                'region_name' => 'Worldwide',
                            ],
                        ],
                    ],
                    'images' => [
                        0 => 'https://i.ebayimg.com/images/g/4JIAAOSwsbhdx07U/s-l1600.jpg',
                        1 => 'https://i.ebayimg.com/images/g/L2cAAOSwyA1dxoKT/s-l1600.jpg',
                        2 => 'https://i.ebayimg.com/images/g/aR4AAOSw8SddxoJ2/s-l1600.jpg',
                        3 => 'https://i.ebayimg.com/images/g/JloAAOSw14ZdxoKL/s-l1600.jpg',
                        4 => 'https://i.ebayimg.com/images/g/JlIAAOSw14ZdxoKA/s-l1600.jpg',
                        5 => 'https://i.ebayimg.com/images/g/ykcAAOSwxctdxoKp/s-l1600.jpg',
                        6 => 'https://i.ebayimg.com/images/g/7e4AAOSwngJdx07c/s-l1600.jpg',
                        7 => 'https://i.ebayimg.com/images/g/ZiMAAOSwmxVdx07g/s-l1600.jpg',
                        8 => 'https://i.ebayimg.com/images/g/TjIAAOSw8V9dx07i/s-l1600.jpg',
                    ],
                    'enabled_for_guest_checkout' => false,
                    'eligible_for_inline_checkout' => true,
                ],
            ],
            'energy_efficiency_class' => '',
            'productFicheWebUrl' => '',
            'category_id' => '45246',
            'category_path' => 'Kleidung & Accessoires|Damen|Damen-Accessoires|Sonnenbrillen & Zubehör|Sonnenbrillen',
            'delivery_duration_de' => NULL,
            'images' => [
                0 => 'https://i.ebayimg.com/images/g/gV4AAOSwrxpdxoIZ/s-l1600.jpg',
                1 => 'https://i.ebayimg.com/images/g/LNkAAOSwVR9dxoID/s-l1600.jpg',
                2 => 'https://i.ebayimg.com/images/g/lzgAAOSwPCFdxoIw/s-l1600.jpg',
                3 => 'https://i.ebayimg.com/images/g/8SAAAOSw1LJdxoIj/s-l1600.jpg',
            ],
            'configurable_attributes' => [
                'Farbe' => [
                    0 => 'Schwarz',
                    1 => 'BRAUN LANDSCHILDKRÖTE',
                    2 => 'Schwarz & Braun',
                ],
            ],
        ];
        return json_decode(json_encode($product), false);
    }
    
    
    public function getItem1()
    {
        $product = [
            'type' => 'CONFIGURABLE',
            'parent_id' => '324086594399',
            'title' => 'Cat Eye Square Ladies Sunglasses Retro Fashion Plastic Frame Black Brown',
            'description' => '<meta name="viewport" content="width=device-width, initial-scale=1.0"><div style="background-color: white !important; border:1px solid #ccc !important; width: 90% !important; padding: 6px !important; margin: auto !important; text-align: left !important; font-size:14px !important; line-height:24px !important;">Wenn Sie von dem US Marktplatz bestellen, können für die Pakete Steuern und Zollgebühren anfallen, die der Käufer später tragen muss.<h2 style="font-size:18px !important;">Cat Eye Quadratisch Damen Sonnenbrille Retro Mode Plastik Rahmen Schwarz Braune</h2><div>Das Datenblatt dieses Produkts wurde ursprünglich auf Englisch verfasst. Unten finden Sie eine automatische Übersetzung ins Deutsche. Sollten Sie irgendwelche Fragen haben, kontaktieren Sie uns.</div><br /><br /></div><html><head></head><body><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><meta content="width=device-width, initial-scale=1.0" name="viewport"/><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><font rwr="1" style=""><div style="text-align: center;"><font face="Arial" size="5">Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400</font></div><div style="text-align: center;"><font face="Arial" size="5"><br/></font></div><div style="text-align: center;"><font face="Arial" size="5"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4">Sonnenbrillenmaße:</font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">1 Sonnenbrillenbreite ............ 144 mm (5,7 ")</font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">2 Brückenbreite .................... 16 mm (0,6 ")</font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">3 Sonnenbrillen Höhe ........... 56 mm (2,2 ")</font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.  </font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4">Zahlung</font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel.</font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse. Die Bestellung wird innerhalb von 24 Stunden von Montag bis Freitag nach Zahlungseingang versandt. Die geschätzte Zeit beträgt 2-5 Werktage in den USA und 10-15 Werktage für internationale Ziele. Diese Gebühren gehen zu Lasten des Käufers. </font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555" size="2">Kundenzufriedenheit ist für uns von höchster Wichtigkeit. Wenn der Artikel nicht zu Ihnen passt, senden Sie ihn einfach im Originalzustand an uns zurück, um eine vollständige Rückerstattung oder einen Umtausch zu erhalten. Rücksendungen werden innerhalb von 30 Tagen nach dem Kauf akzeptiert. Wenn Sie Fragen haben, zögern Sie nicht, uns zu kontaktieren.</font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#555555"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font color="#333333" size="2">-top exklusiv</font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><br/></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div><div style="font-family: Arial; font-size: 14pt;"><font size="4"><br/></font></div></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font><div style="display: none"><div typeof="Product" vocab="https://schema.org/"><span property="description">Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400 Sonnenbrillenmaße: 1 Sonnenbrillenbreite ............ 144 mm (5,7 ") 2 Brückenbreite .................... 16 mm (0,6 ") 3 Sonnenbrillen Höhe ........... 56 mm (2,2 ") Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.   Zahlung Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel. Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse. Die Bestellung wird innerhalb von 24 Stunde</span></div></div></body></html><table>
  <tbody>
    <tr>
      <td>Magnification Strength</td>
      <td>None</td>
    </tr>
    <tr>
      <td>Lens Material</td>
      <td>Polycarbonate</td>
    </tr>
    <tr>
      <td>Modified Item</td>
      <td>No</td>
    </tr>
    <tr>
      <td>Frame Width</td>
      <td>5.7"</td>
    </tr>
    <tr>
      <td>Pattern</td>
      <td>Solid</td>
    </tr>
    <tr>
      <td>Style</td>
      <td>Cat Eye</td>
    </tr>
    <tr>
      <td>UV Protection</td>
      <td>UV400</td>
    </tr>
    <tr>
      <td>Theme</td>
      <td>Cat</td>
    </tr>
    <tr>
      <td>Theme</td>
      <td>Designer</td>
    </tr>
    <tr>
      <td>Theme</td>
      <td>Retro</td>
    </tr>
    <tr>
      <td>Department</td>
      <td>Women</td>
    </tr>
    <tr>
      <td>Frame Color</td>
      <td>Multi-Color</td>
    </tr>
    <tr>
      <td>Type</td>
      <td>Sunglasses</td>
    </tr>
    <tr>
      <td>Brand</td>
      <td>Pacific Shades</td>
    </tr>
    <tr>
      <td>Frame Material</td>
      <td>Plastic</td>
    </tr>
    <tr>
      <td>Vintage</td>
      <td>No</td>
    </tr>
    <tr>
      <td>Lens Height</td>
      <td>1.7"</td>
    </tr>
    <tr>
      <td>Gender</td>
      <td>Women</td>
    </tr>
    <tr>
      <td>Bridge Width</td>
      <td>0.6"</td>
    </tr>
    <tr>
      <td>Lens Color</td>
      <td>Multi-Color</td>
    </tr>
    <tr>
      <td>Occasion</td>
      <td>Party/Cocktail</td>
    </tr>
    <tr>
      <td>Model</td>
      <td>Square</td>
    </tr>
    <tr>
      <td>Features</td>
      <td>Full Frame</td>
    </tr>
    <tr>
      <td>Lens Technology</td>
      <td>Polycarbonate</td>
    </tr>
    <tr>
      <td>MPN</td>
      <td>S71584163</td>
    </tr>
  </tbody>
</table>',
            'item_web_url' => 'https://www.ebay.com/itm/Cat-Eye-Square-Ladies-Sunglasses-Retro-Fashion-Plastic-Frame-Black-Brown-/324086594399',
            'items' => [
                0 => [
                    'itemId' => 'v1|324086594399|513135076726',
                    'itemEndDate' => '2020-12-30',
                    'estimatedAvailabilities' => [
                        0 => ['estimatedAvailabilityStatus' => 'IN_STOCK']
                    ],
                    'price' => [
                        'amount' => '13.03',
                        'currency' => 'USD',
                        'display_price' => 'US 13,03 $',
                    ],
                    'marketing_price' => [
                        'discount_percentage' => NULL,
                        'original_price' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                        'discount_amount' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                    ],
                    'unit_pricing_measure' => '',
                    'unit_price' => [
                        'value' => '',
                        'currency' => '',
                    ],
                    'energy_efficiency_class' => '',
                    'item_web_url' => 'https://www.ebay.com/itm/Cat-Eye-Square-Ladies-Sunglasses-Retro-Fashion-Plastic-Frame-Black-Brown-/324086594399?var=513135076726',
                    'item_url' => '',
                    'short_description' => 'Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400 Sonnenbrillenmaße: 1 Sonnenbrillenbreite ............ 144 mm (5,7 ") 2 Brückenbreite .................... 16 mm (0,6 ") 3 Sonnenbrillen Höhe ........... 56 mm (2,2 ") Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.   Zahlung Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel. Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse.',
                    'subtitle' => '',
                    'location' => [
                        'city' => 'Los Angeles',
                        'country' => 'US',
                        'postalCode' => '',
                        'stateOrProvince' => 'California',
                    ],
                    'quantity' => 10,
                    'quantity_type' => 'MORE_THAN',
                    'max_buy_quantity' => '',
                    'sold_quantity' => 0,
                    'availability_status' => 'IN_STOCK',
                    'item_end_date' => NULL,
                    'return_terms' => [
                        'extended_holiday_returns_offered' => '',
                        'refund_method' => '',
                        'restocking_fee_percentage' => '',
                        'return_shipping_cost_payer' => 'SELLER',
                        'return_accepted' => true,
                        'return_instructions' => 'Widerrufsbelehrung gem&auml;&szlig; Richtline 2011/83/EU &uuml;ber die Rechte der Verbraucher vom 25. Oktober 2011
 Widerrufsrecht
 Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gr&uuml;nden diesen Vertrag zu widerrufen.
 Die Widerrufsfrist betr&auml;gt vierzehn Tagen ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Bef&ouml;rderer ist, die Waren in Besitz genommen haben bzw. hat.
 Um Ihr Widerrufsrecht auszu&uuml;ben, m&uuml;ssen Sie uns mittels einer eindeutigen Erkl&auml;rung (z.B. ein mit der Post versandter Brief, Telefax oder E-Mail) &uuml;ber Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie k&ouml;nnen daf&uuml;r das beigef&uuml;gte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist.
 Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung &uuml;ber die Aus&uuml;bung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
 Folgen des Widerrufs
 Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschlie&szlig;lich der Lieferkosten (mit Ausnahme der zus&auml;tzlichen Kosten, die sich daraus ergeben, dass Sie eine andere Art der Lieferung als die von uns angebotene, g&uuml;nstigste Standardlieferung gew&auml;hlt haben), unverz&uuml;glich und sp&auml;testens binnen vierzehn Tagen ab dem Tag zur&uuml;ckzuzahlen, an dem die Mitteilung &uuml;ber Ihren Widerruf dieses Vertrags bei uns eingegangen ist. F&uuml;r diese R&uuml;ckzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der urspr&uuml;nglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdr&uuml;cklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser R&uuml;ckzahlung Entgelte berechnet. Wir k&ouml;nnen die R&uuml;ckzahlung verweigern, bis wir die Waren wieder zur&uuml;ckerhalten haben oder bis Sie den Nachweis erbracht haben, dass Sie die Waren zur&uuml;ckgesandt haben, je nachdem, welches der fr&uuml;here Zeitpunkt ist.
 Sie haben die Waren unverz&uuml;glich und in jedem Fall sp&auml;testens binnen vierzehn Tagen ab dem Tag, an dem Sie uns &uuml;ber den Widerruf dieses Vertrags unterrichten, an uns zur&uuml;ckzusenden oder zu &uuml;bergeben. Die Frist ist gewahrt, wenn Sie die Waren vor Ablauf der Frist von vierzehn Tagen absenden.
 Sie tragen die unmittelbaren Kosten der R&uuml;cksendung der Waren.
 Sie m&uuml;ssen f&uuml;r einen etwaigen Wertverlust der Waren nur aufkommen, wenn dieser Wertverlust auf einen zur Pr&uuml;fung der Beschaffenheit, Eigenschaften und Funktionsweise der Waren nicht notwendigen Umgang mit ihnen zur&uuml;ckzuf&uuml;hren ist.
 Muster-Widerrufsformular
 (Wenn Sie den Vertrag widerrufen wollen, dann f&uuml;llen Sie bitte dieses Formular aus und senden Sie es zur&uuml;ck.)
 - Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag &uuml;ber den Kauf der folgenden Waren (*)/die Erbringung der folgenden Dienstleistung (*)
 - Bestellt am (*)/erhalten am (*)
 - Name des/der Verbraucher(s)
 - Anschrift des/der Verbraucher(s)
 - Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)
 - Datum
 (*) Unzutreffendes streichen.',
                        'return_method' => '',
                        'return_period' => [
                            'unit' => 'CALENDAR_DAY',
                            'value' => 30,
                        ],
                    ],
                    'seller' => [
                        'feedback_percentage' => '99.5',
                        'feedback_score' => 10667,
                        'username' => 'top-exclusive',
                        'account_type' => '',
                        'legal_info' => [
                            'email' => '',
                            'fax' => '',
                            'imprint' => '',
                            'legal_contact_first_name' => '',
                            'legal_contact_last_name' => '',
                            'name' => '',
                            'phone' => '',
                            'registration_number' => '',
                            'legal_address' => [
                                'address_line_1' => '',
                                'address_line_2' => '',
                                'city' => '',
                                'country' => '',
                                'country_name' => '',
                                'county' => '',
                                'postal_code' => '',
                                'state_or_province' => '',
                            ],
                            'terms_of_service' => '',
                            'vat_details' => [
                                'issuing_country' => '',
                                'vat_id' => '',
                            ],
                        ],
                    ],
                    'attributes' => [
                        0 => [
                            'name' => 'Farbe',
                            'value' => 'Schwarz',
                        ],
                        1 => [
                            'name' => 'Glasfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        2 => [
                            'name' => 'Stil',
                            'value' => 'Cat Eye',
                        ],
                        3 => [
                            'name' => 'Gläserhöhe',
                            'value' => '4.3cm',
                        ],
                        4 => [
                            'name' => 'Anlass',
                            'value' => 'party/cocktail',
                        ],
                        5 => [
                            'name' => 'Gläserfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        6 => [
                            'name' => 'Thema',
                            'value' => 'Designer, Retro, Cat',
                        ],
                        7 => [
                            'name' => 'Gestellmaterial',
                            'value' => 'Plastik',
                        ],
                        8 => [
                            'name' => 'Modell',
                            'value' => 'Quadrat',
                        ],
                        9 => [
                            'name' => 'Herstellernummer',
                            'value' => 'S71584163',
                        ],
                        10 => [
                            'name' => 'Rahmenbreite',
                            'value' => '14.5cm',
                        ],
                        11 => [
                            'name' => 'Gestellfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        12 => [
                            'name' => 'Rahmenfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        13 => [
                            'name' => 'Stegbreite',
                            'value' => '1.5cm',
                        ],
                        14 => [
                            'name' => 'Rahmenmaterial',
                            'value' => 'Plastik',
                        ],
                        15 => [
                            'name' => 'Produktart',
                            'value' => 'Sonnenbrille',
                        ],
                        16 => [
                            'name' => 'Vergrößerung Stärke',
                            'value' => 'Keiner',
                        ],
                        17 => [
                            'name' => 'Abteilung',
                            'value' => 'Damen',
                        ],
                        18 => [
                            'name' => 'Geschlecht',
                            'value' => 'Damen',
                        ],
                        19 => [
                            'name' => 'Gläsermaterial',
                            'value' => 'Polycarbonat',
                        ],
                        20 => [
                            'name' => 'Besonderheiten',
                            'value' => 'Komplettes Gestell',
                        ],
                        21 => [
                            'name' => 'Vintage',
                            'value' => 'Nein',
                        ],
                        22 => [
                            'name' => 'Marke',
                            'value' => 'Pacific Shades',
                        ],
                        23 => [
                            'name' => 'Modifizierte Artikel',
                            'value' => 'Nein',
                        ],
                        24 => [
                            'name' => 'UV Schutz',
                            'value' => 'UV400',
                        ],
                        25 => [
                            'name' => 'UV-Schutz',
                            'value' => 'UV400',
                        ],
                        26 => [
                            'name' => 'Muster',
                            'value' => 'Solid',
                        ],
                        27 => [
                            'name' => 'Charakter',
                            'value' => 'Claire',
                        ],
                        28 => [
                            'name' => 'Gläsertechnologie',
                            'value' => 'Polycarbonat',
                        ],
                    ],
                    'shipping_options' => [
                    ],
                    'ship_to_locations' => [
                        'region_excluded' => [
                            0 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'Africa',
                            ],
                            1 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'South America',
                            ],
                            2 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Australia',
                            ],
                            3 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Marshall Islands',
                            ],
                            4 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Micronesia',
                            ],
                            5 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nauru',
                            ],
                            6 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Niue',
                            ],
                            7 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Palau',
                            ],
                            8 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Solomon Islands',
                            ],
                            9 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tonga',
                            ],
                            10 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tuvalu',
                            ],
                            11 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vanuatu',
                            ],
                            12 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Wallis and Futuna',
                            ],
                            13 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Brunei Darussalam',
                            ],
                            14 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cambodia',
                            ],
                            15 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Philippines',
                            ],
                            16 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Taiwan',
                            ],
                            17 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Thailand',
                            ],
                            18 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vietnam',
                            ],
                            19 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mexico',
                            ],
                            20 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Pierre and Miquelon',
                            ],
                            21 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United States',
                            ],
                            22 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Russian Federation',
                            ],
                            23 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Albania',
                            ],
                            24 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Andorra',
                            ],
                            25 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bosnia and Herzegovina',
                            ],
                            26 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Estonia',
                            ],
                            27 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'France',
                            ],
                            28 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United Kingdom',
                            ],
                            29 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guernsey',
                            ],
                            30 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Italy',
                            ],
                            31 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Croatia, Republic of',
                            ],
                            32 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Latvia',
                            ],
                            33 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lithuania',
                            ],
                            34 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Malta',
                            ],
                            35 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Macedonia',
                            ],
                            36 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Moldova',
                            ],
                            37 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montenegro',
                            ],
                            38 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Poland',
                            ],
                            39 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Romania',
                            ],
                            40 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'San Marino',
                            ],
                            41 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Serbia',
                            ],
                            42 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovakia',
                            ],
                            43 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovenia',
                            ],
                            44 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Spain',
                            ],
                            45 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Svalbard and Jan Mayen',
                            ],
                            46 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Ukraine',
                            ],
                            47 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belarus',
                            ],
                            48 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cyprus',
                            ],
                            49 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Afghanistan',
                            ],
                            50 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Armenia',
                            ],
                            51 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Azerbaijan Republic',
                            ],
                            52 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bangladesh',
                            ],
                            53 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bhutan',
                            ],
                            54 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'China',
                            ],
                            55 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Georgia',
                            ],
                            56 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'India',
                            ],
                            57 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kazakhstan',
                            ],
                            58 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kyrgyzstan',
                            ],
                            59 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mongolia',
                            ],
                            60 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nepal',
                            ],
                            61 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Pakistan',
                            ],
                            62 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Sri Lanka',
                            ],
                            63 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Korea, South',
                            ],
                            64 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tajikistan',
                            ],
                            65 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkmenistan',
                            ],
                            66 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Uzbekistan',
                            ],
                            67 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bahrain',
                            ],
                            68 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Iraq',
                            ],
                            69 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Yemen',
                            ],
                            70 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jordan',
                            ],
                            71 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Qatar',
                            ],
                            72 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kuwait',
                            ],
                            73 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lebanon',
                            ],
                            74 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Oman',
                            ],
                            75 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saudi Arabia',
                            ],
                            76 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkey',
                            ],
                            77 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Anguilla',
                            ],
                            78 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Antigua and Barbuda',
                            ],
                            79 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belize',
                            ],
                            80 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Costa Rica',
                            ],
                            81 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominica',
                            ],
                            82 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominican Republic',
                            ],
                            83 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'El Salvador',
                            ],
                            84 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Grenada',
                            ],
                            85 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guadeloupe',
                            ],
                            86 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guatemala',
                            ],
                            87 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Haiti',
                            ],
                            88 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Honduras',
                            ],
                            89 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jamaica',
                            ],
                            90 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Martinique',
                            ],
                            91 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montserrat',
                            ],
                            92 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Netherlands Antilles',
                            ],
                            93 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nicaragua',
                            ],
                            94 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Panama',
                            ],
                            95 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Puerto Rico',
                            ],
                            96 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Kitts-Nevis',
                            ],
                            97 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Lucia',
                            ],
                            98 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Vincent and the Grenadines',
                            ],
                            99 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Trinidad and Tobago',
                            ],
                            100 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turks and Caicos Islands',
                            ],
                        ],
                        'region_included' => [
                            0 => [
                                'region_type' => 'WORLDWIDE',
                                'region_name' => 'Worldwide',
                            ],
                        ],
                    ],
                    'images' => [
                        0 => 'https://i.ebayimg.com/images/g/sboAAOSwBrRdx08Q/s-l1600.jpg',
                        1 => 'https://i.ebayimg.com/images/g/qCQAAOSwXzBdxoGx/s-l1600.jpg',
                        2 => 'https://i.ebayimg.com/images/g/Bs0AAOSwe2ZdxoHb/s-l1600.jpg',
                        3 => 'https://i.ebayimg.com/images/g/JUEAAOSwGEFdxoG7/s-l1600.jpg',
                        4 => 'https://i.ebayimg.com/images/g/PmsAAOSwm5NdxoHU/s-l1600.jpg',
                    ],
                    'enabled_for_guest_checkout' => false,
                    'eligible_for_inline_checkout' => true,
                ],
                1 => [
                    'itemId' => 'v1|324086594399|513135076727',
                    'itemEndDate' => '2020-12-30',
                    'price' => [
                        'amount' => '12.04',
                        'currency' => 'USD',
                        'display_price' => 'US 12,04 $',
                    ],
                    'marketing_price' => [
                        'discount_percentage' => NULL,
                        'original_price' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                        'discount_amount' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                    ],
                    'unit_pricing_measure' => '',
                    'unit_price' => [
                        'value' => '',
                        'currency' => '',
                    ],
                    'energy_efficiency_class' => '',
                    'item_web_url' => 'https://www.ebay.com/itm/Cat-Eye-Square-Ladies-Sunglasses-Retro-Fashion-Plastic-Frame-Black-Brown-/324086594399?var=513135076727',
                    'item_url' => '',
                    'short_description' => 'Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400 Sonnenbrillenmaße: 1 Sonnenbrillenbreite ............ 144 mm (5,7 ") 2 Brückenbreite .................... 16 mm (0,6 ") 3 Sonnenbrillen Höhe ........... 56 mm (2,2 ") Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.   Zahlung Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel. Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse.',
                    'subtitle' => '',
                    'location' => [
                        'city' => 'Los Angeles',
                        'country' => 'US',
                        'postalCode' => '',
                        'stateOrProvince' => 'California',
                    ],
                    'quantity' => 10,
                    'quantity_type' => 'MORE_THAN',
                    'max_buy_quantity' => '',
                    'sold_quantity' => 0,
                    'availability_status' => 'IN_STOCK',
                    'item_end_date' => NULL,
                    'return_terms' => [
                        'extended_holiday_returns_offered' => '',
                        'refund_method' => '',
                        'restocking_fee_percentage' => '',
                        'return_shipping_cost_payer' => 'SELLER',
                        'return_accepted' => true,
                        'return_instructions' => 'Widerrufsbelehrung gem&auml;&szlig; Richtline 2011/83/EU &uuml;ber die Rechte der Verbraucher vom 25. Oktober 2011
 Widerrufsrecht
 Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gr&uuml;nden diesen Vertrag zu widerrufen.
 Die Widerrufsfrist betr&auml;gt vierzehn Tagen ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Bef&ouml;rderer ist, die Waren in Besitz genommen haben bzw. hat.
 Um Ihr Widerrufsrecht auszu&uuml;ben, m&uuml;ssen Sie uns mittels einer eindeutigen Erkl&auml;rung (z.B. ein mit der Post versandter Brief, Telefax oder E-Mail) &uuml;ber Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie k&ouml;nnen daf&uuml;r das beigef&uuml;gte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist.
 Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung &uuml;ber die Aus&uuml;bung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
 Folgen des Widerrufs
 Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschlie&szlig;lich der Lieferkosten (mit Ausnahme der zus&auml;tzlichen Kosten, die sich daraus ergeben, dass Sie eine andere Art der Lieferung als die von uns angebotene, g&uuml;nstigste Standardlieferung gew&auml;hlt haben), unverz&uuml;glich und sp&auml;testens binnen vierzehn Tagen ab dem Tag zur&uuml;ckzuzahlen, an dem die Mitteilung &uuml;ber Ihren Widerruf dieses Vertrags bei uns eingegangen ist. F&uuml;r diese R&uuml;ckzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der urspr&uuml;nglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdr&uuml;cklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser R&uuml;ckzahlung Entgelte berechnet. Wir k&ouml;nnen die R&uuml;ckzahlung verweigern, bis wir die Waren wieder zur&uuml;ckerhalten haben oder bis Sie den Nachweis erbracht haben, dass Sie die Waren zur&uuml;ckgesandt haben, je nachdem, welches der fr&uuml;here Zeitpunkt ist.
 Sie haben die Waren unverz&uuml;glich und in jedem Fall sp&auml;testens binnen vierzehn Tagen ab dem Tag, an dem Sie uns &uuml;ber den Widerruf dieses Vertrags unterrichten, an uns zur&uuml;ckzusenden oder zu &uuml;bergeben. Die Frist ist gewahrt, wenn Sie die Waren vor Ablauf der Frist von vierzehn Tagen absenden.
 Sie tragen die unmittelbaren Kosten der R&uuml;cksendung der Waren.
 Sie m&uuml;ssen f&uuml;r einen etwaigen Wertverlust der Waren nur aufkommen, wenn dieser Wertverlust auf einen zur Pr&uuml;fung der Beschaffenheit, Eigenschaften und Funktionsweise der Waren nicht notwendigen Umgang mit ihnen zur&uuml;ckzuf&uuml;hren ist.
 Muster-Widerrufsformular
 (Wenn Sie den Vertrag widerrufen wollen, dann f&uuml;llen Sie bitte dieses Formular aus und senden Sie es zur&uuml;ck.)
 - Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag &uuml;ber den Kauf der folgenden Waren (*)/die Erbringung der folgenden Dienstleistung (*)
 - Bestellt am (*)/erhalten am (*)
 - Name des/der Verbraucher(s)
 - Anschrift des/der Verbraucher(s)
 - Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)
 - Datum
 (*) Unzutreffendes streichen.',
                        'return_method' => '',
                        'return_period' => [
                            'unit' => 'CALENDAR_DAY',
                            'value' => 30,
                        ],
                    ],
                    'seller' => [
                        'feedback_percentage' => '99.5',
                        'feedback_score' => 10667,
                        'username' => 'top-exclusive',
                        'account_type' => '',
                        'legal_info' => [
                            'email' => '',
                            'fax' => '',
                            'imprint' => '',
                            'legal_contact_first_name' => '',
                            'legal_contact_last_name' => '',
                            'name' => '',
                            'phone' => '',
                            'registration_number' => '',
                            'legal_address' => [
                                'address_line_1' => '',
                                'address_line_2' => '',
                                'city' => '',
                                'country' => '',
                                'country_name' => '',
                                'county' => '',
                                'postal_code' => '',
                                'state_or_province' => '',
                            ],
                            'terms_of_service' => '',
                            'vat_details' => [
                                'issuing_country' => '',
                                'vat_id' => '',
                            ],
                        ],
                    ],
                    'attributes' => [
                        0 => [
                            'name' => 'Farbe',
                            'value' => 'BRAUN LANDSCHILDKRÖTE',
                        ],
                        1 => [
                            'name' => 'Glasfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        2 => [
                            'name' => 'Stil',
                            'value' => 'Cat Eye',
                        ],
                        3 => [
                            'name' => 'Gläserhöhe',
                            'value' => '4.3cm',
                        ],
                        4 => [
                            'name' => 'Anlass',
                            'value' => 'party/cocktail',
                        ],
                        5 => [
                            'name' => 'Gläserfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        6 => [
                            'name' => 'Thema',
                            'value' => 'Designer, Retro, Cat',
                        ],
                        7 => [
                            'name' => 'Gestellmaterial',
                            'value' => 'Plastik',
                        ],
                        8 => [
                            'name' => 'Modell',
                            'value' => 'Quadrat',
                        ],
                        9 => [
                            'name' => 'Herstellernummer',
                            'value' => 'S71584163',
                        ],
                        10 => [
                            'name' => 'Rahmenbreite',
                            'value' => '14.5cm',
                        ],
                        11 => [
                            'name' => 'Gestellfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        12 => [
                            'name' => 'Rahmenfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        13 => [
                            'name' => 'Stegbreite',
                            'value' => '1.5cm',
                        ],
                        14 => [
                            'name' => 'Rahmenmaterial',
                            'value' => 'Plastik',
                        ],
                        15 => [
                            'name' => 'Produktart',
                            'value' => 'Sonnenbrille',
                        ],
                        16 => [
                            'name' => 'Vergrößerung Stärke',
                            'value' => 'Keiner',
                        ],
                        17 => [
                            'name' => 'Abteilung',
                            'value' => 'Damen',
                        ],
                        18 => [
                            'name' => 'Geschlecht',
                            'value' => 'Damen',
                        ],
                        19 => [
                            'name' => 'Gläsermaterial',
                            'value' => 'Polycarbonat',
                        ],
                        20 => [
                            'name' => 'Besonderheiten',
                            'value' => 'Komplettes Gestell',
                        ],
                        21 => [
                            'name' => 'Vintage',
                            'value' => 'Nein',
                        ],
                        22 => [
                            'name' => 'Marke',
                            'value' => 'Pacific Shades',
                        ],
                        23 => [
                            'name' => 'Modifizierte Artikel',
                            'value' => 'Nein',
                        ],
                        24 => [
                            'name' => 'UV Schutz',
                            'value' => 'UV400',
                        ],
                        25 => [
                            'name' => 'UV-Schutz',
                            'value' => 'UV400',
                        ],
                        26 => [
                            'name' => 'Muster',
                            'value' => 'Solid',
                        ],
                        27 => [
                            'name' => 'Charakter',
                            'value' => 'Claire',
                        ],
                        28 => [
                            'name' => 'Gläsertechnologie',
                            'value' => 'Polycarbonat',
                        ],
                    ],
                    'shipping_options' => [
                    ],
                    'ship_to_locations' => [
                        'region_excluded' => [
                            0 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'Africa',
                            ],
                            1 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'South America',
                            ],
                            2 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Australia',
                            ],
                            3 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Marshall Islands',
                            ],
                            4 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Micronesia',
                            ],
                            5 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nauru',
                            ],
                            6 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Niue',
                            ],
                            7 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Palau',
                            ],
                            8 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Solomon Islands',
                            ],
                            9 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tonga',
                            ],
                            10 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tuvalu',
                            ],
                            11 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vanuatu',
                            ],
                            12 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Wallis and Futuna',
                            ],
                            13 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Brunei Darussalam',
                            ],
                            14 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cambodia',
                            ],
                            15 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Philippines',
                            ],
                            16 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Taiwan',
                            ],
                            17 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Thailand',
                            ],
                            18 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vietnam',
                            ],
                            19 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mexico',
                            ],
                            20 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Pierre and Miquelon',
                            ],
                            21 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United States',
                            ],
                            22 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Russian Federation',
                            ],
                            23 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Albania',
                            ],
                            24 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Andorra',
                            ],
                            25 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bosnia and Herzegovina',
                            ],
                            26 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Estonia',
                            ],
                            27 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'France',
                            ],
                            28 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United Kingdom',
                            ],
                            29 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guernsey',
                            ],
                            30 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Italy',
                            ],
                            31 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Croatia, Republic of',
                            ],
                            32 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Latvia',
                            ],
                            33 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lithuania',
                            ],
                            34 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Malta',
                            ],
                            35 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Macedonia',
                            ],
                            36 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Moldova',
                            ],
                            37 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montenegro',
                            ],
                            38 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Poland',
                            ],
                            39 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Romania',
                            ],
                            40 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'San Marino',
                            ],
                            41 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Serbia',
                            ],
                            42 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovakia',
                            ],
                            43 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovenia',
                            ],
                            44 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Spain',
                            ],
                            45 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Svalbard and Jan Mayen',
                            ],
                            46 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Ukraine',
                            ],
                            47 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belarus',
                            ],
                            48 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cyprus',
                            ],
                            49 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Afghanistan',
                            ],
                            50 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Armenia',
                            ],
                            51 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Azerbaijan Republic',
                            ],
                            52 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bangladesh',
                            ],
                            53 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bhutan',
                            ],
                            54 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'China',
                            ],
                            55 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Georgia',
                            ],
                            56 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'India',
                            ],
                            57 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kazakhstan',
                            ],
                            58 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kyrgyzstan',
                            ],
                            59 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mongolia',
                            ],
                            60 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nepal',
                            ],
                            61 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Pakistan',
                            ],
                            62 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Sri Lanka',
                            ],
                            63 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Korea, South',
                            ],
                            64 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tajikistan',
                            ],
                            65 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkmenistan',
                            ],
                            66 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Uzbekistan',
                            ],
                            67 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bahrain',
                            ],
                            68 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Iraq',
                            ],
                            69 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Yemen',
                            ],
                            70 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jordan',
                            ],
                            71 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Qatar',
                            ],
                            72 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kuwait',
                            ],
                            73 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lebanon',
                            ],
                            74 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Oman',
                            ],
                            75 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saudi Arabia',
                            ],
                            76 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkey',
                            ],
                            77 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Anguilla',
                            ],
                            78 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Antigua and Barbuda',
                            ],
                            79 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belize',
                            ],
                            80 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Costa Rica',
                            ],
                            81 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominica',
                            ],
                            82 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominican Republic',
                            ],
                            83 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'El Salvador',
                            ],
                            84 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Grenada',
                            ],
                            85 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guadeloupe',
                            ],
                            86 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guatemala',
                            ],
                            87 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Haiti',
                            ],
                            88 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Honduras',
                            ],
                            89 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jamaica',
                            ],
                            90 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Martinique',
                            ],
                            91 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montserrat',
                            ],
                            92 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Netherlands Antilles',
                            ],
                            93 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nicaragua',
                            ],
                            94 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Panama',
                            ],
                            95 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Puerto Rico',
                            ],
                            96 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Kitts-Nevis',
                            ],
                            97 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Lucia',
                            ],
                            98 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Vincent and the Grenadines',
                            ],
                            99 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Trinidad and Tobago',
                            ],
                            100 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turks and Caicos Islands',
                            ],
                        ],
                        'region_included' => [
                            0 => [
                                'region_type' => 'WORLDWIDE',
                                'region_name' => 'Worldwide',
                            ],
                        ],
                    ],
                    'images' => [
                        0 => 'https://i.ebayimg.com/images/g/UAkAAOSwCN5dx08D/s-l1600.jpg',
                        1 => 'https://i.ebayimg.com/images/g/Bx4AAOSwe2ZdxoJQ/s-l1600.jpg',
                        2 => 'https://i.ebayimg.com/images/g/YH4AAOSwrphdxoJo/s-l1600.jpg',
                        3 => 'https://i.ebayimg.com/images/g/oQkAAOSwwJ5dxoJZ/s-l1600.jpg',
                        4 => 'https://i.ebayimg.com/images/g/tZ4AAOSwHGtdxoJi/s-l1600.jpg',
                    ],
                    'enabled_for_guest_checkout' => false,
                    'eligible_for_inline_checkout' => true,
                ],
                2 => [
                    'itemId' => 'v1|324086594399|513135076728',
                    'itemEndDate' => '2020-12-02',
                    'price' => [
                        'amount' => '12.99',
                        'currency' => 'USD',
                        'display_price' => 'US 12,99 $',
                    ],
                    'marketing_price' => [
                        'discount_percentage' => NULL,
                        'original_price' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                        'discount_amount' => [
                            'value' => NULL,
                            'currency' => NULL,
                            'display_price' => '0,00 XXX',
                        ],
                    ],
                    'unit_pricing_measure' => '',
                    'unit_price' => [
                        'value' => '',
                        'currency' => '',
                    ],
                    'energy_efficiency_class' => '',
                    'item_web_url' => 'https://www.ebay.com/itm/Cat-Eye-Square-Ladies-Sunglasses-Retro-Fashion-Plastic-Frame-Black-Brown-/324086594399?var=513135076728',
                    'item_url' => '',
                    'short_description' => 'Cat Eye Square Frauen Sonnenbrille Retro Mode Kunststoffrahmen Schwarz Braun Farbverlauf UV 400 Sonnenbrillenmaße: 1 Sonnenbrillenbreite ............ 144 mm (5,7 ") 2 Brückenbreite .................... 16 mm (0,6 ") 3 Sonnenbrillen Höhe ........... 56 mm (2,2 ") Unsere Sonnenbrillen verfügen über 100% UV- und 100% UV400-Linsentechnologie. Für einen angemessenen Schutz empfehlen Experten Sonnenbrillen, die 99-100% des UVA- und UVB-Lichts mit Wellenlängen von bis zu 400 nm reflektieren / herausfiltern. Unsere Sonnenbrillen mit der Bezeichnung "UV400" erfüllen diese Anforderungen.   Zahlung Wir akzeptieren nur PayPal. Die Umsatzsteuer gilt für alle in Kalifornien verkauften Artikel. Wir versenden per USPS First-Class Mail nur an Ihre PayPal-Adresse.',
                    'subtitle' => '',
                    'location' => [
                        'city' => 'Los Angeles',
                        'country' => 'US',
                        'postalCode' => '',
                        'stateOrProvince' => 'California',
                    ],
                    'quantity' => 10,
                    'quantity_type' => 'MORE_THAN',
                    'max_buy_quantity' => '',
                    'sold_quantity' => 0,
                    'availability_status' => 'IN_STOCK',
                    'item_end_date' => NULL,
                    'return_terms' => [
                        'extended_holiday_returns_offered' => '',
                        'refund_method' => '',
                        'restocking_fee_percentage' => '',
                        'return_shipping_cost_payer' => 'SELLER',
                        'return_accepted' => true,
                        'return_instructions' => 'Widerrufsbelehrung gem&auml;&szlig; Richtline 2011/83/EU &uuml;ber die Rechte der Verbraucher vom 25. Oktober 2011
 Widerrufsrecht
 Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gr&uuml;nden diesen Vertrag zu widerrufen.
 Die Widerrufsfrist betr&auml;gt vierzehn Tagen ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Bef&ouml;rderer ist, die Waren in Besitz genommen haben bzw. hat.
 Um Ihr Widerrufsrecht auszu&uuml;ben, m&uuml;ssen Sie uns mittels einer eindeutigen Erkl&auml;rung (z.B. ein mit der Post versandter Brief, Telefax oder E-Mail) &uuml;ber Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie k&ouml;nnen daf&uuml;r das beigef&uuml;gte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist.
 Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung &uuml;ber die Aus&uuml;bung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
 Folgen des Widerrufs
 Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschlie&szlig;lich der Lieferkosten (mit Ausnahme der zus&auml;tzlichen Kosten, die sich daraus ergeben, dass Sie eine andere Art der Lieferung als die von uns angebotene, g&uuml;nstigste Standardlieferung gew&auml;hlt haben), unverz&uuml;glich und sp&auml;testens binnen vierzehn Tagen ab dem Tag zur&uuml;ckzuzahlen, an dem die Mitteilung &uuml;ber Ihren Widerruf dieses Vertrags bei uns eingegangen ist. F&uuml;r diese R&uuml;ckzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der urspr&uuml;nglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdr&uuml;cklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser R&uuml;ckzahlung Entgelte berechnet. Wir k&ouml;nnen die R&uuml;ckzahlung verweigern, bis wir die Waren wieder zur&uuml;ckerhalten haben oder bis Sie den Nachweis erbracht haben, dass Sie die Waren zur&uuml;ckgesandt haben, je nachdem, welches der fr&uuml;here Zeitpunkt ist.
 Sie haben die Waren unverz&uuml;glich und in jedem Fall sp&auml;testens binnen vierzehn Tagen ab dem Tag, an dem Sie uns &uuml;ber den Widerruf dieses Vertrags unterrichten, an uns zur&uuml;ckzusenden oder zu &uuml;bergeben. Die Frist ist gewahrt, wenn Sie die Waren vor Ablauf der Frist von vierzehn Tagen absenden.
 Sie tragen die unmittelbaren Kosten der R&uuml;cksendung der Waren.
 Sie m&uuml;ssen f&uuml;r einen etwaigen Wertverlust der Waren nur aufkommen, wenn dieser Wertverlust auf einen zur Pr&uuml;fung der Beschaffenheit, Eigenschaften und Funktionsweise der Waren nicht notwendigen Umgang mit ihnen zur&uuml;ckzuf&uuml;hren ist.
 Muster-Widerrufsformular
 (Wenn Sie den Vertrag widerrufen wollen, dann f&uuml;llen Sie bitte dieses Formular aus und senden Sie es zur&uuml;ck.)
 - Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag &uuml;ber den Kauf der folgenden Waren (*)/die Erbringung der folgenden Dienstleistung (*)
 - Bestellt am (*)/erhalten am (*)
 - Name des/der Verbraucher(s)
 - Anschrift des/der Verbraucher(s)
 - Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)
 - Datum
 (*) Unzutreffendes streichen.',
                        'return_method' => '',
                        'return_period' => [
                            'unit' => 'CALENDAR_DAY',
                            'value' => 30,
                        ],
                    ],
                    'seller' => [
                        'feedback_percentage' => '99.5',
                        'feedback_score' => 10667,
                        'username' => 'top-exclusive',
                        'account_type' => '',
                        'legal_info' => [
                            'email' => '',
                            'fax' => '',
                            'imprint' => '',
                            'legal_contact_first_name' => '',
                            'legal_contact_last_name' => '',
                            'name' => '',
                            'phone' => '',
                            'registration_number' => '',
                            'legal_address' => [
                                'address_line_1' => '',
                                'address_line_2' => '',
                                'city' => '',
                                'country' => '',
                                'country_name' => '',
                                'county' => '',
                                'postal_code' => '',
                                'state_or_province' => '',
                            ],
                            'terms_of_service' => '',
                            'vat_details' => [
                                'issuing_country' => '',
                                'vat_id' => '',
                            ],
                        ],
                    ],
                    'attributes' => [
                        0 => [
                            'name' => 'Farbe',
                            'value' => 'Schwarz & Braun',
                        ],
                        1 => [
                            'name' => 'Glasfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        2 => [
                            'name' => 'Stil',
                            'value' => 'Cat Eye',
                        ],
                        3 => [
                            'name' => 'Gläserhöhe',
                            'value' => '4.3cm',
                        ],
                        4 => [
                            'name' => 'Anlass',
                            'value' => 'party/cocktail',
                        ],
                        5 => [
                            'name' => 'Gläserfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        6 => [
                            'name' => 'Thema',
                            'value' => 'Designer, Retro, Cat',
                        ],
                        7 => [
                            'name' => 'Gestellmaterial',
                            'value' => 'Plastik',
                        ],
                        8 => [
                            'name' => 'Modell',
                            'value' => 'Quadrat',
                        ],
                        9 => [
                            'name' => 'Herstellernummer',
                            'value' => 'S71584163',
                        ],
                        10 => [
                            'name' => 'Rahmenbreite',
                            'value' => '14.5cm',
                        ],
                        11 => [
                            'name' => 'Gestellfarbe',
                            'value' => 'mehrfarbig',
                        ],
                        12 => [
                            'name' => 'Rahmenfarbe',
                            'value' => 'Mehrfarbig',
                        ],
                        13 => [
                            'name' => 'Stegbreite',
                            'value' => '1.5cm',
                        ],
                        14 => [
                            'name' => 'Rahmenmaterial',
                            'value' => 'Plastik',
                        ],
                        15 => [
                            'name' => 'Produktart',
                            'value' => 'Sonnenbrille',
                        ],
                        16 => [
                            'name' => 'Vergrößerung Stärke',
                            'value' => 'Keiner',
                        ],
                        17 => [
                            'name' => 'Abteilung',
                            'value' => 'Damen',
                        ],
                        18 => [
                            'name' => 'Geschlecht',
                            'value' => 'Damen',
                        ],
                        19 => [
                            'name' => 'Gläsermaterial',
                            'value' => 'Polycarbonat',
                        ],
                        20 => [
                            'name' => 'Besonderheiten',
                            'value' => 'Komplettes Gestell',
                        ],
                        21 => [
                            'name' => 'Vintage',
                            'value' => 'Nein',
                        ],
                        22 => [
                            'name' => 'Marke',
                            'value' => 'Pacific Shades',
                        ],
                        23 => [
                            'name' => 'Modifizierte Artikel',
                            'value' => 'Nein',
                        ],
                        24 => [
                            'name' => 'UV Schutz',
                            'value' => 'UV400',
                        ],
                        25 => [
                            'name' => 'UV-Schutz',
                            'value' => 'UV400',
                        ],
                        26 => [
                            'name' => 'Muster',
                            'value' => 'Solid',
                        ],
                        27 => [
                            'name' => 'Charakter',
                            'value' => 'Claire',
                        ],
                        28 => [
                            'name' => 'Gläsertechnologie',
                            'value' => 'Polycarbonat',
                        ],
                    ],
                    'shipping_options' => [
                    ],
                    'ship_to_locations' => [
                        'region_excluded' => [
                            0 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'Africa',
                            ],
                            1 => [
                                'region_type' => 'WORLD_REGION',
                                'region_name' => 'South America',
                            ],
                            2 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Australia',
                            ],
                            3 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Marshall Islands',
                            ],
                            4 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Micronesia',
                            ],
                            5 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nauru',
                            ],
                            6 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Niue',
                            ],
                            7 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Palau',
                            ],
                            8 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Solomon Islands',
                            ],
                            9 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tonga',
                            ],
                            10 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tuvalu',
                            ],
                            11 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vanuatu',
                            ],
                            12 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Wallis and Futuna',
                            ],
                            13 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Brunei Darussalam',
                            ],
                            14 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cambodia',
                            ],
                            15 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Philippines',
                            ],
                            16 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Taiwan',
                            ],
                            17 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Thailand',
                            ],
                            18 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Vietnam',
                            ],
                            19 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mexico',
                            ],
                            20 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Pierre and Miquelon',
                            ],
                            21 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United States',
                            ],
                            22 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Russian Federation',
                            ],
                            23 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Albania',
                            ],
                            24 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Andorra',
                            ],
                            25 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bosnia and Herzegovina',
                            ],
                            26 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Estonia',
                            ],
                            27 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'France',
                            ],
                            28 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'United Kingdom',
                            ],
                            29 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guernsey',
                            ],
                            30 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Italy',
                            ],
                            31 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Croatia, Republic of',
                            ],
                            32 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Latvia',
                            ],
                            33 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lithuania',
                            ],
                            34 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Malta',
                            ],
                            35 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Macedonia',
                            ],
                            36 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Moldova',
                            ],
                            37 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montenegro',
                            ],
                            38 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Poland',
                            ],
                            39 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Romania',
                            ],
                            40 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'San Marino',
                            ],
                            41 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Serbia',
                            ],
                            42 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovakia',
                            ],
                            43 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Slovenia',
                            ],
                            44 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Spain',
                            ],
                            45 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Svalbard and Jan Mayen',
                            ],
                            46 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Ukraine',
                            ],
                            47 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belarus',
                            ],
                            48 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Cyprus',
                            ],
                            49 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Afghanistan',
                            ],
                            50 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Armenia',
                            ],
                            51 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Azerbaijan Republic',
                            ],
                            52 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bangladesh',
                            ],
                            53 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bhutan',
                            ],
                            54 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'China',
                            ],
                            55 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Georgia',
                            ],
                            56 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'India',
                            ],
                            57 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kazakhstan',
                            ],
                            58 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kyrgyzstan',
                            ],
                            59 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Mongolia',
                            ],
                            60 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nepal',
                            ],
                            61 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Pakistan',
                            ],
                            62 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Sri Lanka',
                            ],
                            63 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Korea, South',
                            ],
                            64 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Tajikistan',
                            ],
                            65 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkmenistan',
                            ],
                            66 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Uzbekistan',
                            ],
                            67 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Bahrain',
                            ],
                            68 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Iraq',
                            ],
                            69 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Yemen',
                            ],
                            70 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jordan',
                            ],
                            71 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Qatar',
                            ],
                            72 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Kuwait',
                            ],
                            73 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Lebanon',
                            ],
                            74 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Oman',
                            ],
                            75 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saudi Arabia',
                            ],
                            76 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turkey',
                            ],
                            77 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Anguilla',
                            ],
                            78 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Antigua and Barbuda',
                            ],
                            79 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Belize',
                            ],
                            80 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Costa Rica',
                            ],
                            81 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominica',
                            ],
                            82 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Dominican Republic',
                            ],
                            83 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'El Salvador',
                            ],
                            84 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Grenada',
                            ],
                            85 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guadeloupe',
                            ],
                            86 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Guatemala',
                            ],
                            87 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Haiti',
                            ],
                            88 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Honduras',
                            ],
                            89 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Jamaica',
                            ],
                            90 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Martinique',
                            ],
                            91 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Montserrat',
                            ],
                            92 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Netherlands Antilles',
                            ],
                            93 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Nicaragua',
                            ],
                            94 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Panama',
                            ],
                            95 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Puerto Rico',
                            ],
                            96 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Kitts-Nevis',
                            ],
                            97 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Lucia',
                            ],
                            98 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Saint Vincent and the Grenadines',
                            ],
                            99 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Trinidad and Tobago',
                            ],
                            100 => [
                                'region_type' => 'COUNTRY',
                                'region_name' => 'Turks and Caicos Islands',
                            ],
                        ],
                        'region_included' => [
                            0 => [
                                'region_type' => 'WORLDWIDE',
                                'region_name' => 'Worldwide',
                            ],
                        ],
                    ],
                    'images' => [
                        0 => 'https://i.ebayimg.com/images/g/4JIAAOSwsbhdx07U/s-l1600.jpg',
                        1 => 'https://i.ebayimg.com/images/g/L2cAAOSwyA1dxoKT/s-l1600.jpg',
                        2 => 'https://i.ebayimg.com/images/g/aR4AAOSw8SddxoJ2/s-l1600.jpg',
                        3 => 'https://i.ebayimg.com/images/g/JloAAOSw14ZdxoKL/s-l1600.jpg',
                        4 => 'https://i.ebayimg.com/images/g/JlIAAOSw14ZdxoKA/s-l1600.jpg',
                        5 => 'https://i.ebayimg.com/images/g/ykcAAOSwxctdxoKp/s-l1600.jpg',
                        6 => 'https://i.ebayimg.com/images/g/7e4AAOSwngJdx07c/s-l1600.jpg',
                        7 => 'https://i.ebayimg.com/images/g/ZiMAAOSwmxVdx07g/s-l1600.jpg',
                        8 => 'https://i.ebayimg.com/images/g/TjIAAOSw8V9dx07i/s-l1600.jpg',
                    ],
                    'enabled_for_guest_checkout' => false,
                    'eligible_for_inline_checkout' => true,
                ],
            ],
            'energy_efficiency_class' => '',
            'productFicheWebUrl' => '',
            'category_id' => '45246',
            'category_path' => 'Kleidung & Accessoires|Damen|Damen-Accessoires|Sonnenbrillen & Zubehör|Sonnenbrillen',
            'delivery_duration_de' => NULL,
            'images' => [
                0 => 'https://i.ebayimg.com/images/g/gV4AAOSwrxpdxoIZ/s-l1600.jpg',
                1 => 'https://i.ebayimg.com/images/g/LNkAAOSwVR9dxoID/s-l1600.jpg',
                2 => 'https://i.ebayimg.com/images/g/lzgAAOSwPCFdxoIw/s-l1600.jpg',
                3 => 'https://i.ebayimg.com/images/g/8SAAAOSw1LJdxoIj/s-l1600.jpg',
            ],
            'configurable_attributes' => [
                'Farbe' => [
                    0 => 'Schwarz',
                    1 => 'BRAUN LANDSCHILDKRÖTE',
                    2 => 'Schwarz & Braun',
                ],
            ],
        ];
        return $product;
    }

}

