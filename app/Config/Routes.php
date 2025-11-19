<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// HEALTH CHECK (for Railway/monitoring)
$routes->get('/health', 'Health::index');
$routes->get('/health/info', 'Health::info');

$routes->get('/', 'Auth::login');

// AUTH ROUTES
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login_action', 'Auth::login_action');
$routes->get('/register', 'Auth::register');
$routes->post('/register_action', 'Auth::register_action');
$routes->get('/logout', 'Auth::logout');

// DASHBOARD berdasarkan role
$routes->get('/dashboard', 'Dashboard::index'); 
$routes->get('/dashboard_petugas', 'DashboardPetugas::index');
$routes->get('/dashboard_admin', 'DashboardAdmin::index');
$routes->get('/profil', 'ProfilController::index');
$routes->post('/profil/update', 'ProfilController::update');


$routes->get('/pengaduan', 'Dashboard::pengaduan');
$routes->get('/histori', 'Dashboard::histori');

$routes->get('/dashboard/getItems/(:num)', 'Dashboard::getItems/$1');
$routes->post('/dashboard/simpan_pengaduan', 'Dashboard::simpan_pengaduan');
$routes->get('dashboard/pengaduan', 'Dashboard::pengaduan');
$routes->post('dashboard/pengaduan', 'Dashboard::pengaduan');
//edit profil admin
$routes->get('/profil', 'Profil::index');
$routes->post('/profil/update_nama', 'Profil::updateNama');
$routes->post('/profil/update_username', 'Profil::updateUsername');
$routes->post('/profil/update_password', 'Profil::updatePassword');

//edit profil pengguna
$routes->get('/profil_pengguna', 'ProfilPengguna::index');
$routes->post('/profil_pengguna/update_nama', 'ProfilPengguna::updateNama');
$routes->post('/profil_pengguna/update_username', 'ProfilPengguna::updateUsername');
$routes->post('/profil_pengguna/update_password', 'ProfilPengguna::updatePassword');

//edit profil petugas
$routes->get('/profil_petugas', 'ProfilPetugas::index');
$routes->post('/profil_petugas/update_nama', 'ProfilPetugas::updateNama');
$routes->post('/profil_petugas/update_username', 'ProfilPetugas::updateUsername');
$routes->post('/profil_petugas/update_password', 'ProfilPetugas::updatePassword');

$routes->get('/user', 'UserController::index');
$routes->get('/manajemen_user', 'UserController::index');
$routes->post('/user/update', 'UserController::update');
$routes->get('/user/delete/(:num)', 'UserController::delete/$1');
$routes->get('/user/tambah', 'UserController::tambah');
$routes->post('/user/simpan', 'UserController::simpan');

$routes->get('/item', 'ItemController::index');
$routes->post('/item/update', 'ItemController::update');
$routes->get('/item/delete/(:num)', 'ItemController::delete/$1');
$routes->get('/item/tambah', 'ItemController::tambah');
$routes->get('/item/tambah', 'ItemController::tambah');
$routes->post('/item/simpan', 'ItemController::simpan');

$routes->get('/lokasi', 'LokasiController::index');
$routes->post('/lokasi/update', 'LokasiController::update');
$routes->get('/lokasi/delete/(:num)', 'LokasiController::delete/$1');
$routes->get('/lokasi/tambah', 'LokasiController::tambah');
$routes->get('/lokasi/tambah', 'LokasiController::tambah');
$routes->post('/lokasi/simpan', 'LokasiController::simpan');

$routes->get('/list_lokasi', 'ListLokasiController::index');
$routes->post('/list_lokasi/update', 'ListLokasiController::update');
$routes->get('/list_lokasi/delete/(:num)', 'ListLokasiController::delete/$1');
$routes->get('/list_lokasi/tambah', 'ListLokasiController::tambah');
$routes->get('/list_lokasi/tambah', 'ListLokasiController::tambah');
$routes->post('/list_lokasi/simpan', 'ListLokasiController::simpan');

$routes->get('/temporary_item', 'TemporaryItemController::index');
$routes->get('/temporary_item/delete/(:num)', 'TemporaryItemController::delete/$1');

$routes->get('/histori_admin', 'AdminHistoriController::index');
$routes->get('/histori_admin/delete/(:num)', 'AdminHistoriController::delete/$1');

$routes->get('/pengaduan_petugas', 'PengaduanPetugas::index');
$routes->get('/pengaduan_petugas/detail/(:num)', 'PengaduanPetugas::detail/$1');
$routes->post('/pengaduan_petugas/update/(:num)', 'PengaduanPetugas::update/$1');
$routes->get('/manajemen_pengaduan', 'PengaduanPetugas::index');

// LAPORAN ADMIN ROUTES
$routes->get('/admin/laporan', 'Laporan::index');
$routes->get('/admin/laporan/filter', 'Laporan::filter'); 
$routes->post('/admin/laporan/create', 'Laporan::create');
$routes->get('/admin/laporan/detail/(:num)', 'Laporan::detail/$1');
$routes->get('/admin/laporan/delete/(:num)', 'Laporan::delete/$1');

