<?php
use Migrations\AbstractMigration;

class BugfixCustomPageTypeStatus extends AbstractMigration
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
        $table = $this->table('ebay_custom_pages');
        $table->changeColumn('status', 'enum', ['values' => ['Active', 'Inactive', 'Delete']])
            ->update();
    }
}
