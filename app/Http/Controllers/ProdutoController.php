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
        ]);

        $produto = Produto::create([
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'tipo' => $request->tipo,
        ]); 
        return redirect(route('produto.index').'#produtos');
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
            //retornar mensagem de erro para a página index de produtos
            return redirect(route('produto.index').'#produtos');
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

        $produto = Produto::find($id)->update([
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'tipo' => $request->tipo,
        ]); 
        return redirect(route('produto.index').'#produtos');
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