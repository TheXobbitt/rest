<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 21:03
 */

namespace rest\models;

use ReflectionClass;
use rest\components\Arrayable;

/**
 * Class Model
 * @package rest\models
 */
class Model implements Arrayable
{
    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $properties = [];
        $reflection = new ReflectionClass($this);
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $properties[$name] = $this->$name;
        };

        return $properties;
    }
}
