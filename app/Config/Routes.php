<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ACCOUNT MANAJEMENT
$routes->get('/profile', 'AccountController::index', ['filter' => 'login']);
$routes->post('/profile/update/(:segment)', 'AccountController::update/$1');

$routes->get('/', 'Home::index', ['filter' => 'login']);
$routes->get('/login', 'Auth::index');
$routes->post('/resetpassword', 'Auth::resetPassword', ['filter' => 'login']);
//$routes->get('/', 'Home::index');

$routes->group('data-pelanggan', ['filter' => 'login'], function($routes) {
    $routes->get('', 'Pelanggan::index');
    $routes->get('tambah', 'Pelanggan::tambah');
    $routes->get('edit/(:segment)', 'Pelanggan::edit/$1');
    $routes->post('update/(:segment)', 'Pelanggan::update/$1');
    $routes->post('tambah', 'Pelanggan::create');
    $routes->post('delete/(:segment)', 'Pelanggan::delete/$1');
    $routes->post('tambah-user/(:segment)', 'Pelanggan::createUser/$1');
});

$routes->group('data-user', ['filter' => 'login'], function($routes) {
    $routes->get('', 'User::index');
    $routes->get('tambah_pelanggan', 'User::tambah_pelanggan');
    $routes->post('tambah_pelanggan', 'User::create_pelanggan');
    $routes->get('tambah_user', 'User::tambah_user');
    $routes->post('tambah_user', 'User::create_user');
    $routes->get('edit/(:segment)', 'User::edit/$1');
    $routes->post('edit/(:segment)', 'User::update/$1');
    $routes->post('delete/(:segment)', 'User::delete/$1');
});

$routes->group('data-tagihan', ['filter' => 'login'], function($routes) {
    $routes->get('', 'Tagihan::index');
    $routes->get('riwayat', 'Tagihan::riwayat');
    $routes->get('tambah', 'Tagihan::tambah');
    $routes->post('tambah', 'Tagihan::create');
    $routes->post('delete/(:segment)', 'Tagihan::delete/$1');
    $routes->post('bayar/(:segment)', 'PembayaranController::bayar/$1');
    $routes->post('bayar-debt', 'PembayaranController::bayarDept');
});

$routes->group('data-keuangan', ['filter' => 'login'], function($routes) {
    $routes->get('', 'Keuangan::index');
    $routes->get('dana-keluar', 'UangKeluar::index');
    $routes->post('dana-keluar', 'UangKeluar::store');
    $routes->post('dana-keluar/delete/(:segment)', 'UangKeluar::delete/$1');
    $routes->get('dana-masuk', 'UangMasuk::index');
    $routes->post('dana-masuk', 'UangMasuk::store');
    $routes->post('dana-masuk/delete/(:segment)', 'UangMasuk::delete/$1');
    $routes->get('pdf/export', 'PdfController::export');
    $routes->get('excel/export', 'ExcelController::export');
});

$routes->group('data-laporan', ['filter' => 'login'], function($routes) {
    $routes->get('', 'Laporan::index');
    $routes->get('pdf/generate', 'PdfController::generate');
    $routes->get('struk/(:segment)', 'PdfController::struk/$1');
    $routes->get('excel/generate', 'ExcelController::generate');
});

$routes->post('/ajax/data-pelanggan', 'GetAjax::getDataPelangganById');
$routes->post('/ajax/data-tagihan', 'GetAjax::getDataTagiahanById');
$routes->post('/ajax/data-tagihan/getbyidpelanggan', 'GetAjax::getAllDataTagiahanByPelangganId');