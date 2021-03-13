<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ItemPedidoController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\EntradaController;


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
	Route::get('/', [DespesaController::class, 'index'])->name('financeiro.index');
	Route::get('/despesa/create', [DespesaController::class, 'create'])->name('financeiro.despesa.create');
	Route::post('/despesa', [DespesaController::class, 'store'])->name('financeiro.despesa.store');
	Route::get('/despesa/edit/{id}', [DespesaController::class, 'edit'])->name('financeiro.despesa.edit');
	Route::put('/despesa/update/{id}', [DespesaController::class, 'update'])->name('financeiro.despesa.update');
	Route::delete('/despesa/{id}', [DespesaController::class, 'destroy'])->name('financeiro.despesa.destroy');

	Route::get('/formaPagamento', [FormaPagamentoController::class, 'index'])->name('financeiro.formaPagamento.index');
	Route::get('/formaPagamento/create', [FormaPagamentoController::class, 'create'])->name('financeiro.formaPagamento.create');
	Route::post('/formaPagamento', [FormaPagamentoController::class, 'store'])->name('financeiro.formaPagamento.store');
	Route::get('/formaPagamento/edit/{id}', [FormaPagamentoController::class, 'edit'])->name('financeiro.formaPagamento.edit');
	Route::put('/formaPagamento/update/{id}', [FormaPagamentoController::class, 'update'])->name('financeiro.formaPagamento.update');
	Route::delete('/formaPagamento/{id}', [FormaPagamentoController::class, 'destroy'])->name('financeiro.formaPagamento.destroy');
	Route::put('/formaPagamento/{id}', [FormaPagamentoController::class, 'restore'])->name('financeiro.formaPagamento.restore');

	Route::get('/pagamento/{token}', [EntradaController::class, 'index'])->name('financeiro.entrada.index');
	Route::post('/pagamento/store/{token}', [EntradaController::class, 'store'])->name('financeiro.entrada.store');
});

Route::group(['prefix' => 'pedido', 'middleware' => ['auth']], function(){
	Route::get('/', [PedidoController::class, 'index'])->name('pedido.index');
	Route::get('/create', [PedidoController::class, 'create'])->name('pedido.create');
	Route::post('/', [PedidoController::class, 'store'])->name('pedido.store');
	Route::get('/edit/{id}', [PedidoController::class, 'edit'])->name('pedido.edit');
	Route::put('/update/{id}', [PedidoController::class, 'update'])->name('pedido.update');
	Route::delete('/{id}', [PedidoController::class, 'destroy'])->name('pedido.destroy');
	Route::put('/item/update/{id}', [ItemPedidoController::class, 'update'])->name('pedido.item.update');
	Route::get('/delivery/{id}', [PedidoController::class, 'delivery'])->name('pedido.delivery.index');
});

Route::get('/{token}/itens', [ItemPedidoController::class, 'index'])->name('pedido.item.index');
Route::put('/{token}/itens', [ItemPedidoController::class, 'store'])->name('pedido.item.store');
Route::delete('/item/{id}', [ItemPedidoController::class, 'destroy'])->name('pedido.item.destroy');
Route::get('/pedido/{token}/qrcode', [PedidoController::class, 'show'])->name('pedido.qrcode');

Route::group(['prefix' => 'delivery', 'middleware' => ['auth']], function(){
	Route::get('/', [DeliveryController::class, 'index'])->name('delivery.index');
});
