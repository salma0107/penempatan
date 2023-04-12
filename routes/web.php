<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; //untuk mendaftarkan controller yang akan dieksekusi
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartmentController;

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

//ini untuk mendaftarkan link website
// Route::resource('positions', PositionController::class);
// Route::resource('departments', DepartementController::class);

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('home', ['title' => 'Home']);
        })->name('home');

        Route::resource('positions', PositionController::class);

        Route::resource('departments', DepartmentController::class);
    }
);  