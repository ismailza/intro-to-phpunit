<?php

namespace App\Exceptions;

use Exception;

class CurrencyNotFoundException extends Exception
{
    /**
     * CurrencyNotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $message = 'Undefined currency', int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
