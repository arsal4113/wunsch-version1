<?php

namespace EbayCheckout\View\Helper;

use Cake\I18n\Time;
use Cake\View\Helper;

class EbayCheckoutHelper extends Helper
{
    private $currencyFormats = [
        'USD' => '&dollar;%01.2f',
        'GBP' => '&pound; %01.2f',
        'EUR' => '&euro;%01.2f'
    ];

    public function minMaxDate($minDate, $maxDate)
    {
        if(!$minDate || !$maxDate) {
            return '';
        }

        $min = new Time($minDate);
        $max = new Time($maxDate);

        if ($min->month == $max->month) {
            if($min->day == $max->day){
                return $min->day . '. ' . $min->format('M');
            }
            return $min->day . '.-' . $max->day . '. ' . $min->format('M');
        }
        return $min->day . '. ' . $min->format('M') . ' - ' . $max->day . '. ' . $max->format('M');

    }

    public function formatPrice($price, $currency = 'USD')
    {
        $currency = strtoupper($currency);
        if (isset($this->currencyFormats[$currency])) {
            return sprintf($this->currencyFormats[$currency], $price);
        }
        return $price;
    }

    public function getCountries($onlyCode = null) {
        $countries = [
            'US' => __('USA'),
            'GB' => __('GB'),
            'DE' => __('Germany'),
        ];
        if($onlyCode && isset($countries[strtoupper($onlyCode)])) {
            return [strtoupper($onlyCode) => $countries[strtoupper($onlyCode)]];
        }
        return $countries;
    }


    public function getCountry($code)
    {
        if(isset($this->getCountries()[$code])) {
            return $this->getCountries()[$code];
        }

        return $code;
    }

    public function getTotals()
    {
        return [
            'adjustment' => 'Adjustment',
            'deliveryCost' => 'Shipping Charges',
            'deliveryDiscount' => 'Delivery discount',
            'fee' => 'Import Charges',
            'priceDiscount' => 'Price discount',
            'priceSubtotal' => 'Item ({0})',
            'priceSubtotal_plural' => 'Items ({0})',
            'additionalSavings' => 'Additional savings',
            'tax' => 'Tax',
            'total' => 'Total'
        ];
    }

    public function formatTotalCode($code, $qty = null) {
        if(isset($this->getTotals()[$code])) {
            if($qty > 1 && isset($this->getTotals()[$code . '_plural'])) {
                return __($this->getTotals()[$code . '_plural'], $qty);
            }
            return __($this->getTotals()[$code], $qty);
        }

        return __($code);
    }
}
