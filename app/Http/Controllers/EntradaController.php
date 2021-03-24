<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPagamento;
use App\Models\Pedido;
use App\Models\Entrada;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
        $pedido = Pedido::where('remember_token', $token)->first();
        $formas = FormaPagamento::all();
        return view('financeiro.entrada.index')->with('pedido', $pedido)->with('formas', $formas);
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
        $pedido = Pedido::where('remember_token', $token)->first();

        $request->validate([
            'forma' => 'required|integer|exists:formasdepagamento,id',
            'total' => 'numeric|regex:/^\d{1,6}(\.\d{0,2})?$/|in:' . $pedido->item->sum('produto.preco'),
            'recebido' => 'required|numeric|regex:/^\d{1,6}(\.\d{0,2})?$/',
        ]);

        if ($pedido) {
            if ($pedido->status==2 or  $pedido->status==3) {
                $entrada = Entrada::create([
                    'id_pedido' => $pedido->id,
                    'total' => $pedido->item->sum('produto.preco'),
                    'recebido' => $request->recebido,
                    'id_formapagamento' => $request->forma
                ]);
                $pedido->update(['status' => 4]);
                return redirect(route('financeiro.index').'#despesas')->with('alert-success', 'Pagamento de pedido registrado com sucesso!');
            }else{
                return redirect(route('pedido.index').'#despesas')->with('alert-primary', 'O pedido ainda não foi servido ou entregue via delivery!');
            }
        }else{
            return redirect(route('financeiro.index').'#despesas')->with('alert-primary', 'Pedido inexistente ou cancelado! Informe um pedido váldo para registrar o pagamento!');
        }
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
