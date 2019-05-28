<?php

namespace spresnac\Helper;

use Carbon\Carbon;
use Exception;

/**
 * Class DatesHelper
 *
 * @package spresnac\Helper
 */
class DatesHelper
{

    /**
     * Return a normalized date string (current=W3C String Format)
     *
     * @param $input Carbon|null
     * @return string either w3c-formatted string or empty string
     */
    public static function format($input) : string
    {
        if ($input instanceof Carbon) {
            return $input->toW3cString();
        } elseif (is_string($input) === true && $input !== '') {
            try {
                $_tmp = new Carbon($input);
                return $_tmp->toW3cString();
            } catch (Exception $e) {
            }
        }
        return '';
    }
}
