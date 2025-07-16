<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\AuthController;
use App\Controllers\Admin\PostAdminController;
use App\Controllers\Admin\CategoryAdminController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [AuthController::class, 'login']);

$routes->get('login', [AuthController::class, 'login']);
$routes->post('login', [AuthController::class, 'attemptLogin']);
$routes->get('logout', [AuthController::class, 'logout']);
$routes->get('register', [AuthController::class, 'register']);
$routes->post('register', [AuthController::class, 'attemptRegister']);

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('posts', [PostAdminController::class, 'index']);
    $routes->get('posts/create', [PostAdminController::class, 'create']);
    $routes->post('posts/store', [PostAdminController::class, 'store']);
    $routes->get('posts/edit/(:num)', [PostAdminController::class, 'edit/$1']);
    $routes->post('posts/update/(:num)', [PostAdminController::class, 'update/$1']);
    $routes->get('posts/delete/(:num)', [PostAdminController::class, 'delete/$1']);
    $routes->get('categories', [CategoryAdminController::class, 'index']);
    $routes->get('categories/create', [CategoryAdminController::class, 'create']);
    $routes->post('categories/store', [CategoryAdminController::class, 'store']);
    $routes->get('categories/edit/(:num)', [CategoryAdminController::class, 'edit/$1']);
    $routes->post('categories/update/(:num)', [CategoryAdminController::class, 'update/$1']);
    $routes->get('categories/delete/(:num)', [CategoryAdminController::class, 'delete/$1']);
});
