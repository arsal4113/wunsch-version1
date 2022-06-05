<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederQuizResult Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $quiz_description
 * @property string|null $headline
 * @property string|null $explanation
 * @property string|null $button_text
 * @property string|null $button_link
 * @property string|null $image_src
 */
class FeederQuizResult extends Entity
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
        'quiz_description' => true,
        'headline' => true,
        'explanation' => true,
        'button_text' => true,
        'button_link' => true,
        'image_src' => true
    ];
}
