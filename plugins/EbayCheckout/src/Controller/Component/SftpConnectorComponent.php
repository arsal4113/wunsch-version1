<?php

namespace EbayCheckout\Controller\Component;

use Cake\Controller\Component;

/**
 * Class SftpConnectorComponent
 * @package EbayCheckout\Controller\Component
 */
class SftpConnectorComponent extends Component
{

    private $connection;
    private $sftp;

    /**
     * Connect to SFTP server
     *
     * @param $host
     * @param int $port
     * @throws \Exception
     */
    public function connect($host, $port = 22)
    {
        $this->connection = @ssh2_connect($host, $port);
        if (!$this->connection) {
            throw new \Exception(__d('remote_file_manager', 'Could not connect to SFTP server with hostname: {0} on port: {1}', [$host, $port]));
        }
    }

    /**
     *  Login to SFTP server
     *
     * @param $username
     * @param $password
     * @throws \Exception
     */
    public function login($username, $password)
    {
        if (!@ssh2_auth_password($this->connection, $username, $password)) {
            throw new \Exception(__d('remote_file_manager', 'Could not authenticate username: {0} and password: {1}', [$username, $password]));
        }

        $this->sftp = @ssh2_sftp($this->connection);

        if (!$this->sftp) {
            throw new \Exception(__d('remote_file_manager', 'Could not initialize SFTP subsystem'));
        }
    }

    /**
     * @param $username
     * @param $publicKey
     * @param $privateKey
     * @param $secret
     * @throws \Exception
     */
    public function loginWithSshKey($username, $publicKey, $privateKey, $secret)
    {
        if (!ssh2_auth_pubkey_file($this->connection, $username, $publicKey, $privateKey, $secret)) {
            throw new \Exception(__d('remote_file_manager', 'Could not authenticate username: {0} with ssh keys', [$username]));
        }
        $this->sftp = @ssh2_sftp($this->connection);

        if (!$this->sftp) {
            throw new \Exception(__d('remote_file_manager', 'Could not initialize SFTP subsystem'));
        }
    }

    /**
     * @param $localFile
     * @param $remoteFile
     * @throws \Exception
     */
    public function uploadFile($localFile, $remoteFile)
    {
        $sftp = $this->sftp;
        $stream = fopen("ssh2.sftp://" . intval($sftp) . $remoteFile, 'w');

        if (!$stream) {
            throw new \Exception(__d('remote_file_manager', 'Could not open remote file: {0}', [$remoteFile]));
        }

        $dataToSend = @file_get_contents($localFile);

        if ($dataToSend === false) {
            throw new \Exception(__d('remote_file_manager', 'Could not open local file: {0}', [$localFile]));
        }

        if (@fwrite($stream, $dataToSend) === false) {
            throw new \Exception(__d('remote_file_manager', 'Could not send data from local file: {0}', [$localFile]));
        }

        @fclose($stream);
    }

    /**
     * @param $remoteFile
     * @param $localFile
     * @throws \Exception
     */
    public function downloadFile($remoteFile, $localFile)
    {
        $sftp = $this->sftp;
        $stream = @fopen("ssh2.sftp://" . intval($sftp) . $remoteFile, 'r');
        if (!$stream) {
            throw new \Exception(__d('remote_file_manager', 'Could not open remote file: {0}', [$remoteFile]));
        }

        $statinfo = ssh2_sftp_stat($sftp, $remoteFile);
        $size = $statinfo['size'];
        $contents = '';
        $read = 0;
        $len = $size;
        while ($read < $len && ($buf = @fread($stream, $len - $read))) {
            $read += strlen($buf);
            $contents .= $buf;
        }

        if ($contents === false) {
            throw new \Exception(__d('remote_file_manager', 'Could not read remote file: {0}', [$remoteFile]));
        }

        if (@file_put_contents($localFile, $contents) === false) {
            throw new \Exception(__d('remote_file_manager', 'Could not save remote file: {0} to local file: {1}', [$remoteFile, $localFile]));
        }

        @fclose($stream);
    }

    /**
     * Get file list in SFTP server
     *
     * @param string $remotePath
     * @param string $fileSuffix
     * @param string $fileName
     * @return array
     */
    public function getFileList($remotePath, $fileSuffix, $fileName = null)
    {
        $sftp = $this->sftp;
        $dir = "ssh2.sftp://" . intval($sftp) . $remotePath;
        $fileList = [];

        $handle = @opendir($dir);
        if ($handle !== false) {
            while (false !== ($file = readdir($handle))) {
                if (!empty($fileName)) {
                    if (!preg_match("@$fileName@", $file)) {
                        continue;
                    }
                }
                if (!empty($fileSuffix)) {
                    $checkSuffix = substr($file, -strlen($fileSuffix));
                    if ($checkSuffix != $fileSuffix || is_dir($file)) {
                        continue;
                    }
                }
                $fileList[] = $file;
            }
            closedir($handle);
        }
        return $fileList;
    }

    /**
     * Check, if file exists on SFTP server
     *
     * @param $remoteFile
     * @return bool
     */
    public function isFileExist($remoteFile)
    {
        $sftp = $this->sftp;
        return @file_exists("ssh2.sftp://" . intval($sftp) . $remoteFile);
    }

    /**
     * Open file
     *
     * @param $remoteFile
     * @return resource
     */
    public function openFile($remoteFile)
    {
        $sftp = $this->sftp;
        return @fopen("ssh2.sftp://" . intval($sftp) . $remoteFile, 'r');
    }

    /**
     * @param $remoteFile
     * @return mixed
     */
    public function fileSize($remoteFile)
    {
        $sftp = $this->sftp;
        $statInfo = ssh2_sftp_stat($sftp, $remoteFile);
        $size = $statInfo['size'];

        return $size;
    }

    /**
     * Delete file in SFTP server
     *
     * @param $remoteFile
     * @throws \Exception
     */
    public function deleteRemoteFile($remoteFile)
    {
        $sftp = $this->sftp;
        if (unlink("ssh2.sftp://" . intval($sftp) . $remoteFile) === false) {
            throw new \Exception(__d('remote_file_manager', 'Could not delete remote file: {0}', [$remoteFile]));
        }
    }

    /**
     * Disconnect current sftp connection
     */
    public function disconnect()
    {
        $this->connection = null;
        $this->sftp = null;
    }

    /**
     * Create a new directory in SFTP server
     *
     * @param $remoteFile
     * @return bool
     */
    public function createDirectory($remoteFile)
    {
        $sftp = $this->sftp;
        return @mkdir("ssh2.sftp://" . intval($sftp) . $remoteFile);
    }
}
