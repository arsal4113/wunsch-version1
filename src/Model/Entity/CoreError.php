<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoreError Entity.
 *
 * @property int $id
 * @property int $core_seller_id
 * @property \App\Model\Entity\CoreSeller $core_seller
 * @property string $type
 * @property string $code
 * @property string $sub_code
 * @property string $message
 * @property string $rlogid
 * @property string $ebay_checkout_session_id
 * @property string $foreign_key
 * @property string $foreign_model
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class CoreError extends Entity
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
