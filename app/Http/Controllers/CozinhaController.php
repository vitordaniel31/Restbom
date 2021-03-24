<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemPedido;

class CozinhaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itens = ItemPedido::where('status', 0)->get();
        return view('cozinha.index')->with('itens', $itens);
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
    public function store(Request $request)
    {
        //
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
        $item = ItemPedido::find($id);
        if ($item) {
            if($item->status == 0){
                $item->update(['status'=>1]);
                return redirect(route('cozinha.index').'#cozinha')->with('alert-success', 'Status do item atualizado com sucesso!');
            }else{
                return redirect(route('coziha.index').'#cozinha')->with('alert-primary', 'Esse item está com um status diferente de "Em preparo"');
            }
            
        }else{
            return redirect(route('cozinha.index').'#cozinha')->with('alert-primary', 'Item inexistente! Informe um item válido para atualizar seu status!');
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
        //
    }
}
