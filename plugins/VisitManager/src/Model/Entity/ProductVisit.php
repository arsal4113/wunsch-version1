<?php

namespace VisitManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductVisit Entity.
 *
 * @property int $id
 * @property string $user_session
 * @property int $marketplace_product
 * @property string $marketplace_name
 * @property string $search_term
 * @property int $position
 * @property int $marketplace_category
 * @property int $hits
 * @property string $user_group
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ProductVisit extends Entity
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
        'user_session' => true,
        'marketplace_product' => true,
        'marketplace_name' => true,
        'search_term' => true,
        'position' => true,
        'marketplace_category' => true,
        'hits' => true,
        'user_group' => true,
        'created' => true,
        'modified' => true,
    ];
}
