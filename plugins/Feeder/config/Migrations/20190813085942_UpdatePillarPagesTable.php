<?php
use Migrations\AbstractMigration;

class UpdatePillarPagesTable extends AbstractMigration
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
        $table = $this->table('feeder_pillar_pages');

        if(!$table->hasColumn('block_configuration')) {
            $table->addColumn('block_configuration', 'text', [
                'null' => true,
                'after' => 'robots_tag',
                'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_MEDIUM,
                'default' => null
            ]);
        }

        $table->update();
    }
}
