<?php
use Migrations\AbstractMigration;

class AddEffectUploadToFeederGuides extends AbstractMigration
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
        if(!$table->hasColumn('animation_image')){
            $table->addColumn('animation_image', 'string', ['limit' => 510, 'null' => true, 'after' => 'display_animation']);
        }
        $table->update();
    }
}
