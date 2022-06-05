<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class NewEbayMarketplaces extends AbstractMigration
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
        $coreMarketplaceGroup = $this->fetchRow('SELECT id FROM core_marketplace_groups WHERE code = "ebay"');

        if (isset($coreMarketplaceGroup['id'])) {
            $coreMarketplacesTable = TableRegistry::get('CoreMarketplaces');
            $ebaySitesTable = TableRegistry::get('Ebay.EbaySites');
            $coreCountriesTable = TableRegistry::get('CoreCountries');
            $coreConfigurationsTable = TableRegistry::get('CoreConfigurations');

            $marketplaces = [
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-enca',
                    'name' => 'eBay Canada (English)',
                    'ebay_global_id' => 'EBAY-ENCA',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-frbe',
                    'name' => 'eBay Belgium (French)',
                    'ebay_global_id' => 'EBAY-FRBE',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-nlbt',
                    'name' => 'eBay Belgium (Dutch)',
                    'ebay_global_id' => 'EBAY-NLBE',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-nl',
                    'name' => 'eBay Netherlands',
                    'ebay_global_id' => 'EBAY-NL',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-ch',
                    'name' => 'eBay Switzerland',
                    'ebay_global_id' => 'EBAY-CH',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-ie',
                    'name' => 'eBay Ireland',
                    'ebay_global_id' => 'EBAY-IE',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-frca',
                    'name' => 'eBay Canada (French)',
                    'ebay_global_id' => 'EBAY-FRCA',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-pl',
                    'name' => 'eBay Poland',
                    'ebay_global_id' => 'EBAY-PL',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ]
            ];

            foreach ($marketplaces as $marketplace) {
                $marketplaceEntity = $coreMarketplacesTable->find()->where(['code' => $marketplace['code']])->first();
                if (empty($marketplaceEntity)) {
                    $marketplaceEntity = $coreMarketplacesTable->newEntity($marketplace);
                    $coreMarketplacesTable->save($marketplaceEntity);
                }
                if (isset($marketplaceEntity->id) && is_numeric($marketplaceEntity->id)) {
                    $ebaySite = $ebaySitesTable->find()
                        ->where([
                            'ebay_global_id' => $marketplace['ebay_global_id']
                        ])
                        ->first();
                    if (!empty($ebaySite)) {
                        $ebaySite->core_marketplace_id = $marketplaceEntity->id;
                        $ebaySitesTable->save($ebaySite);
                    }
                }
            }

            $this->table('core_countries')
                ->changeColumn('iso_code', 'string', ['limit' => 4, 'after' => 'id'])
                ->save();

            $countries = [
                [
                    'iso_code' => 'ENCA',
                    'name' => 'Canada (English)',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-ENCA',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'FRBE',
                    'name' => 'Belgium (French)',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-FRBE',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'NLBE',
                    'name' => 'Belgium (Dutch)',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-NLBE',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'NL',
                    'name' => 'Netherlands',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-NL',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'CH',
                    'name' => 'Switzerland',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-CH',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'IE',
                    'name' => 'Ireland',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-IE',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'FRCA',
                    'name' => 'Canada (French)',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-FRCA',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'PL',
                    'name' => 'Poland',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-PL',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ]
            ];

            foreach ($countries as $country) {
                $countryEntity = $coreCountriesTable->find()
                    ->where([
                        'iso_code' => $country['iso_code']
                    ])
                    ->first();
                if (empty($countryEntity)) {
                    $countryEntity = $coreCountriesTable->newEntity($country);
                    $coreCountriesTable->save($countryEntity);
                }

                if (!empty($countryEntity)) {
                    $configurationPath = 'EbayAccount/CountryCode' . $countryEntity->iso_code . '/ebay_site_id';
                    $checkConfig = $coreConfigurationsTable->find()
                        ->where([
                            'configuration_group' => 'EbayFashion',
                            'configuration_path' => $configurationPath
                        ])
                        ->first();

                    if (empty($checkConfig)) {
                        $ebaySite = $ebaySitesTable->find()
                            ->where([
                                'ebay_global_id' => $country['ebay_global_id']
                            ])
                            ->first();
                        if (!empty($ebaySite)) {
                            $newConfig = $coreConfigurationsTable->newEntity([
                                'configuration_group' => 'EbayFashion',
                                'configuration_path' => $configurationPath,
                                'configuration_value' => $ebaySite->id
                            ]);
                        }
                        $coreConfigurationsTable->save($newConfig);
                    }
                }
            }
        }
    }
}
