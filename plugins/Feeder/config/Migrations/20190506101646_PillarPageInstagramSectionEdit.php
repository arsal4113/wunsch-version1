<?php
use Migrations\AbstractMigration;

class PillarPageInstagramSectionEdit extends AbstractMigration
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
        $table = $this->table('feeder_pillar_pages');
        if(!$table->hasColumn('instagram_section_text')) {
            $table
                ->addColumn('instagram_section_text', 'text', ['default' => null, 'null' => true, 'after' => 'third_block_image'])
                ->update();
        }
    }
}
