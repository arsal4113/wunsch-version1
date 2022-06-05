<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Exception\Exception;

/**
 * Zipper
 *
 */
class ZipComponent extends Component
{

    /**
     * Zip XML feed
     *
     * @param string $filePath
     * @param string $fileName
     * @throws ItoolMipException
     */
    public function archiveFile($filePath, $fileName)
    {
        $zip = new \ZipArchive;
        if ($zip->open($filePath . '.zip', \ZipArchive::CREATE) === TRUE) {
            $zip->addFile($filePath, $fileName);
            $zip->close();
        } else {
            throw new Exception('Failed to zip this file: ' . $filePath);
        }
    }

    /**
     * Extract ZIP file
     *
     * @param string $filePath
     * @param string $targetPath
     * @param string $fileName
     * @throws ItoolException
     */
    public function extractFile($filePath, $targetPath, $fileName)
    {
        $zip = new \ZipArchive;
        if ($zip->open($filePath) === TRUE) {
            $zip->extractTo($targetPath, $fileName);
            $zip->close();
        } else {
            throw new Exception('Failed to extract this zipped file: ' . $filePath);
        }
    }
}