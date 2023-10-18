<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->resource('cost-centers', ['controller' => 'CostCenterController']);
    $routes->resource('departments', ['controller' => 'DepartmentController']);

    $routes->post('register', 'RegisterController::index');
    $routes->post('login', 'LoginController::index');
    // $routes->get('users', 'UserController::index', ['filter' => 'authFilter']);
    $routes->get('users', 'UserController::index', ['filter' => 'authFilter']);
});
