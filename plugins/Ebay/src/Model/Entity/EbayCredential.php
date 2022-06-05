<?php
namespace Ebay\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayCredential Entity.
 *
 * @property int $id
 * @property int $ebay_account_type_id
 * @property \Ebay\Model\Entity\EbayAccountType $ebay_account_type
 * @property string $key_set_name
 * @property string $app_id
 * @property string $dev_id
 * @property string $cert_id
 * @property string $ru_name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Ebay\Model\Entity\EbayAccount[] $ebay_accounts
 */
class EbayCredential extends Entity
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
