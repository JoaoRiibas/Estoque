<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\MarcaController;

	Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');	
	
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	
	Route::group(['prefix' => 'marca'], function(){
		Route::get('/', [MarcaController::class, 'index'])->name('marca.index');
		Route::post('/filter', [MarcaController::class, 'filter'])->name('marca.filter');
		Route::get('/form/{id?}', [MarcaController::class, 'form'])->name('marca.form');
		Route::post('/store/{id?}', [MarcaController::class, 'store'])->name('marca.store');
		Route::delete('/delete/{id}', [MarcaCOntroller::class, 'delete'])->name('marca.delete');
	});

	Route::group(['middleware' => 'auth'], function () {
		Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
		Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update'); 
		Route::post('logout', [LoginController::class, 'logout'])->name('logout');
		Route::get('/{page}', [PageController::class, 'index'])->name('page');
	});

	