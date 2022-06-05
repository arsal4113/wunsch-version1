<?php
use Migrations\AbstractMigration;

class AddNewMarketplaces extends AbstractMigration
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
        //UK
        $marketplaces = [
            'ebay-uk' => [
                'code' => 'ebay-uk',
                'name' => 'eBay UK'
            ],
            'ebay-fr' => [
                'code' => 'ebay-fr',
                'name' => 'eBay FR'
            ],
            'ebay-it' => [
                'code' => 'ebay-it',
                'name' => 'eBay IT'
            ],
            'ebay-es' => [
                'code' => 'ebay-es',
                'name' => 'eBay ES'
            ],
        ];

        $insertData = [];
        $marketplaceGroup = $this->fetchRow('SELECT id FROM core_marketplace_groups WHERE code LIKE "ebay"');
        if (isset($marketplaceGroup['id']) && is_numeric($marketplaceGroup['id'])) {
            foreach ($marketplaces as $code => $data) {
                $check = $this->fetchRow('SELECT id FROM core_marketplaces WHERE code LIKE "$code"');
                if (!isset($check['id']) || empty($check['id'])) {
                    $insertData[] = [
                        'core_marketplace_group_id' => $marketplaceGroup['id'],
                        'code' => $data['code'],
                        'name' => $data['name'],
                        'is_default' => 0,
                        'is_active' => 1,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ];
                }
            }
        }
        if (!empty($insertData)) {
            $this->insert('core_marketplaces', $insertData);
        }
    }
}
