<?php

namespace App\Lib\Exceptions;

/**
 * Class ExceptionBase
 *
 * Runtime Exceptions
 *
 * @package App\Lib\Exceptions
 */
abstract class HttpExceptionBase extends \RuntimeException {

    /**
     * Possible fields in the answer body
     */
    const KEY_CODE = 'error';
    const KEY_DETAILS = 'details';
    const KEY_MESSAGE = 'error_description';

    /**
     * http result code
     *
     * @var null
     */
    protected $httpCode = null;

    /**
     * http error message
     *
     * @var null
     */
    protected $httpMessage = null;

    /**
     * Error info
     *
     * @var array
     */
    protected $appError = [];

    /**
     * @param string $appErrorMessage Exception message
     * @param integer $appErrorCode Exception code
     * @param \Exception $previous Chain of exceptions
     *
     * @throws \RuntimeException
     */
    public function __construct($appErrorMessage = null, $appErrorCode = null, \Exception $previous = null) {
        if (is_null($this->httpCode) || is_null($this->httpMessage)) {
            throw new \RuntimeException('HttpException without httpCode or httpMessage');
        }

        $this->appError = [
            self::KEY_CODE => $appErrorCode,
            self::KEY_MESSAGE => $appErrorMessage
        ];

        parent::__construct($this->httpMessage, $this->httpCode, $previous);
    }

    /**
     * Returns client error
     *
     * @return array|null
     */
    public function getAppError() {
        return $this->appError;
    }

    /**
     * Adding error array
     *
     * @param array|object $fields Array with errors
     *
     * @return $this
     */
    public function addErrorDetails($fields) {
        
        foreach ($fields AS $field) {
            $this->appError[self::KEY_DETAILS][] = $field->__toString();
        }

        // For throw
        return $this;
    }

}
