<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoreSellerAddress Entity
 *
 * @property int $id
 * @property string $core_seller_id
 * @property string $first_name
 * @property string $last_name
 * @property string $street_name
 * @property string $street_number
 * @property string $city
 * @property string $zip_code
 * @property string $phone_number
 * @property string $company_name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\CoreSeller $core_seller
 */
class CoreSellerAddress extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _setCity($city)
    {
        return trim($city);
    }

    protected function _setStreetName($streetName)
    {
        return trim($streetName);
    }

    protected function _setFirstName($firstName)
    {
        return trim($firstName);
    }

    protected function _setLastName($lastName)
    {
        return trim($lastName);
    }

    protected function _setCompanyName($companyName)
    {
        return trim($companyName);
    }
}
