<?php
namespace EbayCheckout\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayCheckoutSession Entity
 *
 * @property int $id
 * @property int $core_seller_id
 * @property string $purchase_order_id
 * @property int $purchase_order_timestamp
 * @property string $order_payment_status
 * @property int $ebay_checkout_id
 * @property int $selected_ebay_checkout_session_payment_id
 * @property string $type
 * @property string $redemption_code
 * @property int $marketing_consent
 * @property string $session_token
 * @property string $ebay_checkout_session_id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $form_key
 * @property string $ip
 * @property string $country_code
 * @property string $ebay_global_id
 * @property string $ebay_app_id
 * @property string $ebay_epn_reference_id
 * @property string $ebay_epn_campaign_id
 * @property string $utm_source
 * @property string $utm_medium
 * @property string $utm_campaign
 * @property string $utm_content
 * @property string $payment_initiated
 * @property string $correlation_id
 * @property int $customer_id
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\CoreSeller $core_seller
 * @property \EbayCheckout\Model\Entity\EbayCheckout $ebay_checkout
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment $selected_ebay_checkout_session_payment
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment[] $ebay_checkout_session_payments
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionItem[] $ebay_checkout_session_items
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionTotal[] $ebay_checkout_session_totals
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSession $ebay_checkout_session
 * @property \ItoolCustomer\Model\Entity\Customer $customer
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress $ebay_checkout_session_billing_address
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress $ebay_checkout_session_shipping_address
 */
class EbayCheckoutSession extends Entity
{
    const GUEST = 'guest';
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
