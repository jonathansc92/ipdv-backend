<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'cors'], function ($routes) {
    $routes->resource('cost-centers', ['controller' => 'CostCenterController']);
    $routes->resource('departments', ['controller' => 'DepartmentController']);
    $routes->resource('users', ['controller' => 'UserController'], ['filter' => 'authFilter']);

    $routes->post('register', 'RegisterController::index');
    $routes->post('login', 'LoginController::index');
});
