<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class UpdateBaySites extends AbstractMigration
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
        $table = $this->table('ebay_sites');
        if (!$table->hasColumn('domain')) {
            $table->addColumn('domain', 'string', ['limit' => 100, 'after' => 'ebay_global_id', 'null' => true, 'default' => null])
                ->save();
        }

        $domains = [
            'EBAY-AT' => 'ebay.at',
            'EBAY-AU' => 'ebay.com.au',
            'EBAY-CH' => 'ebay.ch',
            'EBAY-DE' => 'ebay.de',
            'EBAY-ENCA' => 'ebay.ca',
            'EBAY-ES' => 'ebay.es',
            'EBAY-FR' => 'ebay.fr',
            'EBAY-FRBE' => 'befr.ebay.be',
            'EBAY-FRCA' => 'cafr.ebay.ca',
            'EBAY-GB' => 'ebay.co.uk',
            'EBAY-HK' => 'ebay.com.hk',
            'EBAY-IE' => 'ebay.ie',
            'EBAY-IN' => 'ebay.in',
            'EBAY-IT' => 'ebay.it',
            'EBAY-MY' => 'ebay.com.my',
            'EBAY-NL' => 'ebay.nl',
            'EBAY-NLBE' => 'benl.ebay.be',
            'EBAY-PH' => 'ebay.ph',
            'EBAY-PL' => 'ebay.pl',
            'EBAY-SG' => 'ebay.com.sg',
            'EBAY-US' => 'ebay.com'
        ];

        $ebaySitesTable = TableRegistry::get('Ebay.EbaySites');

        foreach ($domains as $ebayGlobalId => $domain) {
            $ebaySite = $ebaySitesTable->find()
                ->where(['ebay_global_id' => $ebayGlobalId])
                ->first();
            if (!empty($ebaySite)) {
                $ebaySite->domain = $domain;
                $ebaySitesTable->save($ebaySite);
            }
        }

        $loginUrls = [
            'sandbox' => 'https://signin.sandbox.{domain}/ws/eBayISAPI.dll?SignIn&RuName={RuName}&SessID={SessionID}',
            'live' => 'https://signin.{domain}/ws/eBayISAPI.dll?SignIn&RuName={RuName}&SessID={SessionID}'
        ];

        $ebayAccountTypesTable = TableRegistry::get('Ebay.EbayAccountTypes');

        foreach ($loginUrls as $accountType => $url) {
            $ebayAccountType = $ebayAccountTypesTable->find()
                ->where(['type' => $accountType])
                ->first();
            if (!empty($ebayAccountType)) {
                $ebayAccountType->login_url = $url;
                $ebayAccountTypesTable->save($ebayAccountType);
            }
        }
    }
}
