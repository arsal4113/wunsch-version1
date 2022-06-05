<?php
use Migrations\AbstractMigration;

class AddFormKey extends AbstractMigration
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
        $this->table('ebay_checkout_sessions')
            ->addColumn('form_key', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
                'after' => 'last_name'
            ])
            ->update();
    }
}
