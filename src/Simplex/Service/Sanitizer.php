<?php

namespace Simplex\Service;

class Sanitizer
{
    public static function sanitize()
    {
        if (!empty($_GET)) {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        }

        if (!empty($_POST)) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        }

        if (!empty($_REQUEST)) {
            self::trimAndSanitizeArray($_REQUEST);
        }
    }

    public static function trimAndSanitizeArray(array &$array)
    {
        array_walk_recursive($array, function (&$value) {
            $value = trim($value);
            $value = filter_var($value, FILTER_SANITIZE_STRING);
        });
    }
}
