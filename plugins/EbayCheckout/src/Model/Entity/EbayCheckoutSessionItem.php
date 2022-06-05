<?php
namespace EbayCheckout\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayCheckoutSessionItem Entity
 *
 * @property int $id
 * @property int $ebay_checkout_session_id
 * @property int $selected_ebay_checkout_session_item_shipping_id
 * @property string $title
 * @property string $short_description
 * @property string $base_price_currency
 * @property float $base_price_value
 * @property float $original_price_value
 * @property string $image
 * @property string $ebay_item_id
 * @property string $ebay_category_path
 * @property boolean $top_rated_buying_experience
 * @property string $ebay_line_item_id
 * @property string $legacy_order_id
 * @property string $net_price_currency
 * @property float $net_price_value
 * @property int $quantity
 * @property string $seller_username
 * @property string $seller_account_type
 * @property string $seller_feedback_score
 * @property string $seller_feedback_percentage
 * @property string $attributes
 * @property string $tags
 * @property boolean $is_deleted
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSession $ebay_checkout_session
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping[] $ebay_checkout_session_item_shippings
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping $selected_ebay_checkout_session_item_shipping
 * @property \EbayCheckout\Model\Entity\EbayItem $ebay_item
 * @property \EbayCheckout\Model\Entity\EbayLineItem $ebay_line_item
 */
class EbayCheckoutSessionItem extends Entity
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
