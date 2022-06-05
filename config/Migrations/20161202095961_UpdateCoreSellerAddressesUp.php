<?php
use Migrations\AbstractMigration;

class UpdateCoreSellerAddressesUp extends AbstractMigration
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
        $ids = $this->fetchAll('SELECT csa.id FROM core_seller_addresses csa left join core_sellers cs on (cs.id = csa.core_seller_id) WHERE cs.id is null');

        $idsToDelete = [];
        foreach ($ids as $id) {
            $idsToDelete[] = $id['id'];
        }
        if(!empty($idsToDelete)) {
            $this->execute('DELETE FROM core_seller_addresses WHERE core_seller_addresses.id IN (' . implode(",", $idsToDelete) . ')');
        }
        $this->table('core_seller_addresses')
            ->changeColumn('core_seller_id', 'integer', ['limit' => 10, 'after' => 'id'])
            ->changeColumn('street_number', 'string', ['limit' => 100, 'null' => true, 'default' => 'null', 'after' => 'street_name'])
            ->changeColumn('company_name', 'string', ['limit' => 200, 'null' => true, 'default' => 'null', 'after' => 'phone_number'])
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->update();
    }
}