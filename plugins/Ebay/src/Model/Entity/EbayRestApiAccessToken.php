<?php
namespace Ebay\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayRestApiAccessToken Entity
 *
 * @property int $id
 * @property int $ebay_account_id
 * @property string $token
 * @property string $token_type
 * @property int $expire_timestamp
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Ebay\Model\Entity\EbayAccount $ebay_account
 */
class EbayRestApiAccessToken extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
