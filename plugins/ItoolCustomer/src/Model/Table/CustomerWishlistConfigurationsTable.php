<?php
namespace ItoolCustomer\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerWishlistConfiguration Model
 *
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistConfiguration get($primaryKey, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistConfiguration newEntity($data = null, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistConfiguration[] newEntities(array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistConfiguration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistConfiguration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistConfiguration[] patchEntities($entities, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistConfiguration findOrCreate($search, callable $callback = null, $options = [])
 */
class CustomerWishlistConfigurationsTable extends Table
{

    const BANNER_PRODUCTS_FACTOR = 60;
    const BANNER_SMALL_POSITIONS = [3, 16, 25, 30, 46];
    const BANNER_LARGE_POSITIONS = [6, 36];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('customer_wishlist_configurations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('randomize')
            ->maxLength('randomize', 1)
            ->allowEmpty('randomize');

        $validator
            ->scalar('banner_products_factor')
            ->maxLength('banner_products_factor', 11)
            ->allowEmpty('banner_products_factor');

        $validator
            ->scalar('banner_small_positions')
            ->maxLength('banner_small_positions', 510)
            ->allowEmpty('banner_small_positions');

        $validator
            ->scalar('banner_large_positions')
            ->maxLength('banner_large_positions', 510)
            ->allowEmpty('banner_large_positions');


        return $validator;
    }
}
