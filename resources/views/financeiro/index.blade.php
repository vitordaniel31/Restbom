@extends('layouts.design')
@section('content')
 
  <section id='financeiro' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

            @foreach (['primary', 'success'] as $msg)
        @if(Session::has('alert-' . $msg))
          <div class="alert alert-{{ $msg }}" role="alert">
            {{ Session::get('alert-' . $msg) }}
          </div>
        @endif
      @endforeach
          
        <div class="row">
          <div class="col-md-6 table-responsive">
            <div class="row justify-content-center">
              <h1>Despesas</h1>
            </div>
            <a class="btn btn-primary mb-2" href="{{route('financeiro.despesa.create')}}#saidas">Nova despesa</a>
              <table id="dataTable" class="table table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>DESCRIÇÃO</th>
                    <th>VALOR (R$)</th>
                    <th>DATA</th>
                    <th>AÇÕES</th>
                  </tr>
                </thead>
              <tbody>
                <tr>
                @foreach ($despesas as $despesa)
                    <td>{{$despesa->descricao}}</td>
                    <td>R$ {{$despesa->valor}}</td>
                    <td>{{date('d/m/Y'), strtotime('$despesa->data')}}</td>
                    <td>
                      <button title="Editar" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('financeiro.despesa.edit', [$despesa->id])}}#saidas'"><i style="color: #039be5" class="material-icons">edit</i></button>
                      <form action="{{route('financeiro.despesa.destroy', [$despesa->id])}}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button title="Excluir" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">cancel</i></button>
                      </form>
        
                    </td>
                 </tr>
                @endforeach
              </tr>
            </tbody>
            </table>
          </div>

          <div class="col-md-6 table-responsive">
            <div class="row justify-content-center">
              <h1>Entradas</h1>
            </div>
            <a class="btn btn-primary mb-3" href="{{route('pedido.index')}}#pedidos">Pedidos</a>
              <table>
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>DESCRIÇÃO</th>
                    <th>FORMA DE PAGAMENTO</th>
                    <th>TOTAL (R$)</th>
                    <th>VALOR RECEBIDO (R$)</th>
                    <th>DATA</th>
                  </tr>
                </thead>
              <tbody>
                <tr>
                @foreach ($entradas as $entrada)
                    <td>{{$entrada->pedido->id}}</td>
                    <td>{{$entrada->forma->descricao}}</td>
                    <td>R$ {{$entrada->total}}</td>
                    <td>R$ {{$entrada->recebido}}</td>
                    <td>{{date('d/m/Y H:i:s'), strtotime('$entrada->created_at')}}</td>
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