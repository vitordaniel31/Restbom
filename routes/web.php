<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\DespesaController;


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
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/dashboard', function () {	
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'funcionario', 'middleware' => ['auth', 'admin']], function(){
	Route::get('/', [FuncionarioController::class, 'index'])->name('funcionario.index');
	Route::get('/edit/{id}', [FuncionarioController::class, 'edit'])->name('funcionario.edit');
	Route::put('/update/{id}', [FuncionarioController::class, 'update'])->name('funcionario.update');
	Route::delete('/{id}', [FuncionarioController::class, 'destroy'])->name('funcionario.destroy');
	Route::put('/{id}', [FuncionarioController::class, 'restore'])->name('funcionario.restore');
});

Route::group(['prefix' => 'produto', 'middleware' => ['auth', 'admin']], function(){
	Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
	Route::get('/create', [ProdutoController::class, 'create'])->name('produto.create');
	Route::post('/', [ProdutoController::class, 'store'])->name('produto.store');
	Route::get('/edit/{id}', [ProdutoController::class, 'edit'])->name('produto.edit');
	Route::put('/update/{id}', [ProdutoController::class, 'update'])->name('produto.update');
	Route::delete('/{id}', [ProdutoController::class, 'destroy'])->name('produto.destroy');
	Route::put('/{id}', [ProdutoController::class, 'restore'])->name('produto.restore');
});

Route::group(['prefix' => 'estoque', 'middleware' => ['auth', 'admin']], function(){
	Route::get('/edit/{id}', [EstoqueController::class, 'edit'])->name('estoque.edit');
	Route::put('/update/{id}', [EstoqueController::class, 'update'])->name('estoque.update');
});

Route::group(['prefix' => 'financeiro', 'middleware' => ['auth', 'admin']], function(){
	//Route::get('/', [DespesaController::class, 'index'])->name('produto.index');
	Route::get('/despesa/create', [DespesaController::class, 'create'])->name('financeiro.despesa.create');
	Route::post('/despesa', [DespesaController::class, 'store'])->name('financeiro.despesa.store');
});