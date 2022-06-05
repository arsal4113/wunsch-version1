<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class AddCurrency extends AbstractMigration
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
        $ebaySitesModel = TableRegistry::get('Ebay.EbaySites');
        $coreCurrencies = TableRegistry::get('CoreCurrencies');

        $mapping = [
            'AT' => 'EUR', 'AU' => 'AUD',
            'CH' => 'CHF', 'DE' => 'EUR',
            'CA' => 'CAD', 'ES' => 'EUR',
            'FR' => 'EUR', 'IT' => 'EUR',
            'BE' => 'EUR', 'GB' => 'GBP',
            'HK' => 'HKD', 'IE' => 'EUR',
            'IN' => 'INR', 'OR' => 'USD',
            'MY' => 'MYR', 'NL' => 'EUR',
            'PH' => 'PHP', 'PL' => 'PLN',
            'SG' => 'SGD', 'US' => 'USD'
        ];

        $ebaySites = $ebaySitesModel->find();
        
        foreach ($ebaySites as $ebaySite) {
            $currencyCode = $mapping[substr($ebaySite->ebay_global_id, -2)];                //Get that currency's ISO code from mapping
            $currency = $coreCurrencies->find()->where(['code' => $currencyCode])->first(); //using that ISO code get the currencyID from 'coreCurrencies' table
            if($currency) {                                                                 //if got some
                $ebaySite->core_currency_id = $currency->id;                                //record it
                $ebaySitesModel->save($ebaySite);                                           //to the table 'ebay_sites'
            }
        }
    }
}