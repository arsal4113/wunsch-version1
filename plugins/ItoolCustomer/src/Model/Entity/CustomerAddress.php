<?php
namespace ItoolCustomer\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerAddress Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $core_country_id
 * @property string $first_name
 * @property string $last_name
 * @property string $street_line_1
 * @property string $street_line_2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $phone_number
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \ItoolCustomer\Model\Entity\Customer $customer
 * @property \App\Model\Entity\CoreCountry $core_country
 * @property \ItoolCustomer\Model\Entity\CustomerAddressType[] $customer_address_types
 */
class CustomerAddress extends Entity
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
        'customer_id' => true,
        'core_country_id' => true,
        'first_name' => true,
        'last_name' => true,
        'street_line_1' => true,
        'street_line_2' => true,
        'city' => true,
        'state' => true,
        'postal_code' => true,
        'phone_number' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'core_country' => true,
        'customer_address_types' => true
    ];
}
