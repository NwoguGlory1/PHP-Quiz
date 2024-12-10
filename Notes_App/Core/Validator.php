<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        // Remove leading/trailing whitespace
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) < $max;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function name($value, $min = 1, $max = 50)
    {
        $value = trim($value);
        
        return preg_match('/^[a-zA-Z\s-]+$/', $value) && // Only letters, spaces, and hyphens
        strlen($value) >= $min &&
        strlen($value) <= $max;
    }
}