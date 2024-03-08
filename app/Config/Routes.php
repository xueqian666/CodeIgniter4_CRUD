<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('user', 'user::index');
$routes->post('user/store', 'user::store');
$routes->get('user/edit/(:num)', 'user::edit/$1');
$routes->get('user/delete/(:num)', 'user::delete/$1');
$routes->post('user/update', 'user::update');