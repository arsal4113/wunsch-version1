<?php
use Migrations\AbstractMigration;

class AddFizzyBubbleImgAltTag extends AbstractMigration
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
        if(!$table->hasColumn('img_alt_tag')){
            $table->addColumn('img_alt_tag', 'string', [
                'limit' => 200,
                'default' => null,
                'null' => true,
                'after' => 'image_src'
            ]);
        }
        $table->update();
    }
}
