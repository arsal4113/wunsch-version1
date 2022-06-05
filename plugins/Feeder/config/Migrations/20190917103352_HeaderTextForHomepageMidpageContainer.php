<?php
use Migrations\AbstractMigration;

class HeaderTextForHomepageMidpageContainer extends AbstractMigration
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
        $table = $this->table('feeder_homepage_midpage_containers');

        if ($table->exists()) {
            $table
                ->addColumn('header_text', 'string', ['default' => null, 'limit' => 1024, 'null' => true, 'after' => 'click_url'])
                ->save();
        }
    }
}
