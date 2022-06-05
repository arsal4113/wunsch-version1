<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;


class NewEbayCoreMarketplaces extends AbstractMigration
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
        $ebaySiteModel = TableRegistry::get('Ebay.EbaySites');
        $coreMarketplace = TableRegistry::get('CoreMarketplaces');

        //исключаем америку из поиска по базе данных, тк она уже там присутствует
        //exclude United States from our selection from database, because it was already there
        $ebaySites = $ebaySiteModel->find()->where(['ebay_global_id' => 'EBAY-US']);

        foreach ($ebaySites as $ebaySite) {
            if (empty($coreMarketplace->find('all')->where(['name' => $ebaySite->name])->first())) {
                $newCoreMarketPlace = $coreMarketplace->newEntity();
                $newCoreMarketPlace->core_marketplace_group_id = 1;
                $newCoreMarketPlace->code = strtolower($ebaySite->ebay_global_id);
                $newCoreMarketPlace->name = strtolower($ebaySite->name);
                $newCoreMarketPlace->is_default = 0;
                $newCoreMarketPlace->is_active = 1;
                $result = $coreMarketplace->save($newCoreMarketPlace);
                $ebaySite->core_marketplace_id = $result->id;
                $ebaySiteModel->save($ebaySite);
            }
        }
    }
}