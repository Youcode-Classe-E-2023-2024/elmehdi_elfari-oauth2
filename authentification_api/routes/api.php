<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\roleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class,'login']);

Route::post('register', [UserController::class,'store']);

Route::middleware('auth:api')->group(function () {
        Route::get('profile', [UserController::class,'profile']);
    Route::get('logout', [UserController::class,'logout']);
});

/* CREATE USER*/
Route::post('/users', [userController::class, 'addUser']);
Route::put('/users/{id}', [userController::class, 'editUser']);
Route::delete('/users/{id}', [userController::class, 'deleteUser']);

/*ROLE*/
Route::get('/roles', [RoleController::class, 'showRoles']);

Route::post('/roles', [roleController::class, 'addRole']);

Route::delete('/roles/{id}', [roleController::class, 'deleteRole']);

/*CREATE PERMISSION*/
Route::get('/permissions', [permissionController::class, 'showPermissions']);

Route::post('/permissions', [permissionController::class, 'addPermission']);

Route::delete('/permissions/{id}', [permissionController::class, 'deletePermission']);



Route::post('/forgotPassword', [userController::class, 'forgotPassword']);
Route::get('/mot-de-passe/reinitialiser/{token}', [userController::class, 'showResetForm'])->name('password.reset');
Route::post('/mot-de-passe/reset/', [userController::class, 'reset']);
