<?php
use Migrations\AbstractMigration;

class AddFeederHomepagesHeadlines extends AbstractMigration
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
        $table = $this->table('feeder_homepages');
        if(!$table->hasColumn('h1')) {
            $table
                ->addColumn('h1', 'text', ['null' => true, 'after' => 'title_tag'])
                ->addColumn('h2', 'text', ['null' => true, 'after' => 'h1'])
                ->update();
        }
    }
}
