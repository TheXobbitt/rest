<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 16:08
 */

namespace base\collections;

use ArrayIterator;

/**
 * Class HeaderCollection
 * @package rest\components
 */
class HeaderCollection implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @var array
     */
    private $headers = [];

    /**
     * @inheritdoc
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->headers);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->headers);
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset) {
        return $this->has($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset) {
        return $this->get($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset) {
        unset($this->headers[$offset]);
    }

    /**
     * @param mixed $name
     * @return bool
     */
    public function has($name): bool
    {
        return array_key_exists($name, $this->headers);
    }

    /**
     * @param mixed $name
     * @param mixed $value
     */
    public function set($name, $value): void
    {
        $this->headers[$name] = $value;
    }

    /**
     * @param mixed $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->headers[$name];
    }
}
