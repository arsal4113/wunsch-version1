<?php
use Migrations\AbstractMigration;

class UpdateCoreMarketplaces extends AbstractMigration
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
        $this->table('core_marketplaces')
            ->addColumn('core_currency_id', 'integer', ['default' => null, 'limit' => 10, 'null' => false, 'after' => 'name'])
        ->update();

        $row = $this->fetchRow('SELECT id FROM core_currencies WHERE code LIKE "EUR"');

        if(empty($row)) {
            $this->execute("
	   		    INSERT INTO `core_currencies` (`id`, `code`, `symbol`, `name`, `created`, `modified`) VALUES
			      (NULL, 'EUR', '€', 'EUR', NOW(), NOW());
	   	    ");
        }

        $row = $this->fetchRow('SELECT id FROM core_currencies WHERE code LIKE "EUR"');

        $this->execute("
	   	    UPDATE `core_marketplaces` SET core_currency_id = " . $row['id'] . " WHERE code IN ('ebay-de', 'amazon-de');
	   	");
    }
}
