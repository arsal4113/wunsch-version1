<?php
use Migrations\AbstractMigration;

class AddButtonTextToFeederWorlds extends AbstractMigration
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
        $table = $this->table('feeder_worlds');
        if(!$table->hasColumn('button_text')){
            $table->addColumn('button_text', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
                'after' => 'link'
            ]);
        }
        $table->update();
    }
}
