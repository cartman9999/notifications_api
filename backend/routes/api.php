<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\{CourseController, NotificationController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// Courses
Route::prefix('courses')
->middleware(['access_token'])
->group(function () {
    Route::get('/',  [CourseController::class, 'index']);
    Route::get('/{course}',  [CourseController::class, 'show']);
    Route::post('/completed', [CourseController::class, 'courseCompleted']);
});

// Notifications
Route::prefix('notifications')
->middleware(['access_token', 'admin_only'])
->group(function () {
    Route::get('/',  [NotificationController::class, 'index']);
    Route::post('/{notification}',  [NotificationController::class, 'updateStatus']);
});