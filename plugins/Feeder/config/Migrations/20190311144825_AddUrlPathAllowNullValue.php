<?php
use Migrations\AbstractMigration;

class AddUrlPathAllowNullValue extends AbstractMigration
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
        $table = $this->table('feeder_categories');

        if ($table->hasColumn('url_path')) {
            $table->changeColumn('url_path', 'string', ['null' => true, 'limit' => 1024, 'after' => 'name'])->update();
        }

        if ($table->hasColumn('headline')) {
            $table->changeColumn('headline', 'string', ['null' => true, 'limit' => 1024, 'after' => 'url_path'])->update();
        }
    }
}
