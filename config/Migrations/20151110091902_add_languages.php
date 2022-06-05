<?php
use Migrations\AbstractMigration;

class AddLanguages extends AbstractMigration
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
        $deu = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "deu"');
        if(empty($deu)) {
            $this->execute("
	   		    INSERT INTO `core_languages` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'deu', 'Deutsch', NOW(), NOW());
	   	        ");
        }

        $eng = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "eng"');

        if(empty($eng)) {
            $this->execute("
	   		    INSERT INTO `core_languages` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'eng', 'English', NOW(), NOW());
	   	        ");
        }

    }
}
