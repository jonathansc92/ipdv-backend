<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
service('auth')->routes($routes);


$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->resource('cost-centers', ['controller' => 'CostCenterController']);

    $routes->group('users', function ($routes) {
        $routes->get('/', 'UserController::get');
    });
});
