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
        $pedidos = Pedido::all();
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
            'observacao' => 'string|nullable|max:255',
        ]);

        if (isset($request->delivery)) {
            $pedido = Pedido::create([
                'cliente' => $request->cliente,
                'id_user' => \Auth::user()->id,
            ]);
            $pedido->delivery()->create([
                'endereco' => $request->endereco,
                'observacao' => $request->observacao,
            ]);
        }else{
            $pedido = Pedido::create([
                'cliente' => $request->cliente,
                'mesa' => $request->mesa,
                'id_user' => \Auth::user()->id,
            ]);
        }

        return redirect(route('pedido.item.index', [$pedido->id]).'#itens')->with('alert-success', 'Pedido registrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = \QrCode::format('png')
                         ->merge('images/logo.png', 0.5, true)
                         ->size(500)->errorCorrection('H')
                         ->generate('A simple example of QR code!');
        return response($image)->header('Content-type','image/png');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido) {
            return view('pedido.edit')->with('pedido', $pedido);
        }else{
            return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Pedido cancelado ou inexistente! Informe um pedido válido para conseguir editar!');
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
            'cliente' => 'string|max:255',
            'mesa' => 'required_without:delivery|string|max:255',
            'delivery' => 'required_without:mesa|integer|in:1',
            'endereco' => 'required_without:mesa|string|max:255',
            'observacao' => 'string|nullable|max:255',
        ]);

        $pedido = Pedido::find($id);

        if ($pedido) {
            if (isset($request->delivery)) {
                $pedido->update([
                    'cliente' => $request->input('cliente', $pedido->cliente),
                ]);
                if (!$pedido->delivery) {
                    $pedido->update([
                        'mesa'=>null,
                    ]);
                    $pedido->delivery()->create([
                        'endereco' => $request->endereco,
                        'observacao' => $request->observacao,
                    ]);
                }else{
                    $pedido->delivery()->update([
                        'endereco' => $request->input('endereco', $pedido->delivery->endereco),
                        'observacao' => $request->input('observacao', $pedido->delivery->observacao),
                    ]);
                }
            }else{
                $pedido->update([
                    'cliente' => $request->input('cliente', $pedido->cliente),
                    'mesa' => $request->input('mesa', $pedido->mesa),
                ]);
            }
           
            return redirect(route('pedido.index').'#pedidos')->with('alert-success', 'Os dados do pedido foram editados com sucesso!');
        }else{
            return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Pedido cancelado ou inexistente! Informe um pedido válido para conseguir editar!');
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
