<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AUTH\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login/password/resetlink', [AuthController::class, 'resetlink']);
Route::post('/login/password/reset', [AuthController::class, 'reset']);

Route::post('/login/password/resetlink', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/refreshtoken', [AuthController::class, 'refreshtoken'], function(){
    return response()->json(['success' => true]);
    })->withoutMiddleware('throttle:api');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
});
