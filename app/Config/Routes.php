<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
service('auth')->routes($routes);


$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    // $routes->group('cost-centers', function ($routes) {
    //     $routes->get('/', 'CostCenterController::get');
    //     $routes->get('/(:num)', 'CostCenterController::show/$1');
    //     $routes->post('/', 'CostCenterController::store');
    // });

    $routes->resource('cost-centers', ['controller' => 'CostCenterController']);

    $routes->group('users', function ($routes) {
        $routes->get('/', 'UserController::get');
    });
});
