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
    $routes->get('categories', 'Admin\CategoryAdminController::index');
    $routes->get('categories/create', 'Admin\CategoryAdminController::create');
    $routes->post('categories/store', 'Admin\CategoryAdminController::store');
    $routes->get('categories/edit/(:num)', 'Admin\CategoryAdminController::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\CategoryAdminController::update/$1');
    $routes->get('categories/delete/(:num)', 'Admin\CategoryAdminController::delete/$1');
});
