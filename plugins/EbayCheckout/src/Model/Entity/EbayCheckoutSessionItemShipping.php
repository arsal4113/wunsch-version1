<?php
namespace EbayCheckout\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayCheckoutSessionItemShipping Entity
 *
 * @property int $id
 * @property int $ebay_checkout_session_item_id
 * @property string $base_delivery_cost_currency
 * @property float $base_delivery_cost_value
 * @property string $delivery_discount_currency
 * @property float $delivery_discount_value
 * @property float $additional_unit_cost_value
 * @property string $additional_unit_cost_currency
 * @property \Cake\I18n\Time $max_estimated_delivery_date
 * @property \Cake\I18n\Time $min_estimated_delivery_date
 * @property int $selected
 * @property string $shipping_carrier_code
 * @property string $shipping_option_id
 * @property string $shipping_service_code
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionItem $ebay_checkout_session_item
 */
class EbayCheckoutSessionItemShipping extends Entity
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
