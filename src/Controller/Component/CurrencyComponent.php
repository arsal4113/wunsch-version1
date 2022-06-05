<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Number;

/**
 * Currency component
 */
class CurrencyComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    public function formatCurrency($value, $currencyCode, $options = [])
    {
        if (strtolower($currencyCode) == 'usd') {
            $options['before'] = 'US ';
        }
        return Number::currency($value, $currencyCode, $options);
    }
}
