<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class NewEbayCoreCurrencies extends AbstractMigration
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
        $currencies = [                                                             //mapping with all inf about currencies
            ['name' => 'Australian dollar',  'code' => 'AUD',   'symbol' => '$'],
            ['name' => 'Canadian dollar',    'code' => 'CAD',   'symbol' => '$'],
            ['name' => 'Hong Kong dollar',   'code' => 'HKD',   'symbol' => '$'],
            ['name' => 'Singapore dollar',   'code' => 'SGD',   'symbol' => '$'],
            ['name' => 'US dollar',          'code' => 'USD',   'symbol' => '$'],
            ['name' => 'Malaysian ringgit',  'code' => 'MYR',   'symbol' => 'RM'],
            ['name' => 'Indian rupee',       'code' => 'INR',   'symbol' => '₹'],
            ['name' => 'Philippine peso',    'code' => 'PHP',   'symbol' => '₱'],
            ['name' => 'Polish złoty',       'code' => 'PLN',   'symbol' => 'zł'],
            ['name' => 'Swiss franc',        'code' => 'CHF',   'symbol' => 'Fr.'],
            ['name' => 'UK pound',           'code' => 'GBP',   'symbol' => '£']
        ];
        
        $coreCurrencies = TableRegistry::get('CoreCurrencies');                             //getting the table model from core_currencies
        foreach ($currencies as $currency) {
            if(!$coreCurrencies->find()->where(['code' => $currency['code']])->first()) {   //if there's no matches to existing data
                $coreCurrency = $coreCurrencies->newEntity();                               //creating a new row
                $coreCurrency->name = $currency['name'];                                    //get all inf
                $coreCurrency->code = $currency['code'];                                    //from mapping
                $coreCurrency->symbol = $currency['symbol'];                                //for the new row
                $coreCurrencies->save($coreCurrency);                                       //recording all that to DB
            }
        }
    }
}