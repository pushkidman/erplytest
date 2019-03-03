<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Class ControllerBase
 *
 * @property \Phalcon\Http\Request              $request
 * @property \Phalcon\Http\Response             $htmlResponse
 * @property \Phalcon\Db\Adapter\Pdo\Mysql      $db
 * @property \Phalcon\Config                    $config
 * @property \App\Services\ProductService       $productService
 * @property \App\Models\Product                $product
 */
abstract class ControllerBase extends Controller {

    /**
     * Route not found. HTTP 404 Error
     */
    const ERROR_NOT_FOUND = 1;

    /**
     * Invalid Request. HTTP 400 Error.
     */
    const ERROR_INVALID_REQUEST = 2;

}
