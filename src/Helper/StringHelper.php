<?php

namespace Eqrepo\Helper;

/**
 * Class StringHelper
 * @package Eqrepo\Helper
 */
class StringHelper
{
    /**
     * @param string $string
     * @return string|null
     */
    public static function notEmptyStringOrNull($string)
    {
        return $string !== '' ? $string : null;
    }
}