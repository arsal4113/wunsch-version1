<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class NewCustomPagesTypes extends AbstractMigration
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
        $now = date('Y-m-d H:i:s');
        $types = [
            [
                'code' => 'datenschutz',
                'name' => 'Datenschutz',
                'sort_order' => 6,
                'left_navbar' => 0,
                'preview_enabled' => 0,
                'url_path' => 'datenschutz',
                'created' => $now,
                'modified' => $now
            ],
            [
                'code' => 'widerrufsbelehrung',
                'name' => 'Widerrufsbelehrung',
                'sort_order' => 7,
                'left_navbar' => 0,
                'preview_enabled' => 0,
                'url_path' => 'widerrufsbelehrung',
                'created' => $now,
                'modified' => $now
            ],
        ];

        $ebayCustomPageTypesTable = TableRegistry::get('Ebay.EbayCustomPageTypes');

        foreach ($types as $type) {
            $customPageType = $ebayCustomPageTypesTable->find()->where(['code' => $type['code']])->first();
            if (!empty($customPageType)) {
                $customPageType = $ebayCustomPageTypesTable->patchEntity($customPageType, $type);
            } else {
                $customPageType = $ebayCustomPageTypesTable->newEntity($type);

            }
            $ebayCustomPageTypesTable->save($customPageType);
        }
    }
}
