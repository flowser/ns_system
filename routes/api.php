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
Route::patch('/login/password/reset/form', [AuthController::class, 'passwordresetform']);
Route::patch('/login/password/reset/{token}', [AuthController::class, 'passwordreset']);

Route::post('/login', [AuthController::class, 'login']);
Route::patch('/register', [AuthController::class, 'register']);

Route::post('/refreshtoken', [AuthController::class, 'refreshtoken'], function(){
    return response()->json(['success' => true]);
    })->withoutMiddleware('throttle:api');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
});
