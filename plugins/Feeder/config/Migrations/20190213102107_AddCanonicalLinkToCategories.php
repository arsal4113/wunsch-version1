<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
class AddCanonicalLinkToCategories extends AbstractMigration
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

        if (!$table->hasColumn('canonical_link_category_id')) {
            $table->addColumn('canonical_link_category_id', 'integer', ['default' => null, 'null' => true, 'after' => 'robot_tag'])
            ->addForeignKey('canonical_link_category_id', 'feeder_categories', 'id', ['delete'=> 'SET_NULL'])
            ->update();
        }
    }
}
