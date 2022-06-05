<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Exception\Exception;

/**
 * File handler
 *
 */
class FileHandlerComponent extends Component
{

    /**
     * Open new file handle
     *
     * @param string $path
     * @param string $mode
     * @param bool $useIncludePath
     * @throws Exception
     *
     * @return resource
     */
    public function openHandle($path, $mode, $useIncludePath = false)
    {
        $handle = fopen($path, $mode, $useIncludePath);
        if (file_exists($path)) {
            if ($handle === false) {
                throw new Exception('File with this path: ' . $path . ' could not be opened');
            }
        } else {
            throw new Exception('File with this path: ' . $path . ' does not exist');
        }
        return $handle;
    }

    /**
     * Write file
     *
     * @param resource $handle
     * @param string $path
     * @param string $string
     * @throws Exception
     */
    public function writeFile($handle, $path, $string)
    {
        if (!fwrite($handle, $string)) {
            throw new Exception('Error occured while writing this file: ' . $path);
        }
    }

    /**
     * Close active file handle
     *
     * @param resource $handle
     * @throws Exception
     */
    public function closeHandle($handle)
    {
        if (!fclose($handle)) {
            throw new Exception('Error occured while closing file handle');
        }
    }

    /**
     * Move file into new directory
     *
     * @param string $filePath
     * @param string $newFilePath
     * @param boolean $deleteOldFile
     * @throws Exception
     *
     * @return boolean
     */
    public function moveFile($filePath, $newFilePath, $deleteOldFile = true)
    {
        if (!copy($filePath, $newFilePath)) {
            throw new Exception("Error occured while copying '" . $filePath . "' to '" . $newFilePath . "'");
        }

        if ($deleteOldFile) {
            if (!unlink($filePath)) {
                throw new Exception("Error occured while deleting '" . $filePath . "'");
            }
        }
        return true;
    }

    /**
     * Delete file
     *
     * @param string $filePath
     * @throws Exception
     */
    public function deleteFile($filePath)
    {
        if (file_exists($filePath)) {
            if (!unlink($filePath)) {
                throw new Exception("Error occured while deleting '" . $filePath . "'");
            }
        }
    }

    /**
     * Get file list in a directory
     *
     * @param string $filePath
     * @param string $fileSuffix
     * @param string $fileName
     *
     * @return array
     */
    public function getFileList($filePath, $fileSuffix, $fileName = null)
    {
        $fileList = [];
        $handle = opendir($filePath);
        while (false !== ($file = readdir($handle))) {
            if (substr("$file", -strlen($fileSuffix)) == $fileSuffix) {
                if (!is_dir($file)) {
                    if (!empty($fileName)) {
                        if (preg_match("@$fileName@", $file)) {
                            $fileList[] = $file;
                        }
                    } else {
                        $fileList[] = $file;
                    }
                }
            }
        }

        closedir($handle);
        return $fileList;
    }
}