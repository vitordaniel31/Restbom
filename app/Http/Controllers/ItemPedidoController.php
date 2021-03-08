<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Produto;

class ItemPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pedido = Pedido::find($id);
        $produtos = Produto::all();
        return view('pedido.item.index')->with('pedido', $pedido)->with('produtos', $produtos);
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'id_produto' => 'required|integer|exists:produtos,id',
            'descricao' => 'string|nullable|max:255',
        ]);

        $produto = Produto::find($request->id_produto);
        $pedido = Pedido::find($id);

        if ($produto->tipo==1) {
            $pedido->item()->create([
                'id_produto' => $request->id_produto,
                'observacao' => $request->descricao,
                'status' => 0,
            ]);    
        }else{
            $pedido->item()->create([
                'id_produto' => $request->id_produto,
                'observacao' => $request->descricao,
                'status' => 2,
            ]);
        }

        return redirect(route('pedido.item.index', [$pedido->id]).'#itens')->with('alert-success', 'Item adicionado com sucesso!');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
