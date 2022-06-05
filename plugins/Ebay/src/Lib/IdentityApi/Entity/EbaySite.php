<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-12-06
 * Time: 16:58
 */

namespace Ebay\Lib\IdentityApi\Entity;


class EbaySite
{

    private $ebaySites = [
        'EBAY-AT' => [
            'domain' => 'ebay.at',
            'siteId' => 16
        ],
        'EBAY-AU' => [
            'domain' => 'ebay.com.au',
            'siteId' => 15
        ],
        'EBAY-CH' => [
            'domain' => 'ebay.ch',
            'siteId' => 193
        ],
        'EBAY-DE' => [
            'domain' => 'ebay.de',
            'siteId' => 77
        ],
        'EBAY-ENCA' => [
            'domain' => 'ebay.ca',
            'siteId' => 2
        ],
        'EBAY-ES' => [
            'domain' => 'ebay.es',
            'siteId' => 186
        ],
        'EBAY-FR' => [
            'domain' => 'ebay.fr',
            'siteId' => 71
        ],
        'EBAY-FRBE' => [
            'domain' => 'befr.ebay.be',
            'siteId' => 23
        ],
        'EBAY-FRCA' => [
            'domain' => 'cafr.ebay.ca',
            'siteId' => 210
        ],
        'EBAY-GB' => [
            'domain' => 'ebay.co.uk',
            'siteId' => 3
        ],
        'EBAY-HK' => [
            'domain' => 'ebay.com.hk',
            'siteId' => 201
        ],
        'EBAY-IE' => [
            'domain' => 'ebay.ie',
            'siteId' => 205
        ],
        'EBAY-IT' => [
            'domain' => 'ebay.it',
            'siteId' => 101
        ],
        'EBAY-IN' => [
            'domain' => 'ebay.in',
            'siteId' => 203
        ],
        'EBAY-MY' => [
            'domain' => 'ebay.com.my',
            'siteId' => 207
        ],
        'EBAY-NL' => [
            'domain' => 'ebay.nl',
            'siteId' => 146
        ],
        'EBAY-NLBE' => [
            'domain' => 'benl.ebay.be',
            'siteId' => 123
        ],
        'EBAY-PH' => [
            'domain' => 'ebay.ph',
            'siteId' => 211
        ],
        'EBAY-PL' => [
            'domain' => 'ebay.pl',
            'siteId' => 212
        ],
        'EBAY-SG' => [
            'domain' => 'ebay.com.sg',
            'siteId' => 216
        ],
        'EBAY-US' => [
            'domain' => 'ebay.com',
            'siteId' => 0
        ]
    ];


    public function getDomain($ebayGlobalId)
    {
        $domain = $this->ebaySites[$ebayGlobalId]['domain'] ?? null;
        if (empty($domain)) {
            throw new \Exception('Unknown ebay global id:' . $ebayGlobalId);
        }
        return $domain;
    }

    public function getSiteId($ebayGlobalId)
    {
        $siteId = $this->ebaySites[$ebayGlobalId]['siteId'] ?? null;
        if (empty($siteId)) {
            throw new \Exception('Unknown ebay global id:' . $ebayGlobalId);
        }
        return $siteId;
    }

    public function isValid($ebayGlobalId)
    {
        return isset($this->ebaySites[$ebayGlobalId]);
    }
}