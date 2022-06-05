<?php
use Migrations\AbstractMigration;

class AddIndices extends AbstractMigration
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
        $table = $this->table('ebay_checkout_sessions');
        if (!$table->hasIndex(['email'])) {
            $table
                ->addIndex(['email'])
                ->update();
        }

        $table = $this->table('ebay_checkout_session_totals');
        if (!$table->hasIndex(['code'])) {
            $table
                ->addIndex(['code'])
                ->update();
        }
    }
}
