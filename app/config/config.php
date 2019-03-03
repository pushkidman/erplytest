<?php

use Phalcon\Config;

return new Config([
    'database' => [
        'adapter'  => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'Sandali2009',
        'dbname' => 'erply',
        'charset'   =>'utf8'
    ],
    'app' => [
        'controllersDir' => 'app/controllers/',
        'modelsDir' => 'app/models/',
        'libDir' => 'app/lib/',
        'servicesDir' => 'app/services/',
        'baseUri' => 'http://erply.local/',
    ]
]);

