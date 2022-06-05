<?php
use Migrations\AbstractMigration;

class AddKindSelectorForFizzyBubble extends AbstractMigration
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
        if(!$table->hasColumn('use_on')){
            $table->addColumn('use_on', 'string', [
                'default' => 'BOTH',
                'null' => false,
                'limit' => 510,
                'after' => 'active'
            ]);
        }
        $table->update();
    }
}
