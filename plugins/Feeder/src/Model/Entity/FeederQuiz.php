<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederQuiz Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $url_path
 * @property string|null $meta_description
 * @property string|null $title_tag
 * @property string|null robot_tag
 * @property string|null $description
 * @property string|null $question_config
 */
class FeederQuiz extends Entity
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
        'name' => true,
        'url_path' => true,
        'meta_description' => true,
        'title_tag' => true,
        'robot_tag' => true,
        'description' => true,
        'question_config' => true
    ];
}
