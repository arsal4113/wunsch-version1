<?php
use Migrations\AbstractMigration;

class FeederHomepageBannersTexts extends AbstractMigration
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
        $table = $this->table('feeder_homepage_banners');

        if (!$table->hasColumn('headline')) {
            $table->addColumn('headline', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ]);
        }

        if (!$table->hasColumn('headline_font_color')) {
            $table->addColumn('headline_font_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]);
        }

        if (!$table->hasColumn('caption')) {
            $table->addColumn('caption', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ]);
        }

        if (!$table->hasColumn('caption_font_color')) {
            $table->addColumn('caption_font_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]);
        }

        if (!$table->hasColumn('text_background_color')) {
            $table->addColumn('text_background_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]);
        }
        if (!$table->hasColumn('opacity')) {
            $table->addColumn('opacity', 'integer', [
                'default' => 100,
                'limit' => 100,
                'null' => false,
            ]);
        }

        if (!$table->hasColumn('cta')) {
            $table->addColumn('cta', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ]);
        }

        if (!$table->hasColumn('cta_color')) {
            $table->addColumn('cta_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]);
        }

        if (!$table->hasColumn('loader_color')) {
            $table->addColumn('loader_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]);
        }

        $table->update();
    }
}
