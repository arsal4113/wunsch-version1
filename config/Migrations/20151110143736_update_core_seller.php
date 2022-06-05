<?php
use Migrations\AbstractMigration;

class UpdateCoreSeller extends AbstractMigration
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
        $this->table('core_countries')
            ->addColumn('default_tax', 'decimal', ['precision' => 4, 'scale' => 2, 'default' => 0, 'after' => 'name'])
            ->update();

        $this->execute('UPDATE core_countries SET default_tax = 19 WHERE iso_code = "DE"');

        $de = $this->fetchRow('SELECT id FROM `core_countries` WHERE `iso_code` = "DE"');

        if (empty($de)) {
            $this->execute("
	   		    INSERT INTO `core_countries` (`id`, `iso_code`, `name`, `default_tax`, `created`, `modified`) VALUES
	   		      (NULL, 'DE', 'Deutschland', 19, NOW(), NOW());
	   	    ");
        }
        $this->table('core_sellers')
            ->addColumn('core_country_id', 'integer', ['limit' => 10, 'after' => 'core_language_id'])
            ->addIndex(['core_country_id'])
            ->update();
    }
}
