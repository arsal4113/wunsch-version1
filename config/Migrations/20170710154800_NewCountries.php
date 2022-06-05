<?php
use Migrations\AbstractMigration;

class NewCountries extends AbstractMigration
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
        $data = [
            [
                'iso_code' => 'BG',
                'name' => 'Bulgaria',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'CN',
                'name' => 'China',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'HR',
                'name' => 'Croatia',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'CY',
                'name' => 'Republic of Cyprus',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'CZ',
                'name' => 'Czech Republic',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'DK',
                'name' => 'Denmark',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'EE',
                'name' => 'Estonia',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'FI',
                'name' => 'Finland',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'GE',
                'name' => 'Georgia',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'GR',
                'name' => 'Greece',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'HU',
                'name' => 'Hungary',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'LV',
                'name' => 'Latvia',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'LT',
                'name' => 'Lithuania',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'LU',
                'name' => 'Luxembourg',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'MA',
                'name' => 'Morocco',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'PK',
                'name' => 'Pakistan',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'PT',
                'name' => 'Portugal',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'RO',
                'name' => 'Romania',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'SK',
                'name' => 'Slovakia',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'SI',
                'name' => 'Slovenia',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'SE',
                'name' => 'Sweden',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'TH',
                'name' => 'Thailand',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'IS',
                'name' => 'Iceland',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'LI',
                'name' => 'Liechtenstein',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'NO',
                'name' => 'Norway',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'JP',
                'name' => 'Japan',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'TR',
                'name' => 'Turkey',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ]
        ];

        $this->insert('core_countries', $data);
    }
}
