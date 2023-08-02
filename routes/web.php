<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelolaAkunController;
use App\Http\Controllers\MappingJadwalController;
use App\Http\Controllers\MappingKelasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(HomeController::class)->name('home.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate')->name('login.authenticate')->middleware('guest');

    Route::post('/logout', 'logout')->name('login.logout')->middleware('auth');
});

Route::controller(RegisterController::class)->name('register.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/register', 'index')->name('index');
    Route::post('/register', 'store')->name('store');
});

Route::controller(ChangePasswordController::class)->name('changePassword.')->middleware('auth')->group(function () {
    Route::get('/change-password', 'index')->name('index');
    Route::post('/change-password', 'update')->name('update');
});

Route::controller(KelolaAkunController::class)->name('kelolaAkun.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/kelola-akun', 'index')->name('index');
    Route::get('/dashboard/kelola-akun/tambah-akun', 'create')->name('create');
    Route::get('/dashboard/kelola-akun/view-akun/{id}', 'show')->name('show');

    Route::post('/dashboard/kelola-akun/tambah-akun', 'store')->name('store');
    Route::delete('/dashboard/kelola-akun/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/kelola-akun/ubah-akun/{id}/edit', 'edit')->name('edit');
        Route::put('/dashboard/kelola-akun/{id}', 'update')->name('update');
});

Route::controller(DashboardController::class)->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/dashboard', 'index')->name('index');
});

Route::controller(PengumumanController::class)->name('pengumuman.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/pengumuman', 'index')->name('index');
    Route::get('/dashboard/pengumuman/tambah-pengumuman', 'create')->name('create');
    Route::get('/dashboard/pengumuman/view-pengumuman/{id}', 'show')->name('show');

    Route::post('/dashboard/pengumuman/tambah-pengumuman', 'store')->name('store');
    Route::delete('/dashboard/pengumuman/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/pengumuman/ubah-pengumuman/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/pengumuman/{id}', 'update')->name('update');
});

Route::controller(SiswaController::class)->name('siswa.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/siswa', 'index')->name('index');
    Route::get('/dashboard/siswa/tambah-siswa', 'create')->name('create');
    Route::get('/dashboard/siswa/view-siswa/{id}', 'show')->name('show');

    Route::post('/dashboard/siswa/tambah-siswa', 'store')->name('store');
    Route::delete('/dashboard/siswa/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/siswa/ubah-siswa/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/siswa/{id}', 'update')->name('update');
});

Route::controller(GuruController::class)->name('guru.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/guru', 'index')->name('index');
    Route::get('/dashboard/guru/tambah-guru', 'create')->name('create');
    Route::get('/dashboard/guru/view-guru/{id}', 'show')->name('show');

    Route::post('/dashboard/guru/tambah-guru', 'store')->name('store');
    Route::delete('/dashboard/guru/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/guru/ubah-guru/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/guru/{id}', 'update')->name('update');
});

Route::controller(KelasController::class)->name('kelas.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/kelas', 'index')->name('index');
    Route::get('/dashboard/kelas/tambah-kelas', 'create')->name('create');
    Route::get('/dashboard/kelas/view-kelas/{id}', 'show')->name('show');

    Route::post('/dashboard/kelas/tambah-kelas', 'store')->name('store');
    Route::delete('/dashboard/kelas/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/kelas/ubah-kelas/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/kelas/{id}', 'update')->name('update');
});

Route::controller(TahunAjaranController::class)->name('tahunajaran.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/tahunajaran', 'index')->name('index');

    Route::get('/dashboard/tahunajaran/tambah-tahunajaran', 'create')->name('create');
    Route::get('/dashboard/tahunajaran/tambah-tahunajaran/semester', 'createSemester')->name('createSemester');

    Route::get('/dashboard/tahunajaran/view-tahunajaran/{id}', 'show')->name('show');

    Route::post('/dashboard/tahunajaran/tambah-tahunajaran', 'store')->name('store');
    Route::post('/dashboard/tahunajaran/tambah-tahunajaran/semester', 'storeSemester')->name('storeSemester');

    Route::delete('/dashboard/tahunajaran/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/tahunajaran/ubah-tahunajaran/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/tahunajaran/{id}', 'update')->name('update');
});

Route::controller(PelajaranController::class)->name('pelajaran.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/pelajaran', 'index')->name('index');
    Route::get('/dashboard/pelajaran/tambah-pelajaran', 'create')->name('create');
    Route::get('/dashboard/pelajaran/view-pelajaran/{id}', 'show')->name('show');

    Route::post('/dashboard/pelajaran/tambah-pelajaran', 'store')->name('store');
    Route::delete('/dashboard/pelajaran/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/pelajaran/ubah-pelajaran/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/pelajaran/{id}', 'update')->name('update');
});

Route::controller(MappingKelasController::class)->name('mappingkelas.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/mappingkelas', 'index')->name('index');
    Route::get('/dashboard/mappingkelas/tambah-mappingkelas', 'create')->name('create');
    Route::get('/dashboard/mappingkelas/view-mappingkelas/{id}', 'show')->name('show');

    Route::post('/dashboard/mappingkelas/tambah-mappingkelas', 'store')->name('store');
    Route::delete('/dashboard/mappingkelas/{id}', 'destroykelas')->name('destroykelas');

    Route::get('/dashboard/mappingkelas/tambah-datasiswa', 'createsiswa')->name('createsiswa');
    Route::get('/dashboard/mappingkelas/tambah-datasiswa/{nis}/getNis', 'getSiswaList')->name('getSiswaList');
    Route::get('/dashboard/mappingkelas/tambah-datasiswa/{nmSiswa}/getNmSiswa', 'getNmSiswaList')->name('getNmSiswaList');

    Route::post('/dashboard/mappingkelas/tambah-datasiswa', 'storesiswa')->name('storesiswa');
    Route::delete('/dashboard/mappingkelas/tambah-datasiswa/{id}', 'destroysiswa')->name('destroysiswa');
    Route::delete('/dashboard/mappingkelas/tambah-datasiswa/{id}/delete', 'destroykelasid')->name('destroykelasid');
    
    Route::get('/dashboard/mappingkelas/ubah-mappingkelas/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/mappingkelas/{id}', 'update')->name('update');
    
    Route::get('/dashboard/mappingkelas/ubah-datasiswa/{id}/edit', 'editsiswa')->name('editsiswa');
    Route::put('/dashboard/mappingkelas/ubah-datasiswa/{id}', 'updatesiswa')->name('updatesiswa');
    Route::delete('/dashboard/mappingkelas/ubah-datasiswa/{id}/edit', 'destroyubahsiswa')->name('destroyubahsiswa');
    Route::delete('/dashboard/mappingkelas/ubah-datasiswa/{id}/delete', 'destroykelasid')->name('destroykelasid');
});

Route::controller(MappingJadwalController::class)->name('mappingjadwal.')->middleware('auth', 'user-role:superadmin')->group(function () {
    Route::get('/dashboard/mappingjadwal', 'index')->name('index');
    Route::get('/dashboard/mappingjadwal/tambah-mappingjadwal', 'create')->name('create');
    Route::get('/dashboard/mappingjadwal/view-mappingjadwal/{id}', 'show')->name('show');

    Route::post('/dashboard/mappingjadwal/tambah-mappingjadwal', 'store')->name('store');
    Route::delete('/dashboard/mappingjadwal/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/mappingjadwal/ubah-mappingjadwal/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/mappingjadwal/{id}', 'update')->name('update');
});

Route::controller(PresensiController::class)->name('presensi.')->middleware('auth', 'user-role:superadmin,guru')->group(function () {
    Route::get('/dashboard/presensi', 'index')->name('index');
    Route::get('/dashboard/presensi/{kelas}/filterKelas', 'filterKelasList')->name('filterKelasList');
    Route::get('/dashboard/presensi/{kelas}/{tahun}/getPresensi', 'getPresensiList')->name('getPresensiList');

    Route::get('/dashboard/presensi/tambah-presensi', 'create')->name('create');

    Route::get('/dashboard/presensi/tambah-presensi/{tahunAjaran}/getTahunAjaran', 'getTahunAjaranList')->name('getTahunAjaranList');
    Route::get('/dashboard/presensi/tambah-presensi/{kelas}/getKelas', 'getKelasList')->name('getKelasList');
    Route::get('/dashboard/presensi/tambah-presensi/{pelajaran}/getPelajaran', 'getPelajaranList')->name('getPelajaranList');
    Route::get('/dashboard/presensi/tambah-presensi/{nis}/getSiswa', 'getSiswaList')->name('getSiswaList');

    Route::get('/dashboard/presensi/view-presensi/{id}', 'show')->name('show');

    Route::post('/dashboard/presensi/tambah-presensi', 'store')->name('store');
    Route::delete('/dashboard/presensi/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/presensi/ubah-presensi/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/presensi/{id}', 'update')->name('update');
});

Route::controller(MateriController::class)->name('materi.')->middleware('auth', 'user-role:superadmin,guru')->group(function () {
    Route::get('/dashboard/materi', 'index')->name('index');
    Route::get('/dashboard/materi/tambah-materi', 'create')->name('create');
    Route::get('/dashboard/materi/view-materi/{id}', 'show')->name('show');

    Route::post('/dashboard/materi/tambah-materi', 'store')->name('store');
    Route::delete('/dashboard/materi/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/materi/ubah-materi/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/materi/{id}', 'update')->name('update');
});

Route::controller(NilaiController::class)->name('nilai.')->middleware('auth', 'user-role:superadmin,guru')->group(function () {
    Route::get('/dashboard/nilai', 'index')->name('index');
    Route::get('/dashboard/nilai/tambah-nilai', 'create')->name('create');
    Route::get('/dashboard/nilai/view-nilai/{id}', 'show')->name('show');

    Route::post('/dashboard/nilai/tambah-nilai', 'store')->name('store');

    Route::get('/dashboard/nilai/tambah-nilai/{tahunAjaran}/getTahunAjaran', 'getTahunAjaranList')->name('getTahunAjaranList');
    Route::get('/dashboard/nilai/tambah-nilai/{pelajaran}/getPelajaran', 'getPelajaranList')->name('getPelajaranList');

    Route::get('/dashboard/nilai/tambah-nilai/{nis}/getNis', 'getSiswaList')->name('getSiswaList');
    Route::get('/dashboard/nilai/tambah-nilai/{nmSiswa}/getNmSiswa', 'getNmSiswaList')->name('getNmSiswaList');
    Route::get('/dashboard/nilai/tambah-nilai/{nis}/getSiswa', 'getSiswaList')->name('getSiswaList');

    Route::delete('/dashboard/nilai/{id}', 'destroy')->name('destroy');
    Route::delete('/dashboard/nilai/ubah-nilai/{id}', 'destroyUbahSiswa')->name('destroyUbahSiswa');

    Route::get('/dashboard/nilai/ubah-nilai/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/nilai/{id}', 'update')->name('update');
});

Route::controller(RaporController::class)->name('rapor.')->middleware('auth', 'user-role:superadmin,guru')->group(function () {
    Route::get('/dashboard/rapor', 'index')->name('index');

    Route::get('/dashboard/rapor/tambah-rapor/{tahunAjaran}/{nis}', 'create')->name('create');
    Route::post('/dashboard/rapor/tambah-rapor', 'store')->name('store');

    Route::get('/dashboard/rapor/ubah-rapor/{idRapor}/edit', 'edit')->name('edit');
    Route::put('/dashboard/rapor/{idRapor}', 'update')->name('update');

    Route::get('/dashboard/rapor/cetak-rapor/{idRapor}/pdf', 'pdfShow')->name('pdfShow');

    Route::get('/dashboard/rapor/{tahunAjaran}/getThnAjaran', 'getThnAjaranList')->name('getThnAjaranList');
    Route::get('/dashboard/rapor/{kelas}/getSiswa', 'getSiswaList')->name('getSiswaList');
    Route::get('/dashboard/rapor/{tahunAjaran}/{nis}/cekRapor', 'cekRapor')->name('cekRapor');
});