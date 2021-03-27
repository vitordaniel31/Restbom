<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverys = Delivery::all();
        return view('delivery.index')->with('deliverys', $deliverys);
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
        $delivery = Delivery::find($id);
        if ($delivery) {
            if(!$delivery->user){
                if(\Auth::user()->tipo_perfil==1){
                    $delivery->update(['id_user'=>\Auth::user()->id, 'status'=>1]);
                    return redirect(route('pedido.delivery.index', [$delivery->pedido->id]).'#deliveries')->with('alert-success', 'Faça a entrega do pedido com segurança!');
                }else{
                    return redirect(route('delivery.index').'#deliveries')->with('alert-primary', 'Você não tem o tipo de perfil Delivery!');
                }
            }else{
                return redirect(route('delivery.index').'#deliveries')->with('alert-primary', 'Delivery já está sendo feito por outro entregador!');
            }
            
        }else{
            return redirect(route('delivery.index').'#deliveries')->with('alert-primary', 'Delivery inexistente! Informe um delivery válido para conseguir fazer a entrega!');
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
