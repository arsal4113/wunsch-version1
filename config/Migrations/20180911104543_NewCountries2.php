<?php

use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class NewCountries2 extends AbstractMigration
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
        $countries = [
            [
                'iso_code' => 'MO',
                'name' => 'Macau',
                'default_tax' => 0
            ],
            [
                'iso_code' => 'TW',
                'name' => 'Taiwan',
                'default_tax' => 0
            ],
            [
                'iso_code' => 'GB',
                'name' => 'United Kingdom',
                'default_tax' => 0
            ]
        ];

        $coreCountriesTable = TableRegistry::getTableLocator()->get('CoreCountries');
        foreach ($countries as $country) {
            $coreCountry = $coreCountriesTable->newEntity($country);
            if (!$coreCountriesTable->find()->where(['iso_code' => $coreCountry->iso_code])->first()) {
                $coreCountriesTable->save($coreCountry);
            }
        }
    }
}
