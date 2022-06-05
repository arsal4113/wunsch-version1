<?php

use Phinx\Migration\AbstractMigration;

class AddNewCoreCountries extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $esp = $this->fetchRow('Select id FROM `core_countries` WHERE iso_code = "es"');
        if(empty($es)) {
            $this->execute("
	   		    INSERT INTO `core_countries` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'ES', 'Español', NOW(), NOW());
	   	        ");
        }

        $ita = $this->fetchRow('Select id FROM `core_countries` WHERE iso_code = "it"');
        if(empty($it)) {
            $this->execute("
	   		    INSERT INTO `core_countries` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'IT', 'Italiano', NOW(), NOW());
	   	        ");
        }

        $fra = $this->fetchRow('Select id FROM `core_countries` WHERE iso_code = "fr"');
        if(empty($fr)) {
            $this->execute("
	   		    INSERT INTO `core_countries` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'FR', 'Français', NOW(), NOW());
	   	        ");
        }
    }
}
