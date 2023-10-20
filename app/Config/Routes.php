<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'cors'], function ($routes) {
    $routes->resource('cost-centers', ['controller' => 'CostCenterController', 'filter' => 'authFilter']);
    $routes->resource('departments', ['controller' => 'DepartmentController', 'filter' => 'authFilter']);

    $routes->get('users', 'UserController::index', ['filter' => 'authFilter']);
    $routes->get('users/(:num)', 'UserController::show/$1', ['filter' => 'authFilter']);
    $routes->post('users', 'UserController::create');
    $routes->put('users/(:num)', 'UserController::update/$1', ['filter' => 'authFilter']);
    $routes->delete('users/(:num)', 'UserController::delete/$1', ['filter' => 'authFilter']);

    $routes->post('auth/login', 'AuthController::login');
});
