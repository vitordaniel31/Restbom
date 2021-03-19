@extends('layouts.design')
@section('content')
  <section id='deliveries' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

  
      <div class="row justify-content-center">
        <h1>Deliveries</h1>
      </div>
       
      @foreach (['primary', 'success'] as $msg)
        @if(Session::has('alert-' . $msg))
          <div class="alert alert-{{ $msg }}" role="alert">
            {{ Session::get('alert-' . $msg) }}
          </div>
        @endif
      @endforeach
          
        <div class="row">
          <div class="col-md-12 table-responsive">
              <table id="dataTable" class="table table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>ENDEREÇO</th>
                    <th>OBSERVAÇÃO</th>
                    <th>PEDIDO</th>
                    <th>ENTREGADOR</th>
                    <th>STATUS</th>
                    <th>AÇÕES</th>
                  </tr>
                </thead>
              <tbody>
                @foreach ($deliverys as $delivery)
                <tr>
                    <td>{{$delivery->endereco}}</td>
                    <td>{{$delivery->observacao}}</td>
                    <td><button onclick="window.location.href='{{route('pedido.item.index', [$delivery->pedido->remember_token])}}#itens'" title="Ver pedido" class="btn btn-secondary">Ver pedido</i></button></td>
                    <td>{{@$delivery->user->name}}</td>
                    <td>{{$delivery->status}}</td>
                    <td>@if(!$delivery->user and \Auth::user()->tipo_perfil==1)
                        <form action="{{route('pedido.entregador.update', [$delivery->id])}}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <button title="Fazer delivery" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">motorcycle</i></button>
                        </form> 
                      @endif
                    </td>
                 </tr>
                @endforeach
              </tr>
            </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>

@endsection