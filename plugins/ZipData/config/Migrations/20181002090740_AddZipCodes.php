<?php

use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

/**
 * Class AddZipCodes
 *
 * @property \ZipData\Model\Table\ZipDataZipsTable $ZipDataZips
 */
class AddZipCodes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {

        $this->execute('TRUNCATE TABLE zip_data_zips;');

        $this->ZipDataZips = TableRegistry::getTableLocator()->get('ZipData.ZipDataZips');
        if (empty($this->ZipDataZips->find()->first())) {
            $fileTmpName = ROOT . '/plugins/ZipData/config/Migrations/Import/germany_zip_code.csv';
            if (($handle = fopen($fileTmpName, 'r')) !== false) {
                $bulkUpdateItemCount = 2500;
                $timeStamp = time();
                $data = [];
                fgetcsv($handle, 0, "\t"); // skip header line
                while (($line = fgetcsv($handle, 0, "\t")) !== false) {

                    if (count($line) >= 4) {
                        $city = trim($line[1]);
                        $code = str_pad(trim($line[2]), 5, '0', STR_PAD_LEFT) ;
                        $area = trim($line[3]);

                        $searchHash = sha1($code . $city . $area);
                        $data[$searchHash] = [
                            'code' => $code,
                            'city' => $city,
                            'area' => $area,
                            'last_import' => $timeStamp,
                            'search_hash' => $searchHash
                        ];

                        if (count($data) >= $bulkUpdateItemCount) {
                            $this->ZipDataZips->bulkUpdate($data);
                            $data = [];
                        }
                    }
                }
                if (!empty($data)) {
                    $this->ZipDataZips->bulkUpdate($data);
                }
                $this->ZipDataZips->deleteAll(['last_import !=' => $timeStamp]);
            }
        }
    }
}
