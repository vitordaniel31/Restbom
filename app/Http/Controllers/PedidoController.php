<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Delivery;
use Illuminate\Support\Str;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::withTrashed()->get();
        foreach ($pedidos as $pedido) {
            foreach ($pedido->item as $item) {
                $qtd_itens = $item->count('id');
                $itens_prontos = $item->where('status', 1)->count('id');
                if ($qtd_itens>0 and $qtd_itens==$itens_prontos and $pedido->status<3) {
                    $pedido->update(['status'=>1]);
                }else{
                    $itens_servidos = $item->where('status', 2)->count('id');
                    if($item->where('status', 0)->count('id')>0) {
                        $pedido->update(['status'=>0]);
                    }elseif($qtd_itens>0 and ($qtd_itens == $itens_servidos) and !$pedido->delivery){
                        $pedido->update(['status'=>2]);
                    }
                }
            }
        }
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
                'remember_token' => Str::random(100),
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
                'remember_token' => Str::random(100),
            ]);
        }

        return redirect(route('pedido.item.index', [$pedido->remember_token]).'#itens')->with('alert-success', 'Pedido registrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $image = \QrCode::format('png')
                         ->merge('images/logo.png', 0.3, true)
                         ->size(500)->errorCorrection('H')
                         ->generate(route('pedido.item.index', [$token]));
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
                if(!$pedido->mesa){
                    $pedido->update([
                        'cliente' => $request->input('cliente', $pedido->cliente),
                        'mesa' => $request->input('mesa', $pedido->mesa),
                    ]);
                    $pedido->delivery->delete();
                }else{
                    $pedido->update([
                        'cliente' => $request->input('cliente', $pedido->cliente),
                        'mesa' => $request->input('mesa', $pedido->mesa),
                    ]);
                }
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
        $pedido = Pedido::find($id);
        if ($pedido) {
            foreach ($pedido->item as $item) {
                $item->delete();
            }
            $pedido->delete();
            return redirect(route('pedido.index').'#pedidos')->with('alert-success', 'Pedido cancelado com sucesso!');
        }else{
            return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Pedido inexistente ou já cancelado! Informe um produto válido para conseguir cancelá-lo!');
        }
    }

    public function autorizeDelivery($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido) {
            if($pedido->delivery){
                $pedido->update(['status'=>3]);
                return redirect(route('pedido.index').'#pedidos')->with('alert-success', 'Delivery do pedido autorizado!');
            }else{
                return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Pedido não possui delivery cadastrado!');
            }
            
        }else{
            return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Pedido inexistente ou já cancelado! Informe um produto válido para conseguir acessar seu delivery!');
        }
    }

    public function delivery($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido) {
            if($pedido->delivery){
                return view('pedido.delivery.index')->with('pedido', $pedido);
            }else{
                return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Pedido não possui delivery cadastrado!');
            }
            
        }else{
            return redirect(route('pedido.index').'#pedidos')->with('alert-primary', 'Pedido inexistente ou já cancelado! Informe um produto válido para conseguir acessar seu delivery!');
        }
    }
    

}
