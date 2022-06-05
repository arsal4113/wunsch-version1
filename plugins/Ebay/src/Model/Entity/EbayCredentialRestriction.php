<?php
namespace Ebay\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayCredentialRestriction Entity.
 *
 * @property int $id
 * @property int $ebay_account_type_id
 * @property int $core_seller_id
 * @property int $ebay_credential_id
 */
class EbayCredentialRestriction extends Entity
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
