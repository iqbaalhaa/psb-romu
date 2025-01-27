<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

// Routes untuk Auth
$routes->get('/', 'Home::index');
$routes->post('Auth/CekLogin', 'Auth::CekLogin');
$routes->get('Auth/Logout', 'Auth::Logout');

// Routes untuk Admin
$routes->group('Admin', ['filter' => 'filteradmin'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('index', 'Admin::index');
    // ... route admin lainnya ...
});

// Routes untuk Santri
$routes->group('Santri', ['filter' => 'filtersantri'], function ($routes) {
    $routes->get('/', 'Santri::index');
    $routes->get('index', 'Santri::index');
    // ... route santri lainnya ...
});
