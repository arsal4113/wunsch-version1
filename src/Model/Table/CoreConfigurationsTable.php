<?php

namespace App\Model\Table;

use App\Application;
use App\Traits\DbCacheTrait;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Exception\Exception;

/**
 * Class CoreConfigurationsTable
 * @package App\Model\Table
 */
class CoreConfigurationsTable extends Table
{
    use DbCacheTrait;

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
        'core_seller_id' => [
            'type' => 'value'
        ],
        'configuration_group' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'configuration_path' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'configuration_value' => [
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
        $this->setTable('core_configurations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Ocl');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'LEFT'
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
            ->allowEmpty('id', 'create')
            ->requirePresence('configuration_group', 'create')
            ->notEmpty('configuration_group')
            ->requirePresence('configuration_path', 'create')
            ->notEmpty('configuration_path')
            ->allowEmpty('configuration_value');

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
        return $rules;
    }

    /**
     * Load seller configuration
     *
     * @param integer $coreSellerId
     * @param string $configurationPath ConfigurationPath needs to be in this format <PLUGIN>/<CONFIGURATION_PATH>
     * @param mixed $defaultValue Return value if no configuration found. Default false.
     * @throws Exception
     * @return string|boolean
     */
    public function loadSellerConfiguration($coreSellerId = null, $configurationPath, $defaultValue = false)
    {
        if (empty($configurationPath)) {
            throw new Exception(__('Configuration path could not be empty.'));
        }

        $configurationGroup = stristr($configurationPath, "/", true);

        if (!empty($configurationGroup)) {
            $configurationPath = substr($configurationPath, strlen($configurationGroup) + 1);
        }

        $conditions = [
            'OR' => [['core_seller_id IS' => null], ['core_seller_id IS' => $coreSellerId]],
            'configuration_group' => $configurationGroup,
            'configuration_path' => $configurationPath
        ];

        if ($this->behaviors()->has('Ocl')){
            $this->removeBehavior('Ocl');
        }
        $configurations = $this->find()
            ->where($conditions)
            ->cache('sellerConfiguration' . $coreSellerId . $configurationPath . $defaultValue, Application::SHORT_TERM_CACHE);

        if (!empty($configurations->toArray())) {
            foreach ($configurations as $configuration) {
                if ($configuration->get('core_seller_id') == $coreSellerId) {
                    return $configuration->get('configuration_value');
                }
            }
            //Return default value if no seller specific configuration defined
            return $configuration->get('configuration_value');
        }

        return $defaultValue;
    }

    /**
     * Get distinct configuration group
     *
     * @return array
     */
    public function getDistinctConfigurationGroup()
    {
        $configGroupNames = $this->find('list', [
            'keyField' => 'configuration_group',
            'valueField' => 'configuration_group'])
            ->distinct(['configuration_group'])
            ->toArray();

        return $configGroupNames;
    }

    /**
     * Get config group names
     *
     * @return array
     */
    public function getConfigGroupNames()
    {
        $configGroupsKeyValue = $this->getDistinctConfigurationGroup();
        $configGroups = [];
        if (!empty($configGroupsKeyValue)) {
            foreach ($configGroupsKeyValue as $name) {
                $configGroups[] = $name;
            }
        }
        return $configGroups;
    }

    /**
     * Get core configuration information
     *
     * @return array
     */
    public function getConfigurationInfo()
    {
        $configurations = $this->find();
        $nestedPath = [];
        foreach ($configurations as $configuration) {
            $path = explode('/', $configuration->configuration_path, 2);
            if (!isset($nestedPath[$configuration->configuration_group][$path[0]])) {
                $nestedPath[$configuration->configuration_group][$path[0]] = [];
            }
            $nestedPath[$configuration->configuration_group][$path[0]][$configuration->id][$path[1]] = $configuration->configuration_value;
        }
        return $nestedPath;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);
        return true;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);
        return true;
    }
}
