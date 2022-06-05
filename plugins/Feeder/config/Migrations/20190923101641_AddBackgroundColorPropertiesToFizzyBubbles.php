<?php
use Migrations\AbstractMigration;

class AddBackgroundColorPropertiesToFizzyBubbles extends AbstractMigration
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
        $table = $this->table('feeder_fizzy_bubbles');
        if(!$table->hasColumn('title_background_color')){
            $table->addColumn('title_background_color', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
                'after' => 'title_color'
            ]);
        }
        if(!$table->hasColumn('subline_background_color')){
            $table->addColumn('subline_background_color', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
                'after' => 'subline_color'
            ]);
        }
        $table->update();
    }
}
