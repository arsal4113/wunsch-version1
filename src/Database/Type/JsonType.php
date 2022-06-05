<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 27.04.15
 * Time: 14:51
 */
namespace App\Database\Type;


use Cake\Database\Driver;
use Cake\Database\Type;
use PDO;

/**
 * Class JsonType
 * @package App\Database\Type
 */
class JsonType extends Type
{

    /**
     * @param mixed $value
     * @param Driver $driver
     * @return mixed|null
     */
    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }
        return json_decode($value, true);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function marshal($value)
    {
        if (is_array($value) || $value === null) {
            return $value;
        }
        return json_decode($value, true);
    }

    /**
     * @param mixed $value
     * @param Driver $driver
     * @return string
     */
    public function toDatabase($value, Driver $driver)
    {
        return json_encode($value);
    }

    /**
     * @param mixed $value
     * @param Driver $driver
     * @return int
     */
    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_STR;
    }

}