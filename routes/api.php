<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/', 'login');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');
    Route::get('user', 'getAuthenticatedUser')->middleware('auth:api');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index');
    Route::post('/user', 'store');
    Route::get('/user/{id}', 'show');
    Route::put('/user/{id}', 'update');
    Route::delete('/user/{id}', 'destroy');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('/course', 'index');
    Route::post('/course', 'store');
    Route::get('/course/{id}', 'show');
    Route::put('/course/{id}', 'update');
    Route::delete('/course/{id}', 'destroy');
});

Route::middleware('auth:api')->controller(UserCourseController::class)->group(function () {
    Route::get('/user-course-all', 'allCourse');
    Route::get('/user-course-bachelor', 'allCourseWithBachelorMentor');
    Route::get('/user-course-no-bachelor', 'allCourseWithNoBachelorMentor');
    Route::get('/count-user-course-all', 'allCourseAttendace');
    Route::get('/count-fee-user-course', 'allCourseFeeMentor');
    Route::get('/user-course-all', 'allCourse');
    Route::get('/user-course', 'index');
    Route::post('/user-course', 'store');
    Route::get('/user-course/{id}', 'show');
    Route::put('/user-course/{id}', 'update');
    Route::delete('/user-course/{id}', 'destroy');
});