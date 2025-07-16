<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Admin\PostAdminController;
use App\Controllers\Admin\CategoryAdminController;
use App\Controllers\User\UserDashboardController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function() {
    return redirect()->to('/login');
});

// Shield routes
service('auth')->routes($routes);

// Auth redirect route
$routes->get('auth/redirect', 'AuthRedirectController::loginRedirect');

$routes->group('admin', ['filter' => 'session'], function($routes) {
    // Posts routes with permissions
    $routes->get('posts', [PostAdminController::class, 'index'], ['filter' => 'permission:blog.posts.view']);
    $routes->get('posts/create', [PostAdminController::class, 'create'], ['filter' => 'permission:blog.posts.create']);
    $routes->post('posts/store', [PostAdminController::class, 'store'], ['filter' => 'permission:blog.posts.create']);
    $routes->get('posts/edit/(:num)', [PostAdminController::class, 'edit/$1'], ['filter' => 'permission:blog.posts.edit']);
    $routes->post('posts/update/(:num)', [PostAdminController::class, 'update/$1'], ['filter' => 'permission:blog.posts.edit']);
    $routes->get('posts/delete/(:num)', [PostAdminController::class, 'delete/$1'], ['filter' => 'permission:blog.posts.delete']);
    
    // Categories routes with permissions
    $routes->get('categories', [CategoryAdminController::class, 'index'], ['filter' => 'permission:blog.categories.view']);
    $routes->get('categories/create', [CategoryAdminController::class, 'create'], ['filter' => 'permission:blog.categories.create']);
    $routes->post('categories/store', [CategoryAdminController::class, 'store'], ['filter' => 'permission:blog.categories.create']);
    $routes->get('categories/edit/(:num)', [CategoryAdminController::class, 'edit/$1'], ['filter' => 'permission:blog.categories.edit']);
    $routes->post('categories/update/(:num)', [CategoryAdminController::class, 'update/$1'], ['filter' => 'permission:blog.categories.edit']);
    $routes->get('categories/delete/(:num)', [CategoryAdminController::class, 'delete/$1'], ['filter' => 'permission:blog.categories.delete']);
});

$routes->group('user', ['filter' => 'session'], function($routes) {
    $routes->get('dashboard', [UserDashboardController::class, 'index']);
});

