<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
service('auth')->routes($routes);


$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->group('cost-centers', function ($routes) {
        $routes->get('/', 'CostCenterController::get');
        $routes->post('/', 'CostCenterController::create');
    });

    $routes->group('users', function ($routes) {
        $routes->get('/', 'UserController::get');
    });
});
