<?php

$loader = new \Phalcon\Loader();

// registering a set of directories taken from the configuration file
$loader->registerNamespaces([
    'App\Controllers' => APP_PATH . $config->app->controllersDir,
    'App\Lib' => APP_PATH . $config->app->libDir,
    'App\Models' => APP_PATH . $config->app->modelsDir,
    'App\Services' => APP_PATH . $config->app->servicesDir,
])->register();
