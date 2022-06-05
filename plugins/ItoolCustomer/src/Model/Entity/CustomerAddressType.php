<?php

namespace ItoolCustomer\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerAddressType Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \ItoolCustomer\Model\Entity\CustomerAddress[] $customer_addresses
 */
class CustomerAddressType extends Entity
{
    const CUSTOMER_ADDRESS_TYPE_SHIPPING = 'shipping';
    const CUSTOMER_ADDRESS_TYPE_INVOICE = 'invoice';
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
        'code' => true,
        'name' => true,
        'created' => true,
        'modified' => true,
        'customer_addresses' => true
    ];
}
