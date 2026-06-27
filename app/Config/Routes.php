<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::registerPost');
