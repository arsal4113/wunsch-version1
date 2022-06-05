<?php

namespace Feeder\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Network\Exception\NotFoundException;

/**
 * Class ImageUploaderComponent
 * @package Feeder\Controller\Component
 */
class ImageUploaderComponent extends Component
{
    /**
     * @param $data
     * @param $files
     * @return mixed
     */
    public function handleImageUpload($data, $files)
    {
        foreach ($files as $name => $path) {
            if (
                !empty($data[$name]['tmp_name'])
                && is_uploaded_file($data[$name]['tmp_name'])
            ) {

                // Strip path information
                $filename = basename($data[$name]['name']);
                $fullPath = WWW_ROOT . 'img' . DS . $path;
                $folder = new Folder();
                $folder->create($fullPath);
                $file = new File($data[$name]['tmp_name']);
                if ($file->exists()) {
                    $file->copy($fullPath . $filename);
                } else {
                    throw new NotFoundException(__('Image not found.'));
                }
                $data[$name] = $path . $filename;
            } else {
                if (!empty($data[$name . '_delete'])) {
                    $data[$name] = null;
                } else {
                    unset($data[$name]);
                }
            }
        }
        return $data;
    }
}
