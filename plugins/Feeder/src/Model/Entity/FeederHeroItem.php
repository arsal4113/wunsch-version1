<?php

namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederHeroItem Entity
 *
 * @property int $id
 * @property string $type
 * @property string $webm
 * @property string $mp4
 * @property string $image
 * @property string $image_alt_tag
 * @property string $image_title_tag
 * @property string $item_id
 * @property int $category_id
 * @property string $title
 * @property string $url
 * @property int $sort_order
 * @property bool $is_active
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \Feeder\Model\Entity\FeederCategory[] $feeder_categories
 * @property \ItoolCustomer\Model\Entity\CustomerGender $customer_gender
 */
class FeederHeroItem extends Entity
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
        'type' => true,
        'webm' => true,
        'mp4' => true,
        'image' => true,
        'image_alt_tag' => true,
        'image_title_tag' => true,
        'item_id' => true,
        'title' => true,
        'url' => true,
        'category_id' => true,
        'item_image_url' => true,
        'sort_order' => true,
        'is_active' => true,
        'start_time' => true,
        'end_time' => true,
        'modified' => true,
        'created' => true,
        'feeder_categories' => true,
        'gender_id' => true,
        'customer_gender' => true
    ];
}
