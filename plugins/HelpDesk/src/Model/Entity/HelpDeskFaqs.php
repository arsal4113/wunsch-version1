<?php
namespace HelpDesk\Model\Entity;

use Cake\ORM\Entity;

/**
 * HelpDeskFaq Entity
 *
 * @property int $id
 * @property int $help_desk_category_id
 * @property string $question
 * @property string $answer
 * @property int $sort_order
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 */
class HelpDeskFaq extends Entity
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
        'help_desk_category_id' => true,
        'question' => true,
        'answer' => true,
        'sort_order' => true,
        'modified' => true,
        'created' => true
    ];
}