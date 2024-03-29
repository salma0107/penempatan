<?php

use App\Http\Controllers\UserController; //Mendaftarkan controller yang akan digunakan
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\CompanyController;

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


Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');

Route::middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('home', ['title' => 'Beranda']);
        })->name('home');
        Route::get('password', [UserController::class, 'password'])->name('password');
        Route::post('password', [UserController::class, 'password_action'])->name('password.action');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');

        // Route position
        Route::resource('positions', PositionController::class);
        Route::get('position/export-excel', [PositionController::class, 'exportExcel'])->name('positions.exportExcel');

        // Route departement
        Route::get('departements/exportpdf', [DepartementController::class, 'exportpdf'])->name('exportpdf');
        Route::resource('departements', DepartementController::class);

        // Route user
        Route::get('users/exportpdf', [UserController::class, 'exportPdf'])->name('users.exportpdf');
        Route::resource('users', UserController::class);

        // Route Penempatan
        Route::get('penempatans/exportpdf', [PenempatanController::class, 'exportPdf'])->name('penempatans.exportpdf');
        Route::resource('penempatans', PenempatanController::class);

        // Route Company
        Route::get('companies/exportpdf', [CompanyController::class, 'exportPdf'])->name('companies.exportpdf');
        Route::resource('companies', CompanyController::class);



        Route::get('search/companies', [CompanyController::class, 'autocomplete'])->name('search.companies');
        Route::resource('users', UserController::class);

       
    });
