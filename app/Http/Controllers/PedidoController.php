<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Delivery;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::join('delelivery_pedidos', 'pedidos.id', '=', 'id_pedido')->get();
        return view('pedido.index')->with('pedidos', $pedidos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pedido.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'mesa' => 'required_without:delivery|string|max:255',
            'delivery' => 'required_without:mesa|integer|in:1',
            'endereco' => 'required_without:mesa|string|max:255',
            'observacao' => 'string|max:255',
        ]);

        if (isset($request->delivery)) {
            $pedido = Pedido::create([
                'cliente' => $request->cliente,
                'id_user' => \Auth::user()->id,
            ]);
            $delivery = Delivery::create([
                'endereco' => $request->endereco,
                'observacao' => $request->observacao,
                'id_pedido' => $pedido->id,
            ]);
        }else{
            $pedido = Pedido::create([
                'cliente' => $request->cliente,
                'mesa' => $request->mesa,
                'id_user' => \Auth::user()->id,
            ]);
        }

        return redirect(route('produto.index').'#produtos')->with('alert-success', 'Produto registrado com sucesso!');
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
