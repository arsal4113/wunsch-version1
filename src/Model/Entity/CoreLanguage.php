<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoreLanguage Entity.
 *
 * @property int $id
 * @property string $iso_code
 * @property string $name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\CoreSeller[] $core_sellers
 * @property \App\Model\Entity\EbayAutoListerConfiguration[] $ebay_auto_lister_configurations
 * @property \App\Model\Entity\EbayDisputeExplanationName[] $ebay_dispute_explanation_names
 * @property \App\Model\Entity\EbayDisputeReasonName[] $ebay_dispute_reason_names
 * @property \App\Model\Entity\EbayLaunchProfile[] $ebay_launch_profiles
 * @property \App\Model\Entity\EbayListing[] $ebay_listings
 */
class CoreLanguage extends Entity
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
