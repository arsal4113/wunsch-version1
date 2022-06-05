<?php
use Migrations\AbstractMigration;

class EbayAccountUseNotification extends AbstractMigration
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
        $table = $this->table('ebay_accounts');
        if (!$table->hasColumn('use_notifications')) {
            $table->addColumn('use_notifications', 'boolean', ['default' => 0, 'null' => true, 'after' => 'token_expiration_time'])
                ->addIndex(['use_notifications'])
                ->save();
        }
    }
}
