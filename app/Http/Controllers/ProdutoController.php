<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Estoque;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::withTrashed()->get();
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
            'tipo' => 'required|integer|in:1,2',
        ]);

        $produto = Produto::create([
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'tipo' => $request->tipo,
        ]);

        if ($request->tipo == 2) {
            $estoque = Estoque::create([
                'id_produto' => $produto->id,
                'quantidade' => 0,
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
            'descricao' => 'string|max:255|unique:produtos,descricao,' . $id . ',id',
            'preco' => 'numeric',
            'tipo' => 'integer|in:1,2',
        ]);

        $produto = Produto::find($id);

        if ($produto) {
            $tipo = $produto->tipo;
            $produto->update($request->all()); 
            if ($tipo==1 and $request->tipo==2) {
                $estoque = Estoque::withTrashed()->where('id_produto', $id)->first();
                if (!$estoque) {
                    $estoque = Estoque::create([
                        'id_produto' => $produto->id,
                        'quantidade' => 0,
                    ]); 
                }elseif($estoque->trashed()){
                    $estoque->restore();
                }
            }elseif($tipo==2 and $request->tipo==1){
                $estoque = Estoque::where('id_produto', $id);
                $estoque->delete();
            }
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
            if ($produto->tipo_perfil == 2) {
                $estoque = Estoque::where('id_produto', $id);
                $estoque->delete();
            }
            $produto->delete();
            return redirect(route('produto.index').'#produtos')->with('alert-success', 'Produto inativado com sucesso!');
        }else{
            return redirect(route('produto.index').'#produtos')->with('alert-primary', 'Produto inativo ou inexistente! Informe um produto ativo para conseguir inativá-lo!');
        }
    }

    public function restore($id)
    {
        $produto = Produto::onlyTrashed()->where('id', $id);
        if ($produto) {
            $estoque = Estoque::onlyTrashed()->where('id_produto', $id);
            $estoque->restore();
            $produto->restore();
            return redirect(route('produto.index').'#produtos')->with('alert-success', 'Produto ativado com sucesso!');
        }else{
            return redirect(route('produto.index').'#produtos')->with('alert-primary', 'Produto ativo ou inexistente! Informe um produto inativo para conseguir ativá-lo!');
        }
    }
}
