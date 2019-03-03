<?php

$products = new \Phalcon\Mvc\Micro\Collection();
$products->setHandler('\App\Controllers\ProductController', true);
$products->setPrefix('/api/product');
$products->post('/', 'addAction');
$products->get('/', 'getAction');
$products->get('/search/{q}', 'searchAction');
$products->put('/{productId:[1-9][0-9]*}', 'updateAction');
$products->delete('/{productId:[1-9][0-9]*}', 'deleteAction');
$app->mount($products);

// not found URLs
$app->notFound(
    function () use ($app) {
        $exception =
            new \App\Lib\Exceptions\Http404Exception(
                _('URI not found or error in request.'),
                \App\Controllers\ControllerBase::ERROR_NOT_FOUND,
                new \Exception('URI not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
            );
        throw $exception;
    }
);