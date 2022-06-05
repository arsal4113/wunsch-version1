<?php
use Phinx\Migration\AbstractMigration;

class EbaySiteDefaults extends AbstractMigration
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
        $this->execute("INSERT INTO `ebay_sites` (`id`, `name`, `language`, `ebay_site_id`, `ebay_global_id`, `is_active`, `created`, `modified`) VALUES
                        (NULL, 'eBay Austria', 'de-AT', '16', 'EBAY-AT', 1, NOW(), NOW()),
                        (NULL, 'eBay Australia', 'en-AU', '15', 'EBAY-AU', 1, NOW(), NOW()),
                        (NULL, 'eBay Switzerland', 'de-CH', '193', 'EBAY-CH', 1, NOW(), NOW()),
                        (NULL, 'eBay Germany', 'en-DE', '77', 'EBAY-DE', 1, NOW(), NOW()),
                        (NULL, 'eBay Canada (English)', 'en-CA', '2', 'EBAY-ENCA', 1, NOW(), NOW()),
                        (NULL, 'eBay Spain', 'es-ES', '186', 'EBAY-ES', 1, NOW(), NOW()),
                        (NULL, 'eBay France', 'fr-FR', '71', 'EBAY-FR', 1, NOW(), NOW()),
                        (NULL, 'eBay Belgium (French)', 'fr-BE', '23', 'EBAY-FRBE', 1, NOW(), NOW()),
                        (NULL, 'eBay Canada (French)', 'fr-CA', '210', 'EBAY-FRCA', 1, NOW(), NOW()),
                        (NULL, 'eBay UK', 'en-GB', '3', 'EBAY-GB', 1, NOW(), NOW()),
                        (NULL, 'eBay Hong Kong', 'zh-Hant', '201', 'EBAY-HK', 1, NOW(), NOW()),
                        (NULL, 'eBay Ireland', 'en-IE', '205', 'EBAY-IE', 1, NOW(), NOW()),
                        (NULL, 'eBay India', 'en-IN', '203', 'EBAY-IN', 1, NOW(), NOW()),
                        (NULL, 'eBay Italy', 'it-IT', '101', 'EBAY-IT', 1, NOW(), NOW()),
                        (NULL, 'eBay Motors', 'en-US', '100', 'EBAY-MOTOR', 1, NOW(), NOW()),
                        (NULL, 'eBay Malaysia', 'en-MY', '207', 'EBAY-MY', 1, NOW(), NOW()),
                        (NULL, 'eBay Netherlands', 'nl-NL', '146', 'EBAY-NL', 1, NOW(), NOW()),
                        (NULL, 'eBay Belgium (Dutch)', 'nl-BE', '123', 'EBAY-NLBE', 1, NOW(), NOW()),
                        (NULL, 'eBay Philippines', 'en-PH', '211', 'EBAY-PH', 1, NOW(), NOW()),
                        (NULL, 'eBay Poland', 'pl-PL', '212', 'EBAY-PL', 1, NOW(), NOW()),
                        (NULL, 'eBay Singapore', 'en-SG', '216', 'EBAY-SG', 1, NOW(), NOW()),
                        (NULL, 'eBay United States', 'en-US', '0', 'EBAY-US', 1, NOW(), NOW())
                        ;");
    }
}
