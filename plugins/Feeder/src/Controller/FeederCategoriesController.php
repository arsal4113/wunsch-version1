<?php

namespace Feeder\Controller;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\I18n\Time;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;
use Feeder\Model\Entity\FeederCategory;
use Feeder\Model\Table\FeederHeroItemsTable;

/**
 * FeederCategories Controller
 *
 * @property \Feeder\Model\Table\FeederCategoriesTable $FeederCategories
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable $EbayCheckoutSessionItems
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederCategoriesController extends AppController
{
    public $components = ['Search.Prg'];

    protected $images = [
        'image' => 'feeder_categories' . DS . 'image' . DS,
		'banner_image' => 'feeder_categories' . DS . 'banner_image' . DS,
        'animated_header_image' => 'feeder_categories' . DS . 'animated_header_image' . DS
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentFeederCategories', 'CoreCountries'],
            'order' => [
                'is_invisible' => 'asc',
                'name' => 'asc'
            ]
        ];

        $this->Prg->commonProcess();

        $availableColumns = ['id', 'parent_id', 'name', 'target_url'];

        $feederCategories = $this->FeederCategories->find('searchable', $this->Prg->parsedParams());

        if (!empty($this->request->getQueryParams()['target_url'])) {

            $this->FeederCategories->hasOne('UrlRewriteRoutes', [
                'className' => 'UrlRewrite.UrlRewriteRoutes',
                'foreignKey' => 'args'
            ]);

            $findSearchable = function (Query $q) {
                return $q->find('searchable', $this->request->getQueryParams());
            };
            $feederCategories = $feederCategories
                ->matching('UrlRewriteRoutes', $findSearchable);
        }

        $this->set('feederCategories', $this->paginate($feederCategories));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederCategory = $this->FeederCategories->get($id, [
            'contain' => ['ParentFeederCategories', 'ChildFeederCategories.CoreCountries', 'CoreCountries']
        ]);

        $this->set('feederCategory', $feederCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederCategory = $this->FeederCategories->newEntity();
        if ($this->request->is('post')) {
            try {
                $feederCategory->setDirty('uploaded_image_size', true);
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), $this->images);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The feeder category image could not be uploaded. Please, try again.'));
            }

            $data['top_category_id'] = implode(';', (array)$data['top_category_id']);

            $feederCategory = $this->FeederCategories->patchEntity($feederCategory, $data);
            if ($this->FeederCategories->save($feederCategory)) {

                $this->Flash->success(__('The feeder category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder category could not be saved. Please, try again.'));
        }
        $parentFeederCategories = $this->FeederCategories->ParentFeederCategories->find('treeList', ['limit' => 2000]);
        $coreCountries = $this->FeederCategories->CoreCountries->find('list', ['limit' => 200]);
        $feederCategoriesVideoElements = $this->FeederCategories->FeederCategoriesVideoElements->find('list', ['limit' => 200]);

        $this->set(compact('feederCategory', 'parentFeederCategories', 'coreCountries', 'feederCategoriesVideoElements'));

        $this->loadModel('EbayCheckout.EbayCheckoutSessionItems');
        $soldItemCategories = $this->EbayCheckoutSessionItems->getSoldItemsCategories();
        $this->set('soldItemCategories', $soldItemCategories);

        $metaDescription = $this->request->getData('meta_description');
        $this->set('metaDescription', $metaDescription);
        $this->set('_serialize', ['metaDescription']);
        $titleTag = $this->request->getData('title_tag');
        $this->set('titleTag', $titleTag);
        $this->set('_serialize', ['titleTag']);
        $this->set('defaultSmallBannerPos', FeederHeroItemsTable::BANNER_SMALL_POSITIONS);
        $this->set('defaultLargeBannerPos', FeederHeroItemsTable::BANNER_LARGE_POSITIONS);
        $this->set('defaultProductsFactor', FeederHeroItemsTable::BANNER_PRODUCTS_FACTOR);
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederCategory = $this->FeederCategories->get($id, [
            'contain' => ['ChildFeederCategories', 'CoreCountries', 'FeederCategoriesVideoElements']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                $feederCategory->setDirty('uploaded_image_size', true);
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), $this->images);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The feeder category image could not be uploaded. Please, try again.'));
            }

            if(!empty($data['top_category_id'])) {
                $data['top_category_id'] = implode(';', $data['top_category_id']);
            }

            $feederCategory = $this->FeederCategories->patchEntity($feederCategory, $data);
            if ($this->FeederCategories->save($feederCategory)) {
                $this->Flash->success(__('The feeder category has been saved.'));
                Cache::clearGroup(Configure::read('dealsguru.cache.browse', 'default'),
                    Configure::read('dealsguru.cache.browse', 'default'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder category could not be saved. Please, try again.'));
        }
        $parentFeederCategories = $this->FeederCategories->ParentFeederCategories->find('treeList', ['limit' => 2000]);
        $coreCountries = $this->FeederCategories->CoreCountries->find('list', ['limit' => 200]);
        $categoryIds = $this->FeederCategories->find('list', ['valueField' => 'id', 'limit' => 200]);
        $feederCategoriesVideoElements = $this->FeederCategories->FeederCategoriesVideoElements->find('list', ['limit' => 200]);

        $this->set(compact('feederCategory', 'parentFeederCategories', 'coreCountries', 'categoryIds', 'feederCategoriesVideoElements'));

        $this->loadModel('EbayCheckout.EbayCheckoutSessionItems');
        $soldItemCategories = $this->EbayCheckoutSessionItems->getSoldItemsCategories();
        $this->set('soldItemCategories', $soldItemCategories);

        $metaDescription = $this->request->getData('meta_description');
        $this->set('metaDescription', $metaDescription);
        $this->set('_serialize', ['metaDescription']);
        $titleTag = $this->request->getData('title_tag');
        $this->set('titleTag', $titleTag);
        $this->set('_serialize', ['titleTag']);
        $this->set('defaultSmallBannerPos', FeederHeroItemsTable::BANNER_SMALL_POSITIONS);
        $this->set('defaultLargeBannerPos', FeederHeroItemsTable::BANNER_LARGE_POSITIONS);
        $this->set('defaultProductsFactor', FeederHeroItemsTable::BANNER_PRODUCTS_FACTOR);
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederCategory = $this->FeederCategories->get($id);
        if ($this->FeederCategories->delete($feederCategory)) {
            $this->Flash->success(__('The feeder category has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function download()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $filename = TMP . 'feeder_categories_export_' . Time::now()->i18nFormat('dd.MM.yyyy') . '.csv';
            $this->loadComponent('CsvHandler');
            $handle = $this->CsvHandler->openHandle($filename, "w");
            $headers = [
                __('Parent'),
                __('Name'),
                __('Aktiv'),
                __('Category Type'),
                __('Template Type'),
                __('Url Path'),
                __('Ebay Categories'),
                __('Item Ids'),
                __('Keywords'),
                __('Exclude Keywords'),
                __('Sellers'),
                __('Exclude Sellers'),
                __('Headline Guide'),
                __('Banner Alt Tag'),
                __('Banner Title Tag'),
                __('Title Tag'),
                __('Meta Description'),
                __('Robot Tag'),
                __('Facebook OG Url'),
                __('Facebook OG Title'),
                __('Facebook OG Description'),
                __('H1'),
                __('H2'),
                __('Header Image Alt Tag'),
                __('Header Image Title Tag'),
            ];
            $this->CsvHandler->writeCsvLine($headers, $handle, count($headers), ";");

            $limit = 500;
            $page = 1;

            do {
                $feederCategories = $this->FeederCategories->find()->contain(['ParentFeederCategories'])
                    ->orderDesc('FeederCategories.id')
                    ->page($page++, $limit);

                /** @var FeederCategory $feederCategory */
                foreach ($feederCategories as $feederCategory) {
                    $line = [
                        $feederCategory->has('parent_feeder_category') ? $feederCategory->parent_feeder_category->name : '',
                        $feederCategory->name,
                        !$feederCategory->is_invisible && Time::now()->between(
                            $feederCategory->start_time ?? Time::yesterday(), $feederCategory->end_time ?? Time::tomorrow())
                            ? __('Ja') : __('Nein'),
                        $feederCategory->category_type,
                        $feederCategory->template_type,
                        $feederCategory->url_path,
                        $feederCategory->ebay_category_id,
                        $feederCategory->item_id,
                        $feederCategory->keywords,
                        $feederCategory->exclude_keywords,
                        $feederCategory->include_seller,
                        $feederCategory->exclude_seller,
                        $feederCategory->headline_guide,
                        $feederCategory->banner_image_alt_tag,
                        $feederCategory->banner_image_title_tag,
                        $feederCategory->title_tag,
                        $feederCategory->meta_description,
                        $feederCategory->robot_tag,
                        $feederCategory->facebook_og_url,
                        $feederCategory->facebook_og_title,
                        $feederCategory->facebook_og_description,
                        $feederCategory->animated_header_text_title,
                        $feederCategory->animated_header_text_subtitle,
                        $feederCategory->image_alt_tag,
                        $feederCategory->image_title_tag
                    ];
                    $this->CsvHandler->writeCsvLine($line, $handle, count($line), ";");
                }
            } while (count($feederCategories->toArray()) == $limit);

            return $this->response->withFile($filename, ['download' => true]);
        }
    }
}
