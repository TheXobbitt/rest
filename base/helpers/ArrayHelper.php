<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 15:39
 */

namespace base\helpers;

use base\components\Arrayable;

class ArrayHelper
{
    /**
     * @param mixed $data
     * @return array
     */
    public static function toArray($data): array
    {
        if (is_array($data)) {
            foreach ($data as $key => $item) {
                if ($item instanceof Arrayable || is_array($item)) {
                    $data[$key] = self::toArray($item);
                }
            }

            return $data;
        } elseif ($data instanceof Arrayable) {
            return $data->toArray();
        }

        return [$data];
    }

    /**
     * @param array $data
     * @return array
     */
    public static function getAssocArray(array $data): array
    {
        foreach (array_keys($data) as $key) {
            if (is_int($key)) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
