<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/data-pelanggan', 'Pelanggan::index');
$routes->get('/data-pelanggan/tambah', 'Pelanggan::tambah');
$routes->get('/data-pelanggan/edit/(:segment)', 'Pelanggan::edit/$1');
$routes->post('/data-pelanggan/update/(:segment)', 'Pelanggan::update/$1');
$routes->post('/data-pelanggan/tambah', 'Pelanggan::create');
$routes->post('/data-pelanggan/delete/(:segment)', 'Pelanggan::delete/$1');

$routes->post('/data-pelanggan/tambah-user/(:segment)', 'Pelanggan::createUser/$1');
$routes->get('/data-user', 'User::index');
$routes->get('/data-user/tambah', 'User::tambah');
$routes->post('/data-user/delete/(:segment)', 'User::delete/$1');

$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout');

$routes->get('/data-tagihan', 'Tagihan::index');
$routes->get('/data-tagihan/tambah', 'Tagihan::tambah');
$routes->post('/data-tagihan/tambah', 'Tagihan::create');
$routes->post('/data-tagihan/delete/(:segment)', 'Tagihan::delete/$1');

$routes->post('/data-tagihan/bayar/(:segment)', 'PembayaranController::bayar/$1');
$routes->post('/data-tagihan/bayar-debt', 'PembayaranController::bayarDept');

$routes->get('/data-keuangan', 'Keuangan::index');
$routes->get('/data-laporan', 'Laporan::index');

// PDF GENERATE
$routes->get('/data-laporan/pdf/generate', 'PdfController::generate');
// STRUK GENERATE
$routes->get('/data-laporan/struk/(:segment)', 'PdfController::struk');

$routes->get('/data-laporan/excel/export', 'ExcelController::export');
// AJAX DATA
$routes->post('/ajax/data-tagihan', 'GetAjax::getDataTagiahanById');
$routes->post('/ajax/data-tagihan/getbyidpelanggan', 'GetAjax::getAllDataTagiahanByPelangganId');