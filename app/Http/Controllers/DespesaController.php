<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesa;
use App\Models\Entrada;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradas = Entrada::all();
        $despesas = Despesa::all();
        return view('financeiro.index')->with('despesas', $despesas)->with('entradas', $entradas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('financeiro.despesa.create');
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
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data' => 'required|date',
        ]);

        $despesa = Despesa::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data' => $request->data,
        ]);

        return redirect(route('financeiro.index').'#despesas')->with('alert-success', 'Despesa registrada com sucesso!');
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
        $despesa = Despesa::find($id);
        if ($despesa) {
            return view('financeiro.despesa.edit')->with('despesa', $despesa);
        }else{
            return redirect(route('financeiro.index').'#despesass')->with('alert-primary', 'Despesa inexistente! Informe uma despesa existente para conseguir editar!');
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
            'descricao' => 'string|max:255',
            'valor' => 'numeric',
            'data' => 'date',
        ]);

        $despesa = Despesa::find($id);

        if ($despesa) {
            $despesa->update($request->all());
            return redirect(route('financeiro.index').'#despesas')->with('alert-success', 'Os dados da despesa foram editados com sucesso!');
        }else{
            return redirect(route('financeiro.index').'#despesass')->with('alert-primary', 'Despesa inexistente! Informe uma despesa existente para conseguir editar!');
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
        $despesa = Despesa::find($id);

        if ($despesa) {
            $despesa->delete();
            return redirect(route('financeiro.index').'#despesas')->with('alert-success', 'Despesa excluída com sucesso!');
        }else{
            return redirect(route('financeiro.index').'#despesass')->with('alert-primary', 'Despesa inexistente! Informe uma despesa existente para conseguir excluir!');
        }
    }
}
