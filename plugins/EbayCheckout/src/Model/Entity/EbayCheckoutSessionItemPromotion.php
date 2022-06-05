<?php
namespace EbayCheckout\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayCheckoutSessionItemPromotion Entity
 *
 * @property int $id
 * @property int $ebay_checkout_session_item_id
 * @property string $discount_currency
 * @property float $discount_value
 * @property string $message
 * @property string $promotion_code
 * @property string $promotion_type
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionItem $ebay_checkout_session_item
 */
class EbayCheckoutSessionItemPromotion extends Entity
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
}
