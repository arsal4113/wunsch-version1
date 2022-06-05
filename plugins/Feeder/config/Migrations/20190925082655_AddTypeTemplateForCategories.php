<?php

use Cake\ORM\Locator\TableLocator;
use Cake\ORM\TableRegistry;
use Feeder\Model\Entity\FeederCategory;
use Feeder\Model\Table\FeederCategoriesTable;
use Migrations\AbstractMigration;

class AddTypeTemplateForCategories extends AbstractMigration
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
        $table = $this->table('feeder_categories');

        $feederCategories = TableRegistry::getTableLocator()->get('Feeder.FeederCategories');
        $feederCategories->recover();

        if (!$table->hasColumn('category_type')) {
            $table->addColumn('category_type', 'string', [
                'limit' => 255,
                'default' => FeederCategoriesTable::CATEGORY_TYPE_ARTICLE_IDS,
                'after' => 'name'
            ])
            ->save();

            foreach ($feederCategories->find()->all() as $feederCategory) {
                /** @var FeederCategory $feederCategory */
                if (!empty(trim($feederCategory->item_id))) {
                    $feederCategory->category_type = FeederCategoriesTable::CATEGORY_TYPE_ARTICLE_IDS;
                } else if (!empty(trim($feederCategory->ebay_category_id))) {
                    $feederCategory->category_type = FeederCategoriesTable::CATEGORY_TYPE_EBAY_CATEGORIES;
                } else {
                    $feederCategory->category_type = FeederCategoriesTable::CATEGORY_TYPE_TOP_SELLERS;
                }
                $feederCategories->save($feederCategory);
            }
        }

        if (!$table->hasColumn('template_type')) {
            $table->addColumn('template_type', 'string', [
                'limit' => 255,
                'default' => FeederCategoriesTable::TEMPLATE_TYPE_A,
                'after' => 'category_type'
            ])
            ->save();
        }
    }
}
