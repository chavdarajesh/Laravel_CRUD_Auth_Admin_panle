<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
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


Auth::routes(['register' => false, 'login' => false]);
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return redirect()->route('admin.get.company');
});

Route::get('/admin/login', [AuthController::class, 'adminloginget'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'adminloginpost'])->name('admin.login.post');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'is_admin'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.get.company');
    });
    Route::post('/logout', [AuthController::class, 'adminlogout'])->name('admin.logout');

    Route::group(['prefix' => 'company'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('admin.get.company');
        Route::get('/add', [CompanyController::class, 'create'])->name('admin.add.company');
        Route::post('/', [CompanyController::class, 'store'])->name('admin.post.company');
        Route::delete('/delete/{id}', [CompanyController::class, 'destroy'])->name('admin.delete.company');
        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('admin.edit.company');
        Route::get('/view/{id}', [CompanyController::class, 'show'])->name('admin.view.company');
        Route::put('/update/{id}', [CompanyController::class, 'update'])->name('admin.update.company');
    });
});