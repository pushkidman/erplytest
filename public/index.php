<?php

error_reporting(E_ALL);

use Phalcon\Mvc\Micro;
use App\Lib\Exceptions\HttpExceptionBase;

try {

    define('APP_PATH', realpath('..') . '/');

    // read the configuration
    $config = require APP_PATH . 'app/config/config.php';

    // auto-loader configuration
    require APP_PATH . 'app/config/loader.php';

    // load application services
    require APP_PATH . 'app/config/di.php';

    // initializing application
    $app = new Micro();
    $app->setDI($di);

    // setting up routing
    require APP_PATH . 'app/config/routes.php';

    // making the correct answer after executing
    $app->after(
            function () use ($app) {
        // getting the return value of method
        $return = $app->getReturnedValue();

        if (is_array($return)) {
            // transforming arrays to JSON
            $app->response->setStatusCode('200', 'OK');
            $app->response->setContent(json_encode($return));
        } elseif (!strlen($return)) {
            // successful response without any content
            $app->response->setStatusCode('204', 'No Content');
        } else {
            // unexpected response
            throw new Exception('Bad Response');
        }
        // sending response to the client
        $app->response->send();
    }
    );

    // processing request
    $app->handle();
} catch (HttpExceptionBase $e) {
    $response = $app->response;
    $response->setStatusCode($e->getCode(), $e->getMessage());
    $response->setJsonContent($e->getAppError());
    $response->send();
} catch (\Phalcon\Http\Request\Exception $e) {
    $app->response->setStatusCode(400, 'Bad request');
    $app->response->setJsonContent([
        HttpExceptionBase::KEY_CODE => 400,
        HttpExceptionBase::KEY_MESSAGE => 'Bad request'
    ]);
    $app->response->send();
} catch (\Exception $e) {
    // standard error format
    $result = [
        HttpExceptionBase::KEY_CODE => 500,
        HttpExceptionBase::KEY_MESSAGE => 'Error occurred on the server.'
    ];
    // sending error response
    $app->response->setStatusCode(500, 'Internal Server Error');
    $app->response->setJsonContent($result);
    $app->response->send();
}