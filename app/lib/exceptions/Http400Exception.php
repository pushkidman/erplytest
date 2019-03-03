<?php

namespace App\Lib\Exceptions;

use App\Lib\Exceptions\HttpExceptionBase;

/**
 * Class Http400Exception
 *
 * Exception class for Bad Request Error (400)
 *
 * @package App\Lib\Exceptions
 */
class Http400Exception extends HttpExceptionBase
{
    protected $httpCode = 400;
    protected $httpMessage = 'Bad request';
}
