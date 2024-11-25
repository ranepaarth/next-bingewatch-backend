<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/get-started', [AuthController::class, 'getStarted']);
Route::post('/check-user-exist', [AuthController::class, 'checkIfUserExist']);
Route::post('/login', [AuthController::class, 'login']);
Route::resource('/plans',PlansController::class);

// Verify email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::middleware('auth:api')->group(function () {
    Route::get('/get-user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::patch('/subscribe-to-plan',[UserController::class,'subscribeToPlan']);
});
