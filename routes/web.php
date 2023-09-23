<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\WEB\WebController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('optimize:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:cache');
    $exitCode = Artisan::call('route:cache');
    return 'cache cleared';
});

Route::get('/auth', [WebController::class, 'auth']);
Route::get('/auth/{any?}', [WebController::class, 'auth'])->where('any', '^(?!api\/)[\/\w\.-]*');

Route::get('/', [WebController::class, 'guest']);
Route::get('/{any?}', [WebController::class, 'guest'])->where('any', '^(?!api\/)[\/\w\.-]*');
