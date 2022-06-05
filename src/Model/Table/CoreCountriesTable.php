<?php
namespace App\Model\Table;

use App\Model\Entity\CoreCountry;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoreCountries Model
 *
 * @property \Cake\ORM\Association\HasMany $CoreSellers
 */
class CoreCountriesTable extends Table
{

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
        'iso_code' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'iso_code_3166_2' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'default_tax' => [
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
        parent::initialize($config);

        $this->table('core_countries');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->hasMany('CoreSellers', [
            'foreignKey' => 'core_country_id'
        ]);

        $this->addBehavior('Translate', [
            'fields' => ['name'],
            'translationTable' => 'translation_core_countries'
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
            ->requirePresence('iso_code', 'create')
            ->notEmpty('iso_code');

        $validator
            ->requirePresence('iso_code_3166_2', 'create')
            ->notEmpty('iso_code_3166_2');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('default_tax', 'valid', ['rule' => 'decimal'])
            ->requirePresence('default_tax', 'create')
            ->notEmpty('default_tax');

        return $validator;
    }
}
