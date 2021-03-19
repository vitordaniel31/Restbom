<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ItemPedido;

class ItemPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
        $pedido = Pedido::withTrashed()->where('remember_token', $token)->first();
        if ($pedido) {
            $produtos = Produto::all();
            return view('pedido.item.index')->with('pedido', $pedido)->with('produtos', $produtos);
        }else{
            return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Pedido cancelado ou inexistente! Informe um pedido válido!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $token)
    {
        $request->validate([
            'id_produto' => 'required|integer|exists:produtos,id',
            'descricao' => 'string|nullable|max:255',
        ]);

        $produto = Produto::find($request->id_produto);
        $pedido = Pedido::where('remember_token', $token)->first();

        if ($produto->tipo==1) {
            $pedido->item()->create([
                'id_produto' => $request->id_produto,
                'observacao' => $request->descricao,
                'status' => 0,
            ]);    
        }else{
            $produto = Produto::find($request->id_produto);
            if ($produto->estoque->quantidade<=0) {
                return redirect(route('pedido.item.index', [$pedido->remember_token]).'#itens')->with('alert-primary', 'Item fora de estoque!');
            }
            $pedido->item()->create([
                'id_produto' => $request->id_produto,
                'observacao' => $request->descricao,
                'status' => 1,
            ]);
            $produto->estoque()->update(['quantidade'=>$produto->estoque->quantidade -1]);
        }

        return redirect(route('pedido.item.index', [$pedido->remember_token]).'#itens')->with('alert-success', 'Item adicionado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if ($item) {
            $pedido = Pedido::find($item->id_pedido);
            if($item->status==1 and !$pedido->delivery){
                $item->update([
                    'status' => 2
                ]);
                return redirect(route('pedido.item.index', [$pedido->remember_token]).'#itens')->with('alert-success', 'O Item do pedido foi servido com sucesso!');
            }
        }else{
            return redirect(route('pedido.item.index', [$pedido->remember_token]).'#itens')->with('alert-primary', 'Item inexistente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ItemPedido::find($id);
        if ($item) {
            $pedido = Pedido::find($item->id_pedido);
            if ($item->status==0 or ($item->produto->tipo==2 and $item->status==1)) {
                if ($item->produto->tipo==2) {
                    $item->produto->estoque()->update(['quantidade' => $item->produto->estoque->quantidade +1]);
                }
                $item->delete();
                return redirect(route('pedido.item.index', [$pedido->remember_token]).'#itens')->with('alert-success', 'Item excluído com sucesso!');
            }else{
                return redirect(route('pedido.item.index', [$pedido->remember_token]).'#itens')->with('alert-primary', 'Item já foi servido ou já está pronto! Não é possível excluí-lo!');
            }
        }else{
            return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Item inexistente! Informe um item válido para conseguir excluir!');
        }
    }
}
