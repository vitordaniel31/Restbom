<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Produto;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $estoque = Estoque::where('id_produto', $id)->first();   
        $produto = Produto::find($id);
        if ($estoque) {
            return view('estoque.edit')->with('estoque', $estoque)->with('produto', $produto);
        }else{
            return redirect(route('produto.index').'#produtos')->with('alert-primary', 'Estoque inexistente! Informe um estoque válido para conseguir atualizar!');
        }
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
        $request->validate([
            'quantidade' => 'required|integer',
        ]);

        $estoque = Estoque::find($id);

        if ($estoque) {
            $estoque->update([
                'quantidade' =>  $request->quantidade,
            ]);
            return redirect(route('estoque.edit', $estoque->id_produto).'#estoque')->with('alert-success', 'Estoque atualizado com sucesso!');             
        }else{
            return redirect(route('produto.index').'#produtos')->with('alert-primary', 'Estoque inexistente! Informe um estoque válido para conseguir atualizar!');
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
