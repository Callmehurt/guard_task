<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SellerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('activeSeller');
Route::post('/uploadDoc', [App\Http\Controllers\HomeController::class, 'uploadDoc'])->name('seller.uploadDoc')->middleware('activeSeller');

//Route::post('/seller/register', [App\Http\Controllers\HomeController::class, 'registerSeller'])->name('seller.registerSeller');
Route::get('/seller/login', [App\Http\Controllers\HomeController::class, 'sellerLoginPage'])->name('seller.sellerLoginPage');
Route::get('/logoutSeller', [App\Http\Controllers\HomeController::class, 'logoutSeller'])->name('seller.logoutSeller');


// Auth::routes();
Route::get('/admin/login', [AdminAuthController::class, 'loginPage'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.action');

Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard')->middleware('adminGuard');
Route::get('/admin/sellers', [SellerController::class, 'index'])->name('admin.seller')->middleware('adminGuard');
Route::post('/admin/createSeller', [SellerController::class, 'createSeller'])->name('admin.createSeller')->middleware('adminGuard');
Route::get('/admin/delete/{id}', [SellerController::class, 'delete'])->name('admin.delete')->middleware('adminGuard');
Route::get('/admin/edit/{id}', [SellerController::class, 'edit'])->name('admin.edit')->middleware('adminGuard');
Route::put('/admin/update/{id}', [SellerController::class, 'update'])->name('admin.update')->middleware('adminGuard');
Route::get('/admin/updateStatus/{id}', [SellerController::class, 'updateStatus'])->name('admin.updateStatus')->middleware('adminGuard');
Route::get('/admin/downloadDoc/{id}', [SellerController::class, 'downloadDoc'])->name('admin.downloadDoc')->middleware('adminGuard');

Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
