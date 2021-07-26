<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'registration']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/login', [UserController::class, 'login']);
Route::middleware('auth:api')->get('/dashboard', function(){
    return response()->json(['success' => 'Yeah! your are authenticated'], 203);
});
Route::middleware('auth:api')->post('/logout', [UserController::class, 'logout']);


Route::post('admin/login',[AdminController::class, 'login']);
Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api', 'scopes:admin']],function(){
     Route::get('dashboard',[AdminController::class, 'dashboard']);
 });
 Route::middleware('auth:admin')->get('/user/admin', function (Request $request) {
    return 'Auth 1';
});
