<?php

use App\Http\Controllers\AdminController;
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

/*-----------------------------------------Access for Admins-----------------------------------------*/

Route::group(['middleware' => 'admin'], function () {

    Route::prefix('admin')->group(function(){

        Route::get('/login',[AdminController::class,'loginform'])
            ->name('admin.loginform');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        Route::post('/logout',[AdminController::class, 'logout'])
            ->name('admin.logout');
    });

    /*-----------------------------------------Access for SuperAdmin-----------------------------------------*/
    Route::group(['middleware' => 'superadmin'], function () {

        Route::prefix('admin')->group(function(){

            Route::get('/create', [AdminController::class, 'create'])
                ->name('admin.create');

            Route::post('/store',[AdminController::class, 'store'])
                ->name('admin.store');
        });

    });
});

/*-----------------------------------------Access for Clients-----------------------------------------*/

Route::group(['middleware'=>['auth', 'verified', 'client']],function(){

    Route::get('/dashboard', function () {return view('dashboard');})
        ->name('dashboard');

});

/* -----------------------------------------routes without Access permission-----------------------------------------*/

Route::post('admin/login',[AdminController::class,'login'])
    ->name('admin.login');


require __DIR__.'/auth.php';
