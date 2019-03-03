<?php

namespace App\Lib\Exceptions;

use App\Lib\Exceptions\HttpExceptionBase;

/**
 * Class Http422Exception
 *
 * Exception class for Unprocessable entity Error (422)
 *
 * @package App\Lib\Exceptions
 */
class Http422Exception extends HttpExceptionBase {
    
    protected $httpCode = 422;
    protected $httpMessage = 'Unprocessable entity';
    
}
