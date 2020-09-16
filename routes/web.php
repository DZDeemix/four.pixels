<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/department/form/{id?}', [DepartmentController::class, 'createOrEditForm'])->name('departments.create');
//Route::get('/department/list', [DepartmentController::class, 'list'])->name('departments.list');
//Route::apiResource('department', DepartmentController::class);

Route::get('/user/form/{id?}', [UserController::class, 'createOrEditForm'])->name('users.create');
Route::get('/user/list/{paginate?}', [UserController::class, 'list'])->name('users.list');
Route::apiResource('user', UserController::class);
