<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPagamento;

class FormaPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formas = FormaPagamento::withTrashed()->get();
        return view('financeiro.formaPagamento.index')->with('formas', $formas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('financeiro.formaPagamento.create');
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
            'descricao' => 'required|string|max:255|unique:formasdepagamento',
        ]);

        $produto = FormaPagamento::create([
            'descricao' => $request->descricao,
        ]);

        return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-success', 'Forma de pagamento registrada com sucesso!');
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
        $forma = FormaPagamento::find($id);
        if ($forma) {
            return view('financeiro.formaPagamento.edit')->with('forma', $forma);
        }else{
            return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-primary', 'Forma de pagamento inativa ou inexistente! Informe uma forma de pagamento ativa para conseguir editar!');
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
            'descricao' => 'string|max:255|unique:formasdepagamento,descricao,' . $id . ',id',
        ]);

        $forma = FormaPagamento::find($id);

        if ($forma) {
            $forma->update($request->all()); 
            return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-success', 'Os dados da forma de pagamento foram editados com sucesso!');
        }else{
            return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-primary', 'Forma de pagamento inativa ou inexistente! Informe uma forma de pagamento ativa para conseguir editar!');
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
        $forma = FormaPagamento::find($id);
        $forma_qtd = FormaPagamento::count('id');
        if ($forma) {
            if ($forma_qtd == 1) {
                return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-primary', 'Você precisa manter ao menos uma forma de pagamento ativa!');
            }
            $forma->delete();
            return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-success', 'Forma de pagamento inativada com sucesso!');
        }else{
            return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-primary', 'Forma de pagamento inativa ou inexistente! Informe uma forma de pagamento ativa para conseguir inativá-la!');
        }
    }

    public function restore($id)
    {
        $forma = FormaPagamento::onlyTrashed()->where('id', $id);
        if ($forma) {
            $forma->restore();
            return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-success', 'Forma de pagamento ativada com sucesso!');
        }else{
            return redirect(route('financeiro.formaPagamento.index').'#formas')->with('alert-primary', 'Forma de pagamento ativa ou inexistente! Informe uma forma de pagamento inativa para conseguir ativá-la!');
        }
    }
}
