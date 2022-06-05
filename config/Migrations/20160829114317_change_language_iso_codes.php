<?php

use Phinx\Migration\AbstractMigration;

class ChangeLanguageIsoCodes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        //$de = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "deu"');
            $this->execute("
	   		    UPDATE `core_languages` SET `iso_code` = 'de' WHERE `core_languages`.`iso_code` = 'deu';
	   	        ");

        //$en = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "eng"');
            $this->execute("
	   		    UPDATE `core_languages` SET `iso_code` = 'en' WHERE `core_languages`.`iso_code` = 'eng';
	   	        ");

        //$es = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "esp"');
            $this->execute("
	   		    UPDATE `core_languages` SET `iso_code` = 'es' WHERE `core_languages`.`iso_code` = 'esp';
	   	        ");

        //$it = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "ita"');
            $this->execute("
	   		    UPDATE `core_languages` SET `iso_code` = 'it' WHERE `core_languages`.`iso_code` = 'ita';
	   	        ");

        //$fr = $this->fetchRow('Select id FROM `core_languages` WHERE iso_code = "fra"');
            $this->execute("
	   		    UPDATE `core_languages` SET `iso_code` = 'fr' WHERE `core_languages`.`iso_code` = 'fra';
	   	        ");

        $this->table('core_languages')
            ->changeColumn('iso_code', 'string', ['limit' => 2, 'null' => false])
            ->save();
    }
}
