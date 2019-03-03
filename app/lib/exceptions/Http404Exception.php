<?php

namespace App\Lib\Exceptions;

use App\Lib\Exceptions\HttpExceptionBase;

/**
 * Class Http404Exception
 *
 * Exception class for Not Found Error (404)
 *
 * @package App\Lib\Exceptions
 */
class Http404Exception extends HttpExceptionBase {

    protected $httpCode = 404;
    protected $httpMessage = 'Not Found';

}
