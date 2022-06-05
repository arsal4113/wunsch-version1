<?php

namespace VisitManager\Shell;

use Cake\Console\Shell;
use App\Controller\Component\CsvHandlerComponent;
use Cake\Controller\ComponentRegistry;

/**
 * Class AbstractUploadShell
 * @package VisitManager\Shell
 * @property CsvHandlerComponent $CsvHandler
 */
abstract class AbstractUploadShell extends Shell
{
    protected $delimiter = ';';
    protected $handle;

    /**
     * @see \Cake\Console\Shell::initialize()
     */
    public function initialize()
    {
        parent::initialize();
        $this->CsvHandler = new CsvHandlerComponent(new ComponentRegistry());
    }

    /**
     * @param $filePath
     * @param string $mode
     * @return $this
     */
    protected function openUploadFile($filePath, $mode = 'w')
    {
        $this->handle = $this->CsvHandler->openHandle($filePath, $mode);
        return $this;
    }

    protected function closeUploadFile() {
       return $this->CsvHandler->closeHandle($this->handle);
    }

    /**
     * @param string $delimiter
     * @return $this
     */
    protected function setDelimiter(string $delimiter)
    {
        $this->delimiter = $delimiter;
        return $this;
    }

    /**
     * @param array $fileHeader
     * @return int
     */
    protected function writeFileHeader(array $fileHeader)
    {
        return $this->CsvHandler->writeCsvLine($fileHeader, $this->handle, count($fileHeader), $this->delimiter);
    }

    /**
     * @param array $fileLine
     * @return int
     */
    protected function writeFileLine(array $fileLine)
    {
        return $this->CsvHandler->writeCsvLine($fileLine, $this->handle, count($fileLine), $this->delimiter);
    }

    /**
     * @param $filePath
     * @return bool|string
     */
    protected function createGzipFile($filePath)
    {
        if (file_exists($filePath)) {
            $compressedTmpFile = $filePath . '.tmp_gz';
            $compressedFile = $filePath . '.gz';

            $error = false;
            if ($gzipHandle = gzopen($compressedTmpFile, 'wb9')) {
                if ($fileHandle = fopen($filePath, 'rb')) {
                    while (!feof($fileHandle)) {
                        gzwrite($gzipHandle, fread($fileHandle, 1024 * 512));
                    }
                    fclose($fileHandle);
                } else {
                    $error = true;
                }
                gzclose($gzipHandle);
            } else {
                $error = true;
            }
            if ($error) {
                return false;
            } else {
                if (rename($compressedTmpFile, $compressedFile)) {
                    return $compressedFile;
                }
            }
        }
        return false;
    }
}
