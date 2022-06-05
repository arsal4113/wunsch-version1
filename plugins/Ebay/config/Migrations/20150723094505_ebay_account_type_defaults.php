<?php
use Phinx\Migration\AbstractMigration;

class EbayAccountTypeDefaults extends AbstractMigration
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
        $this->table('ebay_account_types')
            ->addColumn('login_url', 'string', ['default' => null, 'limit' => 250, 'null' => false, 'after' => 'type'])
            ->update();

        $this->execute("INSERT INTO `ebay_account_types` (`id`, `name`, `type`, `login_url`, `is_active`, `created`, `modified`) VALUES
                        (NULL, 'Sandbox', 'sandbox', 'https://signin.sandbox.ebay.com/ws/eBayISAPI.dll?SignIn&RuName={RuName}&SessID={SessionID}',1, NOW(), NOW()),
                        (NULL, 'Live', 'live', 'https://signin.ebay.com/ws/eBayISAPI.dll?SignIn&RuName={RuName}&SessID={SessionID}',1, NOW(), NOW());
                        ");
    }
}