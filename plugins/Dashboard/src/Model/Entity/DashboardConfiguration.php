<?php
namespace Dashboard\Model\Entity;

use Cake\ORM\Entity;

/**
 * DashboardConfiguration Entity.
 *
 * @property int $id
 * @property int $core_seller_type_id
 * @property int $core_seller_id
 * @property int $core_user_id
 * @property string $cell_name
 * @property string $cell_configuration
 * @property int $sort_order
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class DashboardConfiguration extends Entity
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
