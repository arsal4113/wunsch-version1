<?php
use Migrations\AbstractMigration;

class AddDesignTogglesToFeederGuides extends AbstractMigration
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
        if(!$table->hasColumn('display_animation')){
            $table->addColumn('display_animation', 'integer', [
                'null' => false,
                'default' => 0,
                'after' => 'description'
            ]);
        }
        if(!$table->hasColumn('background_color')){
            $table->addColumn('background_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
                'after' => 'display_animation'
            ]);
        }
        $table->update();
    }
}
