<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class EbayMarketplaces extends AbstractMigration
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
                    'code' => 'ebay-us',
                    'name' => 'eBay USA',
                    'ebay_global_id' => 'EBAY-US',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-au',
                    'name' => 'eBay Australia',
                    'ebay_global_id' => 'EBAY-AU',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-at',
                    'name' => 'eBay Austria',
                    'ebay_global_id' => 'EBAY-AT',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-hk',
                    'name' => 'eBay Hong Kong',
                    'ebay_global_id' => 'EBAY-HK',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-in',
                    'name' => 'eBay India',
                    'ebay_global_id' => 'EBAY-IN',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-ph',
                    'name' => 'eBay Philippines',
                    'ebay_global_id' => 'EBAY-PH',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-my',
                    'name' => 'eBay Malaysia',
                    'ebay_global_id' => 'EBAY-MY',
                    'is_default' => 0,
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'core_marketplace_group_id' => $coreMarketplaceGroup['id'],
                    'code' => 'ebay-sg',
                    'name' => 'eBay Singapore',
                    'ebay_global_id' => 'EBAY-SG',
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

            $countries = [
                [
                    'iso_code' => 'US',
                    'name' => 'USA',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-US',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'AU',
                    'name' => 'Australia',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-AU',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'AT',
                    'name' => 'Österreich',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-AT',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'HK',
                    'name' => 'Hong Kong',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-HK',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'IN',
                    'name' => 'India',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-IN',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'PH',
                    'name' => 'Philippines',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-PH',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'MY',
                    'name' => 'Malaysia',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-MY',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'iso_code' => 'SG',
                    'name' => 'Singapore',
                    'default_tax' => 0,
                    'ebay_global_id' => 'EBAY-SG',
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
