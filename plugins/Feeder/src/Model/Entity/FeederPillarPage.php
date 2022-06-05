<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * FeederPillarPage Entity
 *
 * @property int $id
 * @property string $title_tag
 * @property string $url_path
 * @property string $meta_tag
 * @property string $robots_tag
 * @property string facebook_og_url
 * @property string facebook_og_title
 * @property string facebook_og_description
 * @property string facebook_og_image
 * @property string $block_configuration
 * @property string $guide_image
 * @property int $uploaded_image_size
 * @property string $guide_headline
 *
 */
class FeederPillarPage extends Entity
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
        'title_tag' => true,
        'url_path' => true,
        'meta_tag' => true,
        'robots_tag' => true,
        'facebook_og_url' => true,
        'facebook_og_title' => true,
        'facebook_og_description' => true,
        'facebook_og_image' => true,
        'block_configuration' => true,
        'guide_image' => true,
        'uploaded_image_size' => true,
        'guide_headline' => true
    ];

    protected function _getUploadedImageSize($uploadedImageSize)
    {
        if ($uploadedImageSize === null || $this->isDirty('uploaded_image_size')) {
            $fields = ['first_block_image', 'second_block_image', 'third_block_image', 'guide_image'];
            $images = [];
            foreach ($fields as $field) {
                isset($this->{$field}) && $images[] = $this->{$field};
            }
            $data = json_decode($this->block_configuration, true);
            foreach ($data ?? [] as $block) {
                foreach ($block ?? [] as $key => $field) {
                    $key == 'imageUrl' && $images[] = $field;
                }
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
            $connection->update('feeder_pillar_pages', ['uploaded_image_size' => $uploadedImageSize], ['id' => $this->id]);
            $this->setDirty('uploaded_image_size', false);
        }
        return $uploadedImageSize;
    }
}
