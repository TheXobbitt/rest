<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 16:57
 */

namespace rest\collections;

use ArrayIterator;
use rest\dto\UrlRule;

class UrlRuleCollection implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @var array
     */
    private $rules = [];

    public function __construct(array $rules)
    {
        foreach ($rules as $rule) {
            if (!$rule instanceof UrlRule) {
                throw new \InvalidArgumentException('Incorrect rule.');
            }
        }

        $this->rules = $rules;
    }

    /**
     * @inheritdoc
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->rules);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->rules);
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, $this->rules);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset) {
        return $this->rules[$offset];
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value) {
        if ($offset) {
            $this->rules[$offset] = $value;
        } else {
            $this->rules[] = $value;
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset) {
        unset($this->rules[$offset]);
    }
}
