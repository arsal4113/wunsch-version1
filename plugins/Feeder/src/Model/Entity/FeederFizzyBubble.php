<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * FeederFizzyBubble Entity
 *
 * @property int $id
 * @property string $url
 * @property string $title_text
 * @property string $title_color
 * @property string $title_background_color
 * @property int $title_opacity
 * @property string $subline_text
 * @property string $subline_color
 * @property string $subline_background_color
 * @property int $subline_opacity
 * @property string $image_src
 * @property int $uploaded_image_size
 * @property string $img_alt_tag
 * @property bool $active
 * @property bool $use_on
 * @property string $sort_order
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 */
class FeederFizzyBubble extends Entity
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
        'url' => true,
        'title_text' => true,
        'title_color' => true,
        'title_background_color' => true,
        'title_opacity' => true,
        'subline_text' => true,
        'subline_color' => true,
        'subline_background_color' => true,
        'subline_opacity' => true,
        'image_src' => true,
        'img_alt_tag' => true,
        'active' => true,
        'use_on' => true,
        'sort_order' => true,
        'start_time' => true,
        'end_time' => true
    ];

    protected function _getUploadedImageSize($uploadedImageSize)
    {
        if ($uploadedImageSize === null || $this->isDirty('uploaded_image_size')) {
            $fields = ['image_src'];
            $images = [];
            foreach ($fields as $field) {
                isset($this->{$field}) && $images[] = $this->{$field};
            }

            $uploadedImageSize = 0;
            foreach ($images as $image) {
                if (file_exists(WWW_ROOT . 'img' . DS . $image)) {
                    $uploadedImageSize += filesize(WWW_ROOT . 'img' . DS . $image);
                } else if (!empty($image)){
                    $uploadedImageSize += @get_headers($image, true)['Content-Length'] ?? 0;
                }
            }
            $connection = \Cake\Datasource\ConnectionManager::get('default');
            $connection->update('feeder_fizzy_bubbles', ['uploaded_image_size' => $uploadedImageSize], ['id' => $this->id]);
            $this->setDirty('uploaded_image_size', false);
        }
        return $uploadedImageSize;
    }
}
