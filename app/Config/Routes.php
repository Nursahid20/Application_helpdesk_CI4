<?php

namespace Config;

use phpDocumentor\Reflection\Types\Void_;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('/admin', 'Admin::/index', ['filter' => 'auth']);

$routes->get('/admin/userRequest', 'Admin::userRequest/index', ['filter' => 'auth']);
$routes->get('/admin/userRequest/index', 'Admin::userRequest/index', ['filter' => 'auth']);

$routes->get('/admin/addUser', 'Admin::addUser/index', ['filter' => 'auth']);
$routes->get('/admin/addUser/index', 'Admin::addUser/index', ['filter' => 'auth']);

$routes->get('/admin/editEmploye/(:segmen)', 'Admin::editEmploye/$i', ['filter' => 'auth']);

$routes->get('/user/request', 'User::request/index', ['filter' => 'auth']);
$routes->get('/user/request/index', 'User::request/index', ['filter' => 'auth']);

$routes->get('/user/addRequest', 'User::addRequest/index', ['filter' => 'auth']);
$routes->get('/user/addRequest/index', 'User::addRequest/index', ['filter' => 'auth']);

$routes->get('/staffIT/userRequest', 'StaffIT::userRequest/index', ['filter' => 'auth']);
$routes->get('/staffIT/userRequest/index', 'StaffIT::userRequest/index', ['filter' => 'auth']);

$routes->delete('/admin/userRequest/(:num)', 'Admin::request_delete/$1');
$routes->delete('/user/request/(:num)', 'User::request_delete/$1');
$routes->delete('/admin/user/(:num)', 'Admin::user_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/karyawan/(:num)', 'Admin::karyawan_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/ITSupport/(:num)', 'Admin::it_support_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/jabatan/(:num)', 'Admin::jabatan_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/departemen/(:num)', 'Admin::departemen_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/prioritas/(:num)', 'Admin::prioritas_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/kategori/(:num)', 'Admin::kategori_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/lampiran/(:num)', 'Admin::lampiran_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/status/(:num)', 'Admin::status_delete/$1', ['filter' => 'auth']);
$routes->delete('/admin/informasi/(:num)', 'Admin::informasi_delete/$1', ['filter' => 'auth']);



// contoh
// $routes->get('admin', 'Admin::index', ['filter' => 'role:admin']);
// $routes->get('admin/index', 'Admin::index', ['filter' => 'role:admin']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
