<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class AddNewCustomPageTypes extends AbstractMigration
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
        $this->table('ebay_custom_page_types')
            ->renameColumn('order', 'sort_order')
            ->save();

        $now = date('Y-m-d H:i:s');
        $types = [
            [
                'code' => 'agb',
                'name' => 'AGB',
                'sort_order' => 1,
                'left_navbar' => 0,
                'preview_enabled' => 0,
                'url_path' => 'agb',
                'created' => $now,
                'modified' => $now
            ],
            [
                'code' => 'impressum',
                'name' => 'Impressum',
                'sort_order' => '2',
                'left_navbar' => 0,
                'preview_enabled' => 0,
                'url_path' => 'impressum',
                'created' => $now,
                'modified' => $now
            ],
            [
                'code' => 'kontakt',
                'name' => 'Kontakt',
                'sort_order' => 3,
                'left_navbar' => 0,
                'preview_enabled' => 0,
                'url_path' => 'kontakt',
                'created' => $now,
                'modified' => $now
            ],
            [
                'code' => 'widerruf',
                'name' => 'Widerruf',
                'sort_order' => 4,
                'left_navbar' => 0,
                'preview_enabled' => 0,
                'url_path' => 'widerruf',
                'created' => $now,
                'modified' => $now
            ],
            [
                'code' => 'rueckgabe',
                'name' => 'Rückgabe',
                'sort_order' => 5,
                'left_navbar' => 0,
                'preview_enabled' => 0,
                'url_path' => 'rueckgabe',
                'created' => $now,
                'modified' => $now
            ]
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
