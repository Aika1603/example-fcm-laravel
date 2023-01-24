<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;

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

Auth::routes([
  'register' => false,
  'reset' => false,
  'verify' => true,
]);

Route::get('/forbidden', function () {
    return view('error.forbidden');
});

Route::middleware(['verified', 'auth'])->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::prefix('notification')->name('notification.')->group(function() {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/get/{id?}', [NotificationController::class, 'get'])->name('get');
        Route::get('/read-all', [NotificationController::class, 'read_all'])->name('read-all');
        Route::get('/delete-all', [NotificationController::class, 'delete_all'])->name('delete-all');
        Route::get('/view/{id?}', [NotificationController::class, 'view'])->name('view');
        Route::post('/update-fcm', [NotificationController::class, 'update_fcm'])->name('update-fcm');
    });
});

