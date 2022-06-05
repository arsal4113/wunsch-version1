<?php
use Migrations\AbstractMigration;

class AddCheckoutSessionFacebookUTMParameters extends AbstractMigration
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
            ->addColumn('utm_source', 'string', [
                'default' => null,
                'limit' => 1024,
                'null' => true,
                'after' => 'ebay_epn_campaign_id'
            ])
            ->addColumn('utm_medium', 'string', [
                'default' => null,
                'limit' => 1024,
                'null' => true,
                'after' => 'utm_source'
            ])
            ->addColumn('utm_campaign', 'string', [
                'default' => null,
                'limit' => 1024,
                'null' => true,
                'after' => 'utm_medium'
            ])
            ->addColumn('utm_content', 'string', [
                'default' => null,
                'limit' => 1024,
                'null' => true,
                'after' => 'utm_campaign'
            ])
            ->update();
    }
}
