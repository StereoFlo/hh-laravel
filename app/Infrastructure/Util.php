<?php

namespace App\Infrastructure;

/**
 * Class Util
 * @package App\Infrastructure
 */
class Util
{
    /**
     * @param array|object $data
     * @param string       $key
     * @param mixed        $default
     *
     * @return mixed|null
     */
    public static function getProperty($data, $key, $default = null)
    {
        if (empty($data)) {
            return $default;
        }

        if (isset($data) && !isset($key)) {
            return $default;
        }

        switch (true) {
            case is_array($data):
                if (isset($data[$key])) {
                    return $data[$key];
                }

                return $default;
            case is_object($data):
                if (property_exists($data, $key)) {
                    return $data->{$key};
                }

                return $default;
            default:
                return $default;
        }
    }
}
