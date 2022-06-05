<?php
use Phinx\Migration\AbstractMigration;

class EbayCredentials extends AbstractMigration
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

        $this->table('ebay_credentials')
            ->addColumn('ru_name', 'string', ['default' => null, 'limit' => 100, 'null' => false, 'after' => 'cert_id'])
            ->update();

        $row = $this->fetchRow('SELECT id FROM `ebay_account_types` WHERE `type`  LIKE "sandbox"');
        if(!empty($row)) {
            $id     = $row['id'];
            $certId = 'R4E685DPA1D$DU5XX771R-5FXJ555J';
            $appId  = 'IWAYSP9BK2C4GZ5JJO11IP8148XLD5';
            $devId  = 'D94DVH116G67LKJ7E23Z2L385X13B9';
            $ruName = 'de.iways-listingsmonitor-2006-06-01-10';

            $this->execute("INSERT INTO `ebay_credentials` (`id`, `ebay_account_type_id`, `key_set_name`, `app_id`, `dev_id`, `cert_id`, `ru_name`, `created`, `modified`) VALUES
                        (NULL, '$id', 'default sandbox set', '$appId', '$devId', '$certId', '$ruName', NOW(), NOW());
                ");
        }

        $row = $this->fetchRow('SELECT id FROM `ebay_account_types` WHERE `type`  LIKE "live"');
        if(!empty($row)) {
            $id     = $row['id'];
            $certId = 'H3J1B965UU4$9648ZFFH5-31I31KC8';
            $appId  = 'IWAYSV28MCC8B4KHL6SOKA9OYHI1Z2';
            $devId  = 'D94DVH116G67LKJ7E23Z2L385X13B9';
            $ruName = 'iways-IWAYSV28MCC8B4K-lqcect';
            $this->execute("INSERT INTO `ebay_credentials` (`id`, `ebay_account_type_id`, `key_set_name`, `app_id`, `dev_id`, `cert_id`, `ru_name`, `created`, `modified`) VALUES
                        (NULL, '$id', 'default production set', '$appId', '$devId', '$certId', '$ruName', NOW(), NOW());
                ");
        }

    }
}
