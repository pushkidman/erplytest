<?php

namespace App\Lib\Exceptions;

use App\Lib\Exceptions\HttpExceptionBase;

/**
 * Class Http500Exception
 *
 * Exception class for Internal Server Error (500)
 *
 * @package App\Lib\Exceptions
 */
class Http500Exception extends HttpExceptionBase {
    protected $httpCode = 500;
    protected $httpMessage = 'Internal Server Error';

}
