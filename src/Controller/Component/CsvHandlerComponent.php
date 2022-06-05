<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Exception\Exception;

/**
 * CsvHandler component
 * @property \App\Controller\Component\FileHandlerComponent $FileHandler
 */
class CsvHandlerComponent extends Component
{

    /**
     * @var array
     */
    public $components = ['FileHandler'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * CSV delimiter
     *
     * @var string
     */
    public $delimiter = ";";

    /**
     * CSV enclosure
     *
     * @var string
     */
    public $enclosure = '"';

    /**
     * Get delimiter
     *
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * Set delimiter
     *
     * @param $delimiter
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * Get enclosure
     *
     * @return string
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * Set enclosure
     *
     * @param $enclosure
     */
    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;
    }

    /**
     * Open new file handle
     *
     * @param string $path
     * @param string $mode
     * @param boolean $useIncludePath
     * @throws Exception
     *
     * @return resource
     */
    public function openHandle($path, $mode, $useIncludePath = false)
    {
        $handle = fopen($path, $mode, $useIncludePath);
        if (file_exists($path)) {
            if ($handle === false) {
                throw new Exception(__('File with this path: {0} could not be opened.', $path));
            }
        } else {
            throw new Exception(__('File with this path: {0} does not exist.', $path));
            throw new Exception('File with this path: ' . $path . ' does not exist');
        }
        return $handle;
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
            throw new Exception(__('Error occurred while closing file handle'));
        }
    }

    /**
     * Write CSV line
     *
     * @param array $csvLine
     * @param object $handle
     * @param integer $colCount
     * @param string $delimiter
     * @return integer
     */
    public function writeCsvLine($csvLine, $handle, $colCount, $delimiter = null)
    {
        if (!empty($delimiter)) {
            $this->delimiter = $delimiter;
        }

        for ($i = 0; $i < $colCount; $i++) {
            $csvLine[$i] = (isset($csvLine[$i])) ?
                $this->enclosure . $csvLine[$i] . $this->enclosure : $this->enclosure . $this->enclosure;
        }

        return fwrite($handle, implode($this->delimiter, $csvLine) . "\n");
    }

    /**
     * Parse a CSV feed
     *
     * @param $path
     * @return \Generator|mixed
     */
    public function getEntities($path)
    {
        // Open file handle
        $handle = $this->FileHandler->openHandle($path, 'r');
        $csvHeader = [];
        while (($line = fgetcsv($handle, 0, $this->delimiter, $this->enclosure)) !== false) {
            try {
                $entity = [];

                // Set CSV header
                if (empty($csvHeader)) {
                    $csvHeader = $this->prepareHeader($line);
                    continue;
                }

                for ($i = 0; $i < count($csvHeader); $i++) {
                    $entity[$csvHeader[$i]] = isset($line[$i]) ? $line[$i] : '';
                }

                yield $entity;
            } catch (Exception $exp) {
                yield $exp;
            }
        }

        $this->FileHandler->closeHandle($handle);
    }

    /**
     * Get CSV Structure
     *
     * @param $path
     * @return array
     */
    public function getStructure($path)
    {
        $handle = $this->FileHandler->openHandle($path, 'r');
        $line = fgetcsv($handle, 0, $this->delimiter, $this->enclosure);
        $line = $this->prepareHeader($line);
        $this->FileHandler->closeHandle($handle);
        return $line;
    }

    /**
     * Get Header and find delimiter
     *
     * @param $header
     * @return array
     */
    protected function prepareHeader($header)
    {
        if (count($header) <= 1) {
            $header = explode($this->delimiter, $header[0]);
            foreach ($header as &$row) {
                $row = trim($row, $this->enclosure);
                $row = trim($row);
            }
        }

        if ($header) {
            $bom = pack('H*', 'EFBBBF');
            $header[0] = preg_replace("/^$bom/", '', $header[0]);
        }

        return $header;
    }
}
