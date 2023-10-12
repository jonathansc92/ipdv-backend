<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
service('auth')->routes($routes);


$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('/s', 'UserController::get');

    $routes->group('users', function ($routes) {
        $routes->get('/', 'UserController::get');
    });
});