<?php

namespace Ebay\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Ebay\Model\Entity\EbayCategory;

/**
 * EbayCategories Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EbaySites
 * @property \Cake\ORM\Association\BelongsTo $EbayCategories
 * @property \Cake\ORM\Association\BelongsTo $ParentEbayCategories
 * @property \Cake\ORM\Association\HasMany $ChildEbayCategories
 * @property \Cake\ORM\Association\HasMany $EbayCategoryMappings
 * @property \Cake\ORM\Association\HasMany $EbayCategorySpecifics
 * @property \Cake\ORM\Association\HasMany $EbayListings
 */
class EbayCategoriesTable extends Table
{
    private $ebayCategoryTreePathCache = [];

    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
        'id' => [
            'type' => 'value'
        ],
        'ebay_site_id' => [
            'type' => 'value'
        ],
        'ebay_category_id' => [
            'type' => 'value'
        ],
        'parent_id' => [
            'type' => 'value'
        ],
        'category_level' => [
            'type' => 'value'
        ],
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'version' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'created' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'modified' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('ebay_categories');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');
        $this->belongsTo('EbaySites', [
            'foreignKey' => 'ebay_site_id',
            'joinType' => 'INNER',
            'className' => 'Ebay.EbaySites'
        ]);
        $this->belongsTo('EbayCategories', [
            'foreignKey' => 'ebay_category_id',
            'joinType' => 'INNER',
            'className' => 'Ebay.EbayCategories'
        ]);
        $this->belongsTo('ParentEbayCategories', [
            'className' => 'Ebay.EbayCategories',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('EbayCategories', [
            'foreignKey' => 'ebay_category_id',
            'className' => 'Ebay.EbayCategories'
        ]);
        $this->hasMany('ChildEbayCategories', [
            'className' => 'Ebay.EbayCategories',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('EbayCategoryMappings', [
            'foreignKey' => 'ebay_category_id',
            'className' => 'Ebay.EbayCategoryMappings'
        ]);
        $this->hasMany('EbayCategorySpecifics', [
            'foreignKey' => 'ebay_category_id',
            'className' => 'Ebay.EbayCategorySpecifics'
        ]);
        $this->hasMany('EbayListings', [
            'foreignKey' => 'ebay_category_id',
            'className' => 'Ebay.EbayListings'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('category_level', 'valid', ['rule' => 'numeric'])
            ->requirePresence('category_level', 'create')
            ->notEmpty('category_level');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('version', 'valid', ['rule' => 'numeric'])
            ->requirePresence('version', 'create')
            ->notEmpty('version');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['ebay_site_id'], 'EbaySites'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentEbayCategories'));
        return $rules;
    }

    /**
     * Get category by eBay category ID
     *
     * @param integer $ebaySiteId
     * @param integer $ebayCategoryId
     * @return EbayCategory
     */
    public function getCategoryByEbayCategoryId($ebaySiteId, $ebayCategoryId)
    {
        $conditions = [
            $this->getAlias() . '.ebay_site_id' => $ebaySiteId,
            $this->getAlias() . '.ebay_category_id' => $ebayCategoryId
        ];
        $data = $this->find()->where($conditions)->first();
        return $data;
    }

    /**
     * Create / update eBay category
     *
     * @param array $data
     * @return Ambigous <boolean, EntityInterface, \Cake\Datasource\EntityInterface, \Cake\Database\mixed>
     */
    public function saveEbayCategory($data)
    {
        $dbCategory = $this->checkCategoryExists($data['ebay_site_id'], $data['ebay_category_id']);
        if (!empty($dbCategory)) {
            // Update eBay category when exists in DB and DB version number lower than actual ebay version number
            if ($dbCategory->version < $data['version']) {
                $entity = $this->patchEntity($dbCategory, $data);
                $this->save($entity);
            }
        } else {
            $entity = $this->newEntity($data);
            $this->save($entity);
        }
    }

    /**
     * Check, whether category exists
     *
     * @param integer $ebaySiteId
     * @param integer $ebayCategoryId
     * @return EbayCategory
     */
    public function checkCategoryExists($ebaySiteId, $ebayCategoryId)
    {
        $conditions = [
            $this->getAlias() . '.ebay_site_id' => $ebaySiteId,
            $this->getAlias() . '.ebay_category_id' => $ebayCategoryId
        ];
        $data = $this->find()->where($conditions)->first();
        return $data;
    }

    /**
     * @param $ebaySiteId
     * @param $ebayCategoryIds
     * @return array
     */
    public function getTreeByEndCategoryId($ebaySiteId, $ebayCategoryIds)
    {
        if (!is_array($ebayCategoryIds)) {
            $ebayCategoryIds = [$ebayCategoryIds];
        }
        $tree = [];
        foreach ($ebayCategoryIds as $ebayCategoryId) {
            $tmpTree = $this->getSubTree($ebaySiteId, $ebayCategoryId, null);
            if (!empty($tmpTree)) {
                for ($i = 1; $i <= count($tmpTree); $i++) {
                    $tree[$i][$tmpTree[$i]['ebay_category_id']]['name'] = $tmpTree[$i]['name'];
                    $tree[$i][$tmpTree[$i]['ebay_category_id']]['ebay_category_id'] = $tmpTree[$i]['ebay_category_id'];
                    if (isset($tmpTree[$i + 1])) {
                        $tree[$i][$tmpTree[$i]['ebay_category_id']]['childs'][$tmpTree[$i + 1]['ebay_category_id']] = $tmpTree[$i + 1]['name'];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * @param $ebaySiteId
     * @param $ebayCategoryId
     * @param $tree
     * @return mixed
     */
    public function getSubTree($ebaySiteId, $ebayCategoryId, $tree)
    {
        $conditions = [
            $this->getAlias() . '.ebay_site_id' => $ebaySiteId,
            $this->getAlias() . '.ebay_category_id' => $ebayCategoryId
        ];
        $category = $this->find()->where($conditions)->first();

        if (!isset($tree[$category->category_level])) {
            $tree[$category->category_level] = [
                'name' => $category->name,
                'ebay_category_id' => $category->ebay_category_id
            ];
        }

        if ($category->category_level > 1) {
            $conditions = [
                $this->getAlias() . '.ebay_site_id' => $ebaySiteId,
                $this->getAlias() . '.id' => $category->parent_id
            ];
            $cat = $this->find()->where($conditions)->first();
            if (!empty($cat)) {
                $tree = $this->getSubTree($ebaySiteId, $cat->ebay_category_id, $tree);
            }
        }
        return $tree;
    }

    /**
     * @param $categoryPath
     * @return mixed|string
     */
    public function getFullCategoryTreeWithIds($categoryPath)
    {
        if(!empty($categoryPath)) {
            if(!isset($this->ebayCategoryTreePathCache[$categoryPath])) {
                $categoryIds = [];
                $categories = explode('|', $categoryPath);

                foreach($categories as $category)
                {
                    $categoryId = $this->find()->where(['name' => $category])->first();
                    if(!empty($categoryId)) {
                        array_push($categoryIds, $categoryId->ebay_category_id);
                    }
                }

                $categoryFullPathWithIds = implode('>>', $categoryIds);
                $this->ebayCategoryTreePathCache[$categoryPath] = $categoryFullPathWithIds;

                return $categoryFullPathWithIds;
            } else {
                return $this->ebayCategoryTreePathCache[$categoryPath];
            }
        }
    }
}
