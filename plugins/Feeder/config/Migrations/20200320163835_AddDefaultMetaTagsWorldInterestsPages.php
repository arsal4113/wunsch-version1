<?php

use App\Model\Entity\CoreConfiguration;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Feeder\Controller\FeederInterestsController;
use Feeder\Controller\FeederWorldsController;
use Migrations\AbstractMigration;

class AddDefaultMetaTagsWorldInterestsPages extends AbstractMigration
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
        $worldsMetaTitle = 'Dein Magazin für Trends & Inspirationen | CATCH by eBay';
        $worldsMetaDescription = 'Tauch eine in die Welt der Trends - Entdecke die neuesten Trend-News und Inspirationen rund um Fashion, Tech & Lifestyle ♥ Jetzt auf CATCH by eBay';

        $interestsMetaTitle = 'Meine Welt auf CATCH | Catch by eBay';
        $interestsMetaDescription = 'Entdecke Produkte ganz nach deinem Geschmack | CATCH by eBay ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler ► Jetzt entdecken';

        $uuid = Configure::read('dealsguru.uuid', false);
        $coreSellersTable = TableRegistry::getTableLocator()->get('CoreSellers');
        $coreSeller = $coreSellersTable->find()->where(['uuid' => $uuid])->firstOrFail();

        $coreConfigurationsTable = TableRegistry::getTableLocator()->get('CoreConfigurations');
        $conf = $coreConfigurationsTable->findOrCreate([
            'core_seller_id' => $coreSeller->id,
            'configuration_group' => FeederWorldsController::CONFIG_GROUP,
            'configuration_path' => FeederWorldsController::META_TITLE_CONFIG_PATH,
            'configuration_value' => ''
        ]);
        ($conf->configuration_value = $worldsMetaTitle) && $coreConfigurationsTable->save($conf);

        $conf = $coreConfigurationsTable->findOrCreate([
            'core_seller_id' => $coreSeller->id,
            'configuration_group' => FeederWorldsController::CONFIG_GROUP,
            'configuration_path' => FeederWorldsController::META_DESCRIPTION_CONFIG_PATH,
            'configuration_value' => ''
        ]);
        ($conf->configuration_value = $worldsMetaDescription) && $coreConfigurationsTable->save($conf);

        $conf = $coreConfigurationsTable->findOrCreate([
            'core_seller_id' => $coreSeller->id,
            'configuration_group' => FeederInterestsController::CONFIG_GROUP,
            'configuration_path' => FeederInterestsController::META_TITLE_CONFIG_PATH,
            'configuration_value' => ''
        ]);
        ($conf->configuration_value = $interestsMetaTitle) && $coreConfigurationsTable->save($conf);

        $conf = $coreConfigurationsTable->findOrCreate([
            'core_seller_id' => $coreSeller->id,
            'configuration_group' => FeederInterestsController::CONFIG_GROUP,
            'configuration_path' => FeederInterestsController::META_DESCRIPTION_CONFIG_PATH,
            'configuration_value' => ''
        ]);
        ($conf->configuration_value = $interestsMetaDescription) && $coreConfigurationsTable->save($conf);
    }
}
