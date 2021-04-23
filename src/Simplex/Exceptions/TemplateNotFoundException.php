<?php

namespace Simplex\Exceptions;

use Throwable;

class TemplateNotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if ($message === "") {
            $message = "The requested template was not found";
        }

        parent::__construct($message, $code, $previous);
    }
}
