<?php
use Migrations\AbstractMigration;

class UpdateFeederPillarPagesWithFacebookMetaTags extends AbstractMigration
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
        $table = $this->hasTable('feeder_pillar_pages');
        if($table) {
            $this->table('feeder_pillar_pages')
                ->addColumn('facebook_og_image', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'robots_tag'])
                ->addColumn('facebook_og_description', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'robots_tag'])
                ->addColumn('facebook_og_title', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'robots_tag'])
                ->addColumn('facebook_og_url', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'robots_tag'])
                ->update();
        }
    }
}
