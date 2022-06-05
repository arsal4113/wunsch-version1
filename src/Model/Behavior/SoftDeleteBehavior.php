<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\Event\Event;

/**
 * Class SoftDeleteBehavior
 * @package App\Model\Behavior
 */
class SoftDeleteBehavior extends Behavior
{
    /**
     * @var array
     */
    protected $config;
    protected $softDeletedField = 'is_deleted';

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
        if (in_array($this->softDeletedField, $this->_table->getSchema()->columns())) {
            $query->andWhere([$this->_table->getAlias() . '.' . $this->softDeletedField => 0]);
        }
        return $query;
    }
}
