<?php

use App\Http\Controllers\CategoriaController;
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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;

	Route::get('/', function () {
		return redirect('/dashboard');
	})->middleware('auth');

	Route::group(['prefix' => 'dashboard'], function (){
		Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
		Route::get('/listagem/{id}', [HomeController::class, 'listagem'])->name('dashboard.listagem');
	});
	
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');

	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
	
	Route::group(['prefix' => 'marca'], function(){
		Route::get('/', [MarcaController::class, 'index'])->name('marca.index');
		Route::get('/form/{id?}', [MarcaController::class, 'form'])->name('marca.form');
		Route::post('/store/{id?}', [MarcaController::class, 'store'])->name('marca.store');
		Route::delete('/delete/{id}', [MarcaCOntroller::class, 'delete'])->name('marca.delete');
	});

	Route::group(['prefix' => 'lote'], function(){
		Route::get('/', [LoteController::class, 'index'])->name('lote.index');
		Route::get('/form/{id?}', [LoteController::class, 'form'])->name('lote.form');
		Route::post('/store/{id?}', [LoteController::class, 'store'])->name('lote.store');
		Route::delete('/delete/{id}', [LoteController::class, 'delete'])->name('lote.delete');
	});

	Route::group(['prefix' => 'fornecedor'], function(){
		Route::get('/', [FornecedorController::class, 'index'])->name('fornecedor.index');
		Route::get('/form/{id?}', [FornecedorController::class, 'form'])->name('fornecedor.form');
		Route::post('/store/{id?}', [FornecedorController::class, 'store'])->name('fornecedor.store');
		Route::delete('/delete/{id}', [FornecedorController::class, 'delete'])->name('fornecedor.delete');
		Route::get('/detalhes/{id}', [FornecedorController::class, 'detalhes'])->name('fornecedor.detalhes');
	});

	Route::group(['prefix' => 'produto'], function(){
		Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
		Route::get('/form/{id?}', [ProdutoController::class, 'form'])->name('produto.form');
		Route::post('/filter', [ProdutoController::class, 'filter'])->name('produto.filter');
		Route::get('/detalhes/{id}', [ProdutoController::class, 'detalhes'])->name('produto.detalhes');
		Route::post('/store/{id?}', [ProdutoController::class, 'store'])->name('produto.store');
		Route::delete('/delete/{id}', [ProdutoController::class, 'delete'])->name('produto.delete');
	});

	Route::group(['prefix' => 'estoque'], function (){
		Route::get('/', [EstoqueController::class, 'index'])->name('estoque.index');
		Route::post('/filter', [EstoqueController::class, 'filter'])->name('estoque.filter');
		Route::get('/entrada', [EStoqueController::class, 'entrada'])->name('estoque.entrada');
		Route::get('/baixa', [EStoqueController::class, 'baixa'])->name('estoque.baixa');
		Route::post('/store/{operacao}', [EstoqueController::class, 'store'])->name('estoque.store');
	});

	Route::group(['prefix' => 'categoria'], function(){
		Route::get('/', [CategoriaController::class, 'index'])->name('categoria.index');
		Route::get('/form/{id?}', [CategoriaController::class, 'form'])->name('categoria.form');
		Route::post('/store/{id?}', [CategoriaController::class, 'store'])->name('categoria.store');
		Route::delete('/delete/{id}', [CategoriaController::class, 'delete'])->name('categoria.delete');
	});

	Route::group(['prefix' => 'user'], function(){
		Route::get('/', [UserController::class, 'index'])->name('user.index');
		Route::get('/form/{id?}', [UserController::class, 'form'])->name('user.form');
		Route::post('/store/{id?}', [UserController::class, 'store'])->name('user.store');
		// Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
	});

	


	