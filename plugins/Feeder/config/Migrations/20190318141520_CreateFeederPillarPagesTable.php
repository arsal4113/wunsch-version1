<?php
use Migrations\AbstractMigration;

class CreateFeederPillarPagesTable extends AbstractMigration
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
        $this->table('feeder_pillar_pages')
            ->addColumn('title_tag', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('meta_tag', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('robots_tag', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('first_block_image', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('first_block_title', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('first_block_text', 'text', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('first_block_cta_text', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('first_block_cta_link', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('second_block_image', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('second_block_title', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('second_block_text', 'text', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('second_block_cta_text', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('second_block_cta_link', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('third_block_image', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('third_block_text', 'text', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('third_block_follow_color', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('fourth_block_title', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('fourth_block_text', 'text', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('fourth_block_cta_text', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('fourth_block_cta_link', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('fifth_block_title', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('fifth_block_text', 'text', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('fifth_block_cta_text', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('fifth_block_cta_link', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->create();
    }
}
