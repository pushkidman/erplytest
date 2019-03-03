<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

// automatically register the right services providing a full stack framework
$di = new FactoryDefault();

// global config
$di->setShared('config', $config);

// overriding Response-object to set the Content-type header globally
$di->setShared('response', function () {
    $response = new \Phalcon\Http\Response();
    $response->setContentType('application/json', 'utf-8');
    return $response;
});

// database connection is created based in the parameters defined in the configuration file
$di->setShared('db', function () use ($config) {
    $connection = new DbAdapter([
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        'options' => [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
    ]);
    return $connection;
});

// service to perform operations with products
$di->setShared('productService', '\App\Services\ProductService');

