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

/*
 * Admin routes
 */
Route::prefix('admin')->group(function(){
    Route::get('/login',[AdminController::class,'loginform'])
        ->name('admin.loginform');
    Route::post('/login',[AdminController::class,'login'])
        ->name('admin.login');
    Route::get('/dashboard',[AdminController::class,'dashboard'])
        ->name('admin.dashboard')
        ->middleware('admin');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
