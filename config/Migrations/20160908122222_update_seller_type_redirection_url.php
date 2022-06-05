<?php

use Phinx\Migration\AbstractMigration;

class UpdateSellerTypeRedirectionUrl extends AbstractMigration
{
    public function change()
    {
        $this->execute("
	   		    UPDATE `core_seller_types` SET `redirect_url` = 'i-template/stores/ebayTemplateWizard'
	   		    WHERE `core_seller_types`.`code` = 'free';
	   	        ");
    }
}
