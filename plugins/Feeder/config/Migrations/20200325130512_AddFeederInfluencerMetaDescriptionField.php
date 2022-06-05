<?php
use Migrations\AbstractMigration;

class AddFeederInfluencerMetaDescriptionField extends AbstractMigration
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
        $table = $this->table('feeder_influencers');
        if(!$table->hasColumn('meta_description')) {
            $table
                ->addColumn('meta_description', 'string', [
                    'default' => null,
                    'limit' => 1020,
                    'null' => true,
                    'after' => 'title_tag'

                ])
                ->update();
        }
    }
}
