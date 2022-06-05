<?php

use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class FeederCategoriesCoreCountriesFix extends AbstractMigration
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
        $table = $this->table('feeder_categories_core_countries');
        if (!$table->exists()) {
            $table
                ->addColumn('feeder_category_id', 'integer', ['limit' => 10])
                ->addColumn('core_country_id', 'integer', ['limit' => 10])
                ->addForeignKey('feeder_category_id', 'feeder_categories', 'id', ['delete' => 'CASCADE'])
                ->addForeignKey('core_country_id', 'core_countries', 'id', ['delete' => 'CASCADE'])
                ->create();
        }

        $feederCategoriesTable = TableRegistry::getTableLocator()->get('Feeder.FeederCategories');
        $coreCountriesTable = TableRegistry::getTableLocator()->get('CoreCountries');
        $feederCategories = $feederCategoriesTable->find()->contain(['CoreCountries']);

        foreach ($feederCategories as $feederCategory) {
            $feederCategoryCoreCountries = $feederCategory->core_countries ?? [];

            if (isset($feederCategory->country) && !empty($feederCategory->country)) {
                $checkCoreCountry = $coreCountriesTable->find()->where(['iso_code' => trim($feederCategory->country)]);
                if (!empty($checkCoreCountry)) {
                    $linkExists = false;
                    if (!empty($feederCategoryCoreCountries)) {
                        foreach ($feederCategoryCoreCountries as $feederCategoryCoreCountry) {
                            if ($feederCategoryCoreCountry->iso_code == $checkCoreCountry->iso_code) {
                                $linkExists = true;
                                break;
                            }
                        }
                    }
                    if ($linkExists === false) {
                        $feederCategoryCoreCountries[] = $checkCoreCountry;
                    }
                }
            } else {
                $coreCountries = $coreCountriesTable->find();
                foreach ($coreCountries as $coreCountry) {
                    $linkExists = false;
                    if (!empty($feederCategoryCoreCountries)) {
                        foreach ($feederCategoryCoreCountries as $feederCategoryCoreCountry) {
                            if ($feederCategoryCoreCountry->iso_code == $coreCountry->iso_code) {
                                $linkExists = true;
                                break;
                            }
                        }
                    }
                    if ($linkExists === false) {
                        $feederCategoryCoreCountries[] = $coreCountry;
                    }
                }
            }

            if (!empty($feederCategoryCoreCountries)) {
                $feederCategory->core_countries = $feederCategoryCoreCountries;
                $feederCategoriesTable->save($feederCategory);
            }
        }
        /*$table = $this->table('feeder_categories');
        if ($table->hasColumn('country')) {
            $table
                ->removeColumn('country')
                ->update();
        }*/
    }
}
