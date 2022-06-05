<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-12-06
 * Time: 11:03
 */

namespace Feeder\Model\Behavior;


use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Query;

class TimeRangeBehavior extends Behavior
{
    protected $defaultConfig = [
        'start_field' => 'start_time',
        'end_field' => 'end_time'
    ];

    protected $config;


    /**
     * Initialize hook
     *
     * @param array $config The config for this behavior.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->config = array_merge($this->defaultConfig, $config);
    }

    /**
     * Return config value for a specific config key
     *
     * @param $configKey
     * @return mixed|null
     */
    protected function getConfigValue($configKey)
    {
        return $this->config[$configKey] ?? null;
    }


    /**
     * Callback method that listens to the `beforeFind` event in the bound table.
     *
     * @param Event $event
     * @param Query $query
     * @param $options
     * @return Query
     */
    public function beforeFind(Event $event, Query $query, $options)
    {
        $columns = $this->getTable()->getSchema()->columns();

        $startField = $this->getConfigValue('start_field');
        $endField = $this->getConfigValue('end_field');
        $now = date('Y-m-d H:i:s');

        if (in_array($startField, $columns)) {
            $fullStartField = $this->getTable()->getAlias() . '.' . $startField;
            $query->andWhere(['OR' => [$fullStartField . ' IS' => null, $fullStartField . ' <=' => $now]]);
        }

        if (in_array($endField, $columns)) {
            $fullEndField = $this->getTable()->getAlias() . '.' . $endField;
            $query->andWhere(['OR' => [$fullEndField . ' IS' => null, $fullEndField . ' >=' => $now]]);
        }
        return $query;
    }
}