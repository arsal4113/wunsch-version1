<?php
use Migrations\AbstractMigration;

class EditHelpDeskTable extends AbstractMigration
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
        $table = $this->table('help_desk_faqs');
        $table->changeColumn('help_desk_category_id', 'integer', [
            'default' => null,
            'limit' => '11',
            'null' => true,
        ])
            ->addForeignKey('help_desk_category_id', 'help_desk_categories', 'id', ['delete'=> 'NO ACTION', 'update'=> 'NO ACTION'])
            ->update();
    }
}
