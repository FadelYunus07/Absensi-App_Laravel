<?php


//Namespace User
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\HadirGuruController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HadirSiswaController;
use App\Http\Controllers\User\AbsenController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HadirController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\PresensiGuruController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Admin\MasterKelasController;
use App\Http\Controllers\Admin\MemberKelasController;

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

Route::view('/','welcome');


Route::group(['namespace' => 'Admin','middleware' => 'auth','prefix' => 'admin'],function(){
	Route::view('/','user/index')->name('dash')->middleware(['can:admin']);
	
	Route::get('/',[AdminController::class,'index'])->name('admin')->middleware(['can:admin']);
	// Route tombol edit, hapus, dan tambah User
	Route::get('/admin/user', [UserController::class,'index'])->name('kelolaUser');
	Route::get('admin/user/{id}/edit', 'UserController@edit')->name('user.edit');
	// Route::post('admin/user/{id}', [UserController::class, 'store'])->name('user.stored');
	Route::delete('admin/user/{id}', 'UserController@destroy')->name('kelolaUser.destroyed');
	
	// Route tombol edit, hapus, dan tambah Admin
	Route::get('/admin/admin', [AdminController::class,'index'])->name('admin');
	Route::get('admin/{id}/edit', 'AdminController@edit')->name('admin.edit');
	Route::post('admin/tambah', [AdminController::class, 'store'])->name('admin.stored');
	Route::delete('admin/{id}', 'AdminController@destroy')->name('admin.destroy');

	// Route tombol edit, hapus, dan tambah Guru
	Route::get('/admin/guru', [GuruController::class,'index'])->name('guru');
	Route::get('guru/{id}/edit', 'GuruController@edit')->name('guru.edit');
	Route::post('/guru/tambah', [GuruController::class, 'store'])->name('guru.stored');
	Route::delete('guru/{id}', 'GuruController@destroy')->name('guru.destroy');
	
	// Route tombol edit, hapus, dan tambah Siswa
	Route::get('/admin/siswa', [SiswaController::class,'index'])->name('siswa');
	Route::get('siswa/{id}/edit', 'SiswaController@edit')->name('siswa.edit');
	Route::post('siswa/{id}', [SiswaController::class, 'store'])->name('siswa.stored');
	Route::delete('siswa/{id}', 'SiswaController@destroy')->name('siswa.destroy');

	// Route tombol edit, hapus, dan tambah Master Kelas
	Route::get('/admin/master_kls', [MasterKelasController::class,'index'])->name('masters');
	Route::get('master_kls/{id}/edit', 'MasterKelasController@edit')->name('masters.edit');
	Route::post('admin/master_kls/', [MasterKelasController::class,'store'])->name('masters.store');
	Route::delete('master_kls/{id}', 'MasterKelasController@destroy')->name('masters.destroy');
	
	// Route tombol edit, hapus, dan tambah Member Kelas
	Route::get('/admin/master_kelas/{id}/member_kls', [MemberKelasController::class,'index'])->name('members');
	Route::get('master_kelas/member_kls/{id}/edit', 'MemberKelasController@edit')->name('members.edit');
	Route::post('master_kelas/member_kls/', [MemberKelasController::class, 'store'])->name('members.store');
	Route::delete('master_kelas/member_kls/{id}', 'MemberKelasController@destroy')->name('members.destroy');

	// Route tombol edit, hapus, dan tambah Member Kelas
	Route::get('/admin/master_kelas/{id}/jadwal', [JadwalController::class,'index'])->name('jadwals');
	Route::get('master_kelas/jadwal/{id}/edit', 'JadwalKelasController@edit')->name('jadwals.edit');
	Route::post('master_kelas/jadwal/', [JadwalController::class, 'store'])->name('jadwals.store');
	Route::delete('master_kelas/jadwal/{id}', 'JadwalController@destroy')->name('jadwals.destroy');
	
	// Route tombol edit, hapus, dan tambah Mapel
	Route::get('/admin/mapel', [MapelController::class,'index'])->name('mapels');
	Route::get('mapel/{id}/edit', 'MapelController@edit')->name('mapels.edit');
	Route::post('mapel/jadwal/', [MapelController::class, 'store'])->name('mapels.store');
	Route::delete('mapel/{id}', 'MapelController@destroy')->name('mapels.destroy');
	
	// Route Cetak Presensi
	Route::get('/admin/master_kelas/{id}/presensi', [PresensiController::class,'index'])->name('presensi');
	Route::get('/admin/master_kelas/{id}/presensikls', [PresensiController::class,'presensiKelas'])->name('presensiKls');
	Route::patch('admin/master_kelas/presensikls/{id}', [PresensiController::class, 'update'])->name('presensikls.update');
	Route::post('admin/master_kelas/presensikls/', [PresensiController::class, 'store'])->name('presensi.store');
	Route::get('master_kelas/member_kls/{id}/presensi/downloadpdf', [PresensiController::class,'downloadPresensiPDF'])->name('presensi.pdf');
	Route::Post('master_kelas/presensi/izin', [AbsenController::class,'submitIzin'])->name('guru.submit_izin');
	
	Route::get('/admin/presensiGuru', [PresensiGuruController::class,'index'])->name('presensiGuru');
	Route::get('presensiGuru/downloadpdf', [PresensiGuruController::class,'downloadKelasGuruPDF'])->name('presensiGuru.pdf');
	
	Route::get('/admin/hadirGuru', [HadirGuruController::class,'laporanGuru'])->name('laporHadirGuru');
	Route::get('hadirGuru/downloadpdf', [HadirGuruController::class,'downloadHadirGuruPDF'])->name('hdrGuru.pdf');
	Route::get('/admin/hadirSiswa', [HadirSiswaController::class,'laporanSiswa'])->name('laporHadirSiswa');
	Route::get('hadirSiswa/downloadpdf', [HadirSiswaController::class,'downloadHadirSiswaPDF'])->name('hdrSiswa.pdf');
	
	//QRcode Kehadiran
	Route::get('/admin/qrhadir', [HadirController::class,'index'])->name('qr-hadir');
	Route::post('/admin/qrhadir', [HadirController::class,'generateQR'])->name('generate-qr');
	Route::get('/admin/qrhadir/download-qr', 'HadirController@downloadQR')->name('download-qr');
	
	//scan kehadiran guru
	Route::get('/admin/scanhdrGuru', [HadirGuruController::class,'index'])->name('indexhdrGuru');
	Route::post('/admin/scanhdrGuru', [HadirGuruController::class,'scanhdrGuru'])->name('scanhdrGuru');
	
	//scan kehadiran siswa
	Route::get('/admin/scanhdrSiswa', [HadirSiswaController::class,'index'])->name('indexhdrSiswa');
	Route::post('/admin/scanhdrSiswa', [HadirSiswaController::class,'scanhdrSiswa'])->name('scanhdrSiswa');
	
	//Route Resource
	Route::resource('/user','UserController')->middleware(['can:admin']);
	Route::resource('/admin','AdminController')->middleware(['can:admin']);
	Route::resource('/guru','GuruController')->middleware(['can:admin']);
	Route::resource('/siswa','SiswaController')->middleware(['can:admin']);
	Route::resource('/master_kls','MasterKelasController')->middleware(['can:admin']);
	Route::resource('/mapel','MapelController')->middleware(['can:admin']);
	Route::resource('/hadir','HadirController')->middleware(['can:admin']);
	
	//Route View
	// Route::view('/404-page','admin.404-page')->name('404-page');
	// Route::view('/blank-page','admin.blank-page')->name('blank-page');
	// Route::view('/buttons','admin.buttons')->name('buttons');
	// Route::view('/cards','admin.cards')->name('cards');
	// Route::view('/utilities-colors','admin.utilities-color')->name('utilities-colors');
	// Route::view('/utilities-borders','admin.utilities-border')->name('utilities-borders');
	// Route::view('/utilities-animations','admin.utilities-animation')->name('utilities-animations');
	// Route::view('/utilities-other','admin.utilities-other')->name('utilities-other');
	// Route::view('/chart','admin.chart')->name('chart');
	// Route::view('/tables','admin.tables')->name('tables');
});


//route role user
Route::group(['namespace' => 'user','middleware' => 'auth' ,'prefix' => 'user'],function(){
	Route::view('/user', 'user.index')->name('dash');
	Route::get('/jadwal', [JadwalController::class,'jadwalKelas'])->name('jadwalkls');
	Route::get('/profile',[ProfileController::class,'index'])->name('profile');
	Route::patch('/profile/update/{user}',[ProfileController::class,'update'])->name('profile.update');
	Route::get('/presensi',[AbsenController::class,'index'])->name('scanner')->middleware('auth');
	Route::post('/scan', 'AbsenController@scan')->name('presensi.scan')->middleware('auth');
	Route::post('/scanGuru', 'AbsenController@scanGuru')->name('presensi.scanGuru')->middleware('auth');
	// Route::resource('/presensi','PresensiController')->middleware(['can:user']);

});

Route::group(['namespace' => 'Auth','middleware' => 'guest'],function(){
	Route::get('/user', [LoginController::class,'authenticate'])->name('user.index');
	// Route::view('/','user/index')->name('dash');
	Route::view('/login','auth.login')->name('login');
	Route::post('/login',[LoginController::class,'authenticate'])->name('login.post');
});

// Other
Route::view('/register','auth.register')->name('register');
Route::view('/forgot-password','auth.forgot-password')->name('forgot-password');
Route::post('/logout',function(){
	return redirect()->to('/login')->with(Auth::logout());
})->name('logout');

