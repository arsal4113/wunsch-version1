<?php
use Migrations\AbstractMigration;

class AddBackgroundImageUploadToFeederGuides extends AbstractMigration
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
        if(!$table->hasColumn('first_background_image')){
            $table->addColumn('first_background_image', 'string', [
                'null' => true,
                'after' => 'description',
                'limit' => 510
            ]);
        }
        if(!$table->hasColumn('second_background_image')){
            $table->addColumn('second_background_image', 'string', [
                'null' => true,
                'after' => 'first_background_image',
                'limit' => 510
            ]);
        }
        $table->update();
    }
}
