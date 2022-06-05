<?php
namespace Ebay\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayAccount Entity.
 *
 * @property int $id
 * @property int $ebay_account_type_id
 * @property \Ebay\Model\Entity\EbayAccountType $ebay_account_type
 * @property int $ebay_credential_id
 * @property \Ebay\Model\Entity\EbayCredential $ebay_credential
 * @property int $core_seller_id
 * @property \App\Model\Entity\CoreSeller $core_seller
 * @property int $is_active
 * @property string $code
 * @property string $name
 * @property string $token
 * @property \Cake\I18n\Time $token_expiration_time
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Ebay\Model\Entity\EbayAutoListerConfiguration[] $ebay_auto_lister_configurations
 * @property \Ebay\Model\Entity\EbayFeedbackMessage[] $ebay_feedback_messages
 * @property \Ebay\Model\Entity\EbayLaunchProfile[] $ebay_launch_profiles
 * @property \Ebay\Model\Entity\EbayListing[] $ebay_listings
 * @property \Ebay\Model\Entity\EbaySite[] $ebay_sites
 */
class EbayAccount extends Entity
{

    const STATUS_IS_CONNECTED_CODE = 'Connected';
    const STATUS_IS_CONNECTED_COLOR = 'green';
    const STATUS_NOT_CONNECTED_CODE = 'Not connected';
    const STATUS_NOT_CONNECTED_COLOR = 'red';
    const STATUS_RECREATE_CONNECTION_CODE = 'Recreate connection';
    const STATUS_RECREATE_CONNECTION_COLOR = 'yellow';

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
