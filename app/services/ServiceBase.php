<?php

namespace App\Services;

/**
 * Class ServiceBase
 *
 * @property \Phalcon\Db\Adapter\Pdo\Mysql      $db
 * @property \Phalcon\Config                    $config
 */
abstract class ServiceBase extends \Phalcon\DI\Injectable
{
    /**
     * Invalid parameters anywhere
     */
    const ERROR_INVALID_PARAMETERS = 10001;

    /**
     * Record already exists
     */
    const ERROR_ALREADY_EXISTS = 10002;
}
