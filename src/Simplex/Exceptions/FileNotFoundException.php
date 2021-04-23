<?php

namespace Simplex\Exceptions;

use Throwable;

class FileNotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if ($message === "") {
            $message = "Requested file not found";
        }

        parent::__construct($message, $code, $previous);
    }
}
