<?php
use Migrations\AbstractMigration;

class AddOptionalUrlHeadersToFeederGuides extends AbstractMigration
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

        $table->addColumn('optional_url_headers', 'string', ['null' => true, 'default' => null, 'limit' => 512]);
        $table->addColumn('optional_url_image', 'string', ['null' => true, 'default' => null, 'limit' => 256]);

        $table->update();
    }
}
