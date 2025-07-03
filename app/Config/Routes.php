<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/login/process', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

// $routes->get('/dashboard', 'DashboardController::index');

// Routes untuk Admin
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    // $routes->get('dashboard', 'DashboardController::adminDashboard');
    //admin - mahasiswa
    $routes->get('mahasiswa/mahasiswa', 'AdminController::manageMahasiswa');
    $routes->get('mahasiswa/create', 'AdminController::createmhs');
    $routes->post('mahasiswa/store', 'AdminController::storemhs');
    $routes->get('mahasiswa/edit/(:num)', 'AdminController::editmhs/$1');
    $routes->post('mahasiswa/mahasiswa/update/(:num)', 'AdminController::updatemhs/$1');
    $routes->get('mahasiswa/mahasiswa/delete/(:num)', 'AdminController::deletemhs/$1');


    //admin - dosen
    $routes->get('dosen/index', 'AdminController::manageDosen');
    $routes->get('dosen/create', 'AdminController::createdosen');
    $routes->post('dosen/index/store', 'AdminController::storedosen');
    $routes->get('dosen/edit/(:num)', 'AdminController::editdosen/$1');
    $routes->post('dosen/index/update/(:num)', 'AdminController::updatedosen/$1');
    $routes->get('dosen/index/delete/(:num)', 'AdminController::deletedosen/$1');

    // admin - mk
    $routes->get('mata_kuliah/index', 'AdminController::manageMataKuliah');
    $routes->get('mata_kuliah/create', 'AdminController::createmk');
    $routes->post('mata_kuliah/index/store', 'AdminController::storemk');
    $routes->get('mata_kuliah/edit/(:num)', 'AdminController::editmk/$1');
    $routes->post('mata_kuliah/update/(:num)', 'AdminController::updatemk/$1');
    $routes->get('mata_kuliah/index/delete/(:num)', 'AdminController::deletemk/$1');

    //admin - jadwal
    $routes->get('jadwal/index', 'AdminController::manageJadwal');
    $routes->get('jadwal/create', 'AdminController::createjdwl');
    $routes->post('jadwal/index/store', 'AdminController::storejdwl');
    $routes->get('jadwal/edit/(:num)', 'AdminController::editjdwl/$1');
    $routes->post('jadwal/update', 'AdminController::updatejdwl');
    $routes->get('jadwal/index/delete/(:num)', 'AdminController::deletejdwl/$1');
    $routes->get('jadwal/detail_jadwal/(:num)', 'AdminController::detailJadwal/$1');
    $routes->post('jadwal/detail_jadwal/tambah', 'AdminController::tambahMahasiswaKeJadwal');
    $routes->post('jadwal/detail_jadwal/hapus/(:num)/(:num)', 'AdminController::hapusMahasiswaDariJadwal/$1/$2');


    $routes->get('laporan', 'AdminController::laporan');
    $routes->get('notifikasi', 'AdminController::manageNotifikasi');
    $routes->get('users', 'AdminController::manageUsers');
});


// Routes untuk Dosen
$routes->group('dosen', ['filter' => 'auth:dosen'], function ($routes) {
    
    $routes->post('nilai/input_nilai/update/', 'DosenController::updateNilai');
    $routes->get('nilai/input_nilai/(:num)/(:num)', 'DosenController::inputNilai/$1/$2');

    $routes->get('nilai/nilai/(:num)', 'DosenController::lihatNilai/$1');
    $routes->get('jadwal/index', 'DosenController::jadwal');
    $routes->get('nilai/create', 'NilaiController::create');
    $routes->get('detail/(:num)', 'DosenController::detail/$1');
});

// Routes untuk Mahasiswa
$routes->group('mahasiswa', ['filter' => 'auth:mahasiswa'], function ($routes) {
    $routes->get('nilai/nilai/(:num)', 'MahasiswaController::lihatNilai/$1');
    $routes->get('krs/index', 'MahasiswaController::krs');
    $routes->get('khs/dashboard', 'MahasiswaController::khs');
});

$routes->group('jadwal', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'JadwalController::index');
    $routes->get('create', 'JadwalController::create');
    $routes->post('store', 'JadwalController::store');
});

$routes->group('krs', ['filter' => 'auth'], function ($routes) {
    $routes->get('index', 'KrsController::index');
    $routes->get('create', 'KrsController::create');
    $routes->post('store', 'KrsController::store');
});

$routes->group('khs', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'KhsController::index');
});




// $routes->get('/dashboard', 'DashboardController::index');

// $routes->get('/mahasiswa', 'MahasiswaController::index');
// $routes->get('/mahasiswa/create', 'MahasiswaController::create');
// $routes->post('/mahasiswa/store', 'MahasiswaController::store');

// $routes->get('/dosen', 'DosenController::index');
// $routes->get('/dosen/create', 'DosenController::create');
// $routes->post('/dosen/store', 'DosenController::store');

// $routes->get('/matakuliah', 'MataKuliahController::index');
// $routes->get('/matakuliah/create', 'MataKuliahController::create');
// $routes->post('/matakuliah/store', 'MataKuliahController::store');

// $routes->get('/nilai', 'NilaiController::index');
// $routes->get('/nilai/create', 'NilaiController::create');
// $routes->post('/nilai/store', 'NilaiController::store');
