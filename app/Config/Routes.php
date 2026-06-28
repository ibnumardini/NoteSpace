<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Note::index', ['filter' => 'auth']);
$routes->get('archived', 'Note::archived', ['filter' => 'auth']);
$routes->get('archived/(:num)', 'Note::show/$1', ['filter' => 'auth']);
$routes->get('trash', 'Note::trash', ['filter' => 'auth']);
$routes->get('create', 'Note::create', ['filter' => 'auth']);
$routes->post('create', 'Note::store', ['filter' => 'auth']);
$routes->get('(:num)', 'Note::show/$1', ['filter' => 'auth']);
$routes->get('(:num)/edit', 'Note::edit/$1', ['filter' => 'auth']);
$routes->post('(:num)/edit', 'Note::update/$1', ['filter' => 'auth']);

$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('register', 'Auth::register', ['filter' => 'guest']);
    $routes->post('register', 'Auth::registerPost', ['filter' => 'guest']);

    $routes->get('login', 'Auth::login', ['filter' => 'guest']);
    $routes->post('login', 'Auth::loginPost', ['filter' => 'guest']);

    $routes->get('logout', 'Auth::logout', ['filter' => 'auth']);
});
