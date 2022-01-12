<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// Halaman Utama
Route::get('/', [App\Http\Controllers\PageController::class, 'index']);
Route::get('/montir-detail/{id}', [App\Http\Controllers\PageController::class, 'detail'])->name('detail');
Route::get('/kategori-montir', [App\Http\Controllers\PageController::class, 'kategori'])->name('kategori');
Route::get('/kategori-montir/{id}', [App\Http\Controllers\PageController::class, 'montirByCategory']);

// Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('kategori', App\Http\Controllers\CategoryController::class);
Route::resource('user', App\Http\Controllers\UserController::class);
Route::resource('portfolio', App\Http\Controllers\PortfolioController::class);
Route::resource('sertifikat', App\Http\Controllers\SertifikatController::class);
Route::resource('booking', App\Http\Controllers\BookingController::class);
Route::get('/booking/{id}/sukses', [App\Http\Controllers\BookingController::class, 'bookingSukses'])->name('success');
Route::get('booking/{id}/diterima', [App\Http\Controllers\BookingController::class, 'diterima'])->name('booking.diterima');
Route::get('booking/{id}/menunggu', [App\Http\Controllers\BookingController::class, 'menunggu'])->name('booking.menunggu');
Route::post('booking-ditolak', [App\Http\Controllers\BookingController::class, 'ditolak'])->name('booking.ditolak');
Route::get('booking-montir/', [App\Http\Controllers\BookingController::class, 'pesananSaya'])->name('booking.customer');
Route::get('/user-trash/{id}/', [App\Http\Controllers\UserController::class, 'trash'])->name('trash');
Route::get('/user-trashed/', [App\Http\Controllers\UserController::class, 'onlyTrashed'])->name('user.onlyTrashed');
Route::get('/user-restore/{id}/', [App\Http\Controllers\UserController::class, 'restore'])->name('user.restore');
Route::get('/user-delete/{id}/', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
Route::get('/user-accpeted/{id}/', [App\Http\Controllers\UserController::class, 'accepted'])->name('user.accepted');
Route::post('/tolak-daftar-montir/', [App\Http\Controllers\UserController::class, 'tolakDaftarMontir'])->name('tolak-daftar-montir');
Route::get('/booking-selesai/{idMontir}/{idBooking}/', [App\Http\Controllers\BookingController::class, 'bookingSelesai'])->name('booking.selesai');
Route::get('/review', [App\Http\Controllers\ReviewController::class, 'index'])->name('user.review');
Route::get('/ketersediaan/buka/{id}/', [App\Http\Controllers\UserController::class, 'bukaKetersediaan'])->name('buka.ketersediaan');
Route::get('/ketersediaan/tutup/{id}/', [App\Http\Controllers\UserController::class, 'tutupKetersediaan'])->name('tutup.ketersediaan');
Route::post('/test', [App\Http\Controllers\ReviewController::class, 'review'])->name('test');
Route::get('/hapus-info/{id}/', [App\Http\Controllers\UserController::class, 'hapusInfo'])->name('hapus-info');

// complain
Route::resource('complain', App\Http\Controllers\ComplainController::class);
Route::post('complain-update', [App\Http\Controllers\ComplainController::class, 'updateComplain'])->name('complain.update');

// update
// detail calon montir
Route::get('/user/calon-montir/{id}', [App\Http\Controllers\UserController::class, 'detailCalonMontir'])->name('user.detail-montir');

// tolak calon montir
Route::get('/user/calon-montir/tolak/{id}', [App\Http\Controllers\UserController::class, 'tolakMontir'])->name('montir.tolak');

// ajukan jadi montir kembali
Route::get('/user/calon-montir/ajukan/{id}', [App\Http\Controllers\UserController::class, 'ajukanMontir'])->name('montir.ajukan-montir');

// rating
Route::resource('rating', App\Http\Controllers\RatingController::class);



