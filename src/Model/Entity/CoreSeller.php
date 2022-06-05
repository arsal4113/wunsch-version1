<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoreSeller Entity.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $core_language_id
 * @property \App\Model\Entity\CoreLanguage $core_language
 * @property int $core_country_id
 * @property bool $is_active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\CoreConfiguration[] $core_configurations
 * @property \App\Model\Entity\CoreCustomerAddress[] $core_customer_addresses
 * @property \App\Model\Entity\CoreCustomer[] $core_customers
 * @property \App\Model\Entity\CoreUserRole[] $core_user_roles
 * @property \App\Model\Entity\CoreUser[] $core_users
 * @property \App\Model\Entity\CoreSellerType[] $core_seller_type
 */
class CoreSeller extends Entity
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
        'id' => false,
    ];
}
