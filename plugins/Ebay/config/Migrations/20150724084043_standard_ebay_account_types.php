<?php

use Phinx\Migration\AbstractMigration;

class StandardEbayAccountTypes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $this->execute("ALTER TABLE `ebay_account_types` ADD INDEX(`type`);");
        $this->execute("ALTER TABLE `ebay_account_types` ADD INDEX(`is_active`);");
        
        $this->execute("
            INSERT INTO `ebay_account_types` (`id`, `name`, `type`, `login_url`, `is_active`, `created`, `modified`) VALUES
            (NULL, 'eBay Sandbox', 'sandbox', 'https://signin.sandbox.ebay.com/ws/eBayISAPI.dll?SignIn&RuName={RuName}&SessID={SessionID}',1, NOW(), NOW()),
            (NULL, 'eBay Live', 'live', 'https://signin.ebay.com/ws/eBayISAPI.dll?SignIn&RuName={RuName}&SessID={SessionID}', 1, NOW(), NOW());
        ");
    }
}
