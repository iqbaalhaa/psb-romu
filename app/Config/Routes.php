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
    $routes->get('PendaftarMTs', 'Admin::PendaftarMTs');
    $routes->get('PendaftarMA', 'Admin::PendaftarMA');
    $routes->get('verifikasiPembayaran/(:num)', 'Admin::verifikasiPembayaran/$1');
    $routes->get('tolakPembayaran/(:num)', 'Admin::tolakPembayaran/$1');
    $routes->get('PembayaranMTs', 'Admin::PembayaranMTs');
    $routes->get('PembayaranMA', 'Admin::PembayaranMA');
    $routes->get('BerkasMTs', 'Admin::BerkasMTs');
    $routes->get('BerkasMA', 'Admin::BerkasMA');
    $routes->get('verifikasiBerkas/(:num)', 'Admin::verifikasiBerkas/$1');
    // ... route admin lainnya ...
});

// Routes untuk Santri
$routes->group('Santri', ['filter' => 'filtersantri'], function ($routes) {
    $routes->get('/', 'Santri::index');
    $routes->get('index', 'Santri::index');
    $routes->get('Pembayaran', 'Santri::Pembayaran');
    $routes->post('uploadBuktiPembayaran', 'Santri::uploadBuktiPembayaran');
    $routes->get('Berkas', 'Santri::Berkas');
    $routes->post('uploadBerkas', 'Santri::uploadBerkas');
    // ... route santri lainnya ...
});

$routes->post('Pendaftaran/SimpanMTs', 'Pendaftaran::SimpanMTs');
$routes->post('Pendaftaran/SimpanMA', 'Pendaftaran::SimpanMA');

$routes->get('Santri/Pembayaran', 'Santri::Pembayaran');
$routes->post('Santri/uploadBuktiPembayaran', 'Santri::uploadBuktiPembayaran');
$routes->get('Santri/Berkas', 'Santri::Berkas');
$routes->post('Santri/uploadBerkas', 'Santri::uploadBerkas');
