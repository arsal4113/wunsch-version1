<?php

namespace ZipData\Controller;

use Cake\Datasource\ResultSetInterface;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Search\Controller\Component\PrgComponent;
use ZipData\Model\Entity\ZipDataZip;
use ZipData\Model\Table\ZipDataZipsTable;
use Exception;

/**
 * ZipDataZips Controller
 *
 * @property ZipDataZipsTable $ZipDataZips
 * @property PrgComponent $Prg
 *
 * @method ZipDataZip[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZipDataZipsController extends AppController
{
    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

    /**
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['getByCode']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->Prg->commonProcess();

        $availableColumns = $this->ZipDataZips->getSchema()->columns();

        $this->set('zipDataZips', $this->paginate($this->ZipDataZips->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['zipDataZips']);
    }

    /**
     * View method
     *
     * @param string|null $id Zip Data Zip id.
     * @return void
     * @throws NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $zipDataZip = $this->ZipDataZips->get($id, [
            'contain' => []
        ]);
        $this->set('zipDataZip', $zipDataZip);
        $this->set('_serialize', ['zipDataZip']);
    }

    /**
     * @return Response|null
     */
    public function add()
    {
        $zipDataZip = $this->ZipDataZips->newEntity();
        if ($this->request->is('post')) {
            $zipDataZip = $this->ZipDataZips->patchEntity($zipDataZip, $this->request->data);
            if ($this->ZipDataZips->save($zipDataZip)) {
                $this->Flash->success(__('The zip data zip has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The zip data zip could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('zipDataZip'));
        $this->set('_serialize', ['zipDataZip']);
    }

    /**
     * @param null $id
     * @return Response|null
     */
    public function edit($id = null)
    {
        $zipDataZip = $this->ZipDataZips->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $zipDataZip = $this->ZipDataZips->patchEntity($zipDataZip, $this->request->data);
            if ($this->ZipDataZips->save($zipDataZip)) {
                $this->Flash->success(__('The zip data zip has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The zip data zip could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('zipDataZip'));
        $this->set('_serialize', ['zipDataZip']);
    }

    /**
     * @param null $id
     * @return Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $zipDataZip = $this->ZipDataZips->get($id);
        if ($this->ZipDataZips->delete($zipDataZip)) {
            $this->Flash->success(__('The zip data zip has been deleted.'));
        } else {
            $this->Flash->error(__('The zip data zip could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Get data by zip code method
     *
     * @param string|null $code Zip Data Zip code.
     * @return void
     */
    public function getByCode($code = null)
    {
        $zipDataZip = $this->ZipDataZips->find('all')
            ->where(['code' => $code])
            ->first();

        $this->viewBuilder()->setClassName('Json');

        $this->set('ZipData', $zipDataZip);
        $this->set('_serialize', ['ZipData']);
    }

    /**
     * @return Response|null
     */
    public function import()
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fileInfo = $this->request->getData('import_file');
            $bulkUpdateItemCount = 2500;
            $timeStamp = time();

            if (!empty($fileInfo)) {
                $allowedFileTypes = ['text/csv', 'text/plain', 'text/x-csv', 'application/vnd.ms-excel',
                    'application/csv', 'application/x-csv', 'text/comma-separated-values', 'text/x-comma-separated-values',
                    'text/tab-separated-values', 'application/octet-stream'
                ];
                $fileType = $fileInfo['type'] ?? null;
                $fileName = $fileInfo['name'] ?? null;
                $fileSize = $fileInfo['size'] ?? 0;
                $fileTmpName = $fileInfo['tmp_name'] ?? null;

                if ($fileSize > 0 && !empty($fileTmpName)) {
                    if (($handle = fopen($fileTmpName, 'r')) !== false) {
                        if (in_array($fileType, $allowedFileTypes) && pathinfo($fileName)['extension'] == 'csv') {
                            $data = [];
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
                            $this->Flash->success(__('The Zip Data has been saved.'));
                            return $this->redirect(['action' => 'index']);
                        } else {
                            $this->Flash->error(__('Only csv files are allowed. "{0}" provided', [$fileType]));
                        }
                    }
                } else {
                    $this->Flash->error(__('CSV file not provided. Please upload a valid CSV file.'));
                }
            }
        }
        return $this->redirect($this->referer());
    }
}
