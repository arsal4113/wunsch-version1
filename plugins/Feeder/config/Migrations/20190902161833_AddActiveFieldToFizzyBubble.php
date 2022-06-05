<?php
use Migrations\AbstractMigration;

class AddActiveFieldToFizzyBubble extends AbstractMigration
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
        if(!$table->hasColumn('active')){
            $table->addColumn('active', 'boolean', ['default' => false, 'null' => true, 'after' => 'image_src'])
                ->update();
        }
    }
}
