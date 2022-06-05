<?php
use Migrations\AbstractMigration;

class AddOptionalUrlsToFeederGuides extends AbstractMigration
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

        $table->addColumn('optional_urls', 'string', ['null' => true, 'default' => null, 'limit' => 1024]);

        $table->update();
    }
}
