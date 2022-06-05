<?php
use Migrations\AbstractMigration;

class AddLevelValuesFeederCategoires extends AbstractMigration
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
        $feederCategoriesTable = \Cake\ORM\TableRegistry::get('Feeder.FeederCategories');
        $feederCategoriesTable->recover();
    }
}
