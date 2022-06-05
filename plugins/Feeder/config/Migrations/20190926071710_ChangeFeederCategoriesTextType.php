<?php

use Feeder\Model\Table\FeederCategoriesTable;
use Migrations\AbstractMigration;

/**
 * Class ChangeFeederCategoriesTextType
 */
class ChangeFeederCategoriesTextType extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $this->table('feeder_categories')
            ->changeColumn('category_type', 'string', ['limit' => 25,'null' => true, 'default' => FeederCategoriesTable::CATEGORY_TYPE_ARTICLE_IDS, 'after' => 'name'])
            ->changeColumn('template_type', 'string', ['limit' => 25, 'null' => true, 'default' => FeederCategoriesTable::TEMPLATE_TYPE_A, 'after' => 'category_type'])
            ->update();
    }
}
