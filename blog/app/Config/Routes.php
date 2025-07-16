<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('posts', 'Admin\PostAdminController::index');
    $routes->get('posts/create', 'Admin\PostAdminController::create');
    $routes->post('posts/store', 'Admin\PostAdminController::store');
    $routes->get('posts/edit/(:num)', 'Admin\PostAdminController::edit/$1');
    $routes->post('posts/update/(:num)', 'Admin\PostAdminController::update/$1');
    $routes->get('posts/delete/(:num)', 'Admin\PostAdminController::delete/$1');
});
