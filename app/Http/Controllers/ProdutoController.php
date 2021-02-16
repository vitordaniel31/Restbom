<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('produto.index')->with('produtos', $produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
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
            'descricao' => 'required|string|max:255|unique:produtos',
            'preco' => 'required|numeric',
            'tipo' => 'required|string|in:C,E',
            'status' => 'string|in:1',
        ]);

        $produto = Produto::create([
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'tipo' => $request->tipo,
        ]); 
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
        $produto = Produto::find($id);
        if ($produto) {
            return view('produto.edit')->with('produto', $produto);
        }else{
            return redirect(route('produto.index').'#produtos')->with('alert-primary', 'Produto inativo ou inexistente! Informe um produto ativo para conseguir editar!');
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
            'id' => 'exists:produtos,id',
            'descricao' => 'string|max:255|unique:produtos,descricao,' . $id . ',id',
            'preco' => 'numeric',
            'tipo' => 'string|in:C,E',
        ]);

        $produto = Produto::find($id);

        if ($produto) {
            $produto->update([
                'descricao' => $request->descricao,
                'preco' => $request->preco,
                'tipo' => $request->tipo,
            ]); 
            return redirect(route('produto.index').'#produtos')->with('alert-success', 'Os dados do produto foram editados com sucesso!');
        }else{
            return redirect(route('produto.index').'#produtos')->with('alert-primary', 'Produto inativo ou inexistente! Informe um produto ativo para conseguir editar!');
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
        $produto = Produto::find($id);
        if ($produto) {
            $produto->delete();
            return redirect(route('produto.index').'#produtos')->with('alert-success', 'Produto inativado com sucesso!');
        }else{
            return redirect(route('produto.index').'#produtos')->with('alert-primary', 'Produto inativo ou inexistente! Informe um produto ativo para conseguir excluir!');
        }
    }

    public function restore($id)
    {
        $produto = Produto::onlyTrashed()->where('id', $id);
        if ($produto) {
            $produto->restore();
            return redirect(route('produto.index').'#produtos')->with('alert-success', 'Produto ativado com sucesso!');
        }else{
            return redirect(route('produto.index').'#produtos')->with('alert-primary', 'Produto ativo ou inexistente! Informe um produto inativo para conseguir ativá-lo!');
        }
    }
}
