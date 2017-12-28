<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 14:19
 */

namespace rest\components;

/**
 * Interface Arrayable
 * @package rest\components
 */
interface Arrayable
{
    /**
     * Convert object to array.
     * @return array
     */
    public function toArray(): array;
}
