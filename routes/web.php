<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;

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

Route::group(['prefix' => 'funcionario', 'middleware' => 'auth'], function(){
	Route::get('/', [FuncionarioController::class, 'index'])->middleware(['admin'])->name('funcionario.index');
	Route::get('/edit/{id}', [FuncionarioController::class, 'edit'])->middleware(['admin'])->name('funcionario.edit');
	Route::put('/update/{id}', [FuncionarioController::class, 'update'])->middleware(['admin'])->name('funcionario.update');
	Route::delete('/{id}', [FuncionarioController::class, 'destroy'])->middleware(['admin'])->name('funcionario.destroy');
	Route::put('/{id}', [FuncionarioController::class, 'restore'])->middleware(['admin'])->name('funcionario.restore');
});

Route::group(['prefix' => 'produto', 'middleware' => 'auth'], function(){
	Route::get('/', [ProdutoController::class, 'index'])->middleware(['admin'])->name('produto.index');
	Route::get('/create', [ProdutoController::class, 'create'])->middleware(['admin'])->name('produto.create');
	Route::post('/', [ProdutoController::class, 'store'])->middleware(['admin'])->name('produto.store');
	Route::get('/edit/{id}', [ProdutoController::class, 'edit'])->middleware(['admin'])->name('produto.edit');
	Route::put('/update/{id}', [ProdutoController::class, 'update'])->middleware(['admin'])->name('produto.update');
});