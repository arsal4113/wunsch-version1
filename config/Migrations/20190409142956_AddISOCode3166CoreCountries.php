<?php

use Migrations\AbstractMigration;

class AddISOCode3166CoreCountries extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('core_countries')
            ->addColumn('iso_code_3166_2', 'string', ['limit' => 2, 'null' => true, 'default' => null, 'after' => 'iso_code'])
            ->addIndex(['iso_code_3166_2'])
            ->update();

        $countries = [
            'DE' => 'DE',
            'ES' => 'ES',
            'IT' => 'IT',
            'FR' => 'FR',
            'RU' => 'RU',
            'UA' => 'UA',
            'IL' => 'IL',
            'MT' => 'MT',
            'BG' => 'BG',
            'CN' => 'CN',
            'HR' => 'HR',
            'CY' => 'CY',
            'CZ' => 'CZ',
            'DK' => 'DK',
            'EE' => 'EE',
            'FI' => 'FI',
            'GE' => 'GE',
            'GR' => 'GR',
            'HU' => 'HU',
            'LV' => 'LV',
            'LT' => 'LT',
            'LU' => 'LU',
            'MA' => 'MA',
            'PK' => 'PK',
            'PT' => 'PT',
            'RO' => 'RO',
            'SK' => 'SK',
            'SI' => 'SI',
            'SE' => 'SE',
            'TH' => 'TH',
            'IS' => 'IS',
            'LI' => 'LI',
            'NO' => 'NO',
            'JP' => 'JP',
            'TR' => 'TR',
            'US' => 'US',
            'AU' => 'AU',
            'AT' => 'AT',
            'HK' => 'HK',
            'IN' => 'IN',
            'PH' => 'PH',
            'MY' => 'MY',
            'SG' => 'SG',
            'ENCA' => 'CA',
            'FRBE' => 'BE',
            'NLBE' => 'BE',
            'NL' => 'NL',
            'CH' => 'CH',
            'IE' => 'IE',
            'FRCA' => 'CA',
            'PL' => 'PL',
            'MO' => 'MO',
            'TW' => 'TW',
            'GB' => 'GB'
        ];

        foreach ($countries as $isoCode => $isoCode2) {
            $this->execute('UPDATE core_countries SET iso_code_3166_2 = "' . $isoCode2 . '" WHERE iso_code = "' . $isoCode . '";');
        }
    }
}
