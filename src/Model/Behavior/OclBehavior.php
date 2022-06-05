<?php

namespace App\Model\Behavior;

use App\Model\Entity\CoreUser;
use Cake\Network\Session;
use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\Event\Event;
use ArrayObject;
use Cake\Datasource\EntityInterface;

/**
 * Class OclBehavior
 * @package App\Model\Behavior
 */
class OclBehavior extends Behavior
{

    /**
     * @var array
     */
    protected $defaultConfig = [
        'identifier' => 'core_seller_id',
        'db_field' => 'core_seller_id'
    ];
    /**
     * @var array
     */
    protected $config;

    /**
     * @var Session
     */
    protected $session;

    /**
     * Initialize hook
     *
     * @param array $config The config for this behavior.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->config = array_merge($this->defaultConfig, $config);
        $this->session = new Session();
    }


    /**
     * Callback method that listens to the `beforeFind` event in the bound
     * table.
     *
     * @param \Cake\Event\Event $event The beforeFind event that was fired.
     * @param \Cake\ORM\Query $query Query
     * @param \ArrayObject $options The options for the query
     * @return void
     */
    public function beforeFind(Event $event, Query $query, $options)
    {
        if (in_array($this->config['db_field'], $this->_table->getSchema()->columns())) {
            $currentIdentifier = $this->getIdentifier();
            if ($currentIdentifier !== null && is_numeric($currentIdentifier)) {
                $query->andWhere([$this->_table->getAlias() . '.' . $this->config['db_field'] => $currentIdentifier]);
            }
        }
        return $query;
    }


    /**
     * Check the entity before it is saved so that only authorised changes are possible
     *
     * @param \Cake\Event\Event $event The beforeSave event that was fired
     * @param \Cake\Datasource\EntityInterface $entity The entity that is going to be saved
     * @param \ArrayObject $options the options passed to the save method
     * @return void
     */
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (in_array($this->config['db_field'], $this->_table->getSchema()->columns())) {
            $currentIdentifier = $this->getIdentifier();
            if ($currentIdentifier !== null && is_numeric($currentIdentifier) && $entity->isNew() == false) {
                $checkEntity = $this->_table->get($entity->id);
                if ($checkEntity->{$this->config['db_field']} == $currentIdentifier) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return true;
    }


    /**
     * Get identifier number for ocl
     *
     * @return mixed|null
     */
    protected function getIdentifier()
    {
        if ($this->session->read('Auth.User.is_super_user') == CoreUser::SUPER_USER) {
            if ($this->session->read('Auth.User.super_user_' . $this->config['identifier'])) {
                return $this->session->read('Auth.User.super_user_' . $this->config['identifier']);
            }
            return null;
        }
        return $this->session->read('Auth.User.' . $this->config['identifier']);
    }
}
