<?php
use Migrations\AbstractMigration;

class FixFeederGuidesTable extends AbstractMigration
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
        $table = $this->table('feeder_guides');
        if($table->hasColumn('meta_tag')){
            $table->removeColumn('meta_tag');
        }
        if(!$table->hasColumn('meta_title')){
            $table->addColumn('meta_title', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
                'after' => 'url'
            ]);
        }
        if(!$table->hasColumn('meta_description')){
            $table->addColumn('meta_description', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
                'after' => 'meta_title'
            ]);
        }
        if(!$table->hasColumn('robots_tag')){
            $table->addColumn('robots_tag', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
                'after' => 'meta_title'
            ]);
        }
        $table->update();
    }
}
