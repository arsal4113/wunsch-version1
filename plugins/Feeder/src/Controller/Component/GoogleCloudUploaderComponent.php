<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 09.07.18
 * Time: 14:38
 */

namespace Feeder\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Google\Cloud\Storage\StorageClient;

/**
 * Class GoogleCloudUploaderComponent
 * @package Feeder\Controller\Component
 */
class GoogleCloudUploaderComponent extends Component
{
    private $baseUrl = 'https://storage.googleapis.com/';
    private $cdnDomain;

    /**
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->cdnDomain = Configure::read('google_cloud.cloud_storage.cdn_domain');
    }

    /**
     * @param $filePath
     * @param $fileContent
     * @param $metadata
     * @param $bucketName
     * @param string $accessType
     * @return \Google\Cloud\Storage\StorageObject
     */
    public function upload($filePath, $fileContent, $metadata, $bucketName, $accessType = 'publicRead')
    {
        $storage = new StorageClient();
        $response = $storage->bucket($bucketName)->upload($fileContent, [
            'name' => $filePath,
            'metadata' => $metadata,
            'predefinedAcl' => $accessType
        ]);

        return $response;
    }

    /**
     * @param $data
     * @param $files
     * @param string $bucketName
     * @param int $cacheLifeTime
     * @return mixed
     */
    public function handleBrowserUpload($data, $files, $bucketName = 'wunsch-upload', $cacheLifeTime = 7776000)
    {
        foreach ($files as $name => $path) {
            if (
                !empty($data[$name]['tmp_name'])
                && is_uploaded_file($data[$name]['tmp_name'])
            ) {

                // Strip path information
                $filename = Text::slug(strtolower(trim(basename($data[$name]['name']))), '_');
                $filePath = $path . $filename;

                $this->upload(
                    $filePath,
                    file_get_contents($data[$name]['tmp_name']),
                    [
                        'contentType' => $data[$name]['type'],
                        'cacheControl' => 'public, max-age=' . $cacheLifeTime
                    ],
                    $bucketName
                );

                if (!empty($this->cdnDomain)) {
                    $data[$name] = $this->cdnDomain . $filePath;
                } else {
                    $data[$name] = $this->baseUrl . $bucketName . '/' . $filePath;
                }
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
