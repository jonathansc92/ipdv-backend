<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->resource('cost-centers', ['controller' => 'CostCenterController', 'filter' => 'authFilter']);
    $routes->resource('departments', ['controller' => 'DepartmentController', 'filter' => 'authFilter']);
    $routes->resource('users', ['controller' => 'UserController'], ['filter' => 'authFilter']);

    $routes->post('register', 'RegisterController::index');
    $routes->post('login', 'LoginController::index');
});
