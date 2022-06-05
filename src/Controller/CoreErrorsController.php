<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\CoreError;
use Cake\I18n\Time;

/**
 * CoreErrors Controller
 *
 * @property \App\Model\Table\CoreErrorsTable $CoreErrors
 * @property \App\Controller\Component\CsvHandlerComponent $CsvHandler
 */
class CoreErrorsController extends AppController
{

    /**
    * @var array
    *
    */
    public $components = ['Search.Prg', 'CsvHandler'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CoreSellers'],
            'order' => ['id' => 'DESC']
        ];
        $this->Prg->commonProcess();

        $availableColumns = $this->CoreErrors->schema()->columns();

        $this->set('coreErrors', $this->paginate($this->CoreErrors->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['coreErrors']);
    }

    /**
     * View method
     *
     * @param string|null $id Core Error id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreError = $this->CoreErrors->get($id, [
            'contain' => ['CoreSellers']
        ]);
        $this->set('coreError', $coreError);
        $this->set('_serialize', ['coreError']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreError = $this->CoreErrors->newEntity();
        if ($this->request->is('post')) {
            $coreError = $this->CoreErrors->patchEntity($coreError, $this->request->data);
            if ($this->CoreErrors->save($coreError)) {
                $this->Flash->success(__('The core error has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The core error could not be saved. Please, try again.'));
            }
        }
        $coreSellers = $this->CoreErrors->CoreSellers->find('list', ['limit' => 200]);
        $this->set(compact('coreError', 'coreSellers'));
        $this->set('_serialize', ['coreError']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Error id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreError = $this->CoreErrors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreError = $this->CoreErrors->patchEntity($coreError, $this->request->data);
            if ($this->CoreErrors->save($coreError)) {
                $this->Flash->success(__('The core error has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The core error could not be saved. Please, try again.'));
            }
        }
        $coreSellers = $this->CoreErrors->CoreSellers->find('list', ['limit' => 200]);
        $this->set(compact('coreError', 'coreSellers'));
        $this->set('_serialize', ['coreError']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Error id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreError = $this->CoreErrors->get($id);
        if ($this->CoreErrors->delete($coreError)) {
            $this->Flash->success(__('The core error has been deleted.'));
        } else {
            $this->Flash->error(__('The core error could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function download()
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $this->autoRender = false;

        if ($this->request->is('post')) {
            $filename = TMP . 'ebay_api_errors.csv';
            $handle = $this->CsvHandler->openHandle($filename, "w");
            $headers = [
                __('Date'),
                __('Code'),
                __('Message'),
                __('RLogId'),
                __('CheckoutsessionId')
            ];
            $this->CsvHandler->writeCsvLine($headers, $handle, count($headers), ";");

            $coreErrors = $this->CoreErrors->find()
                ->select(['created', 'type', 'code', 'message', 'rlogid', 'ebay_checkout_session_id'])
                ->orderDesc('created');

            /**
             * @var string $year
             * @var string $month
             * @var string $day
             * @var string $hour
             */
            extract($this->request->getData('startTime'));
            $startTime = $year && $month && $day && $hour ? Time::create($year, $month, $day, $hour) : null;

            extract($this->request->getData('endTime'));
            $endTime = $year && $month && $day && $hour ? Time::create($year, $month, $day, $hour) : null;

            if ($startTime !== null) {
                $coreErrors = $coreErrors->where(['created >=' => $startTime]);
            }
            if ($endTime !== null) {
                $coreErrors = $coreErrors->where(['created <=' => $endTime]);
            }

            $coreErrors = $coreErrors->toArray();

            foreach ($coreErrors as $coreError) {
                /** @var CoreError $coreError */
                $line = [
                    $coreError->created,
                    $coreError->code,
                    $coreError->message,
                    $coreError->rlogid,
                    $coreError->ebay_checkout_session_id
                ];
                $this->CsvHandler->writeCsvLine($line, $handle, count($line), ";");
            }

            return $this->response->withFile($filename, ['download' => true]);
        }
    }
}
