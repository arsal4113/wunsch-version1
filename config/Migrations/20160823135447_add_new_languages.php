<?php

use Phinx\Migration\AbstractMigration;

class AddNewLanguages extends AbstractMigration
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
        $esp = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "esp"');
        if(empty($esp)) {
            $this->execute("
	   		    INSERT INTO `core_languages` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'esp', 'Español', NOW(), NOW());
	   	        ");
        }

        $ita = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "ita"');
        if(empty($ita)) {
            $this->execute("
	   		    INSERT INTO `core_languages` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'ita', 'Italiano', NOW(), NOW());
	   	        ");
        }

        $fra = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "fra"');
        if(empty($ita)) {
            $this->execute("
	   		    INSERT INTO `core_languages` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'fra', 'Français', NOW(), NOW());
	   	        ");
        }
    }
}
