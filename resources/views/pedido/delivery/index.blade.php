@extends('layouts.design')
@section('content')

<section id='deliveries' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
            <div class="col-md-8 text-center col-sm-12 ">
                <h1 style="display: inline;" data-aos="fade-up">Comanda {{$pedido->id}}</h1>
                <img height="200px" width="200px"  src="{{route('pedido.qrcode', [$pedido->remember_token])}}"> <!--gerar qr code -->
              </div>
            </div>
            @if(!$pedido->trashed())
            
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="endereco">Endereço</label>
                      <textarea name="endereco" type="text" id="endereco" autocomplete="endereco" autofocus class="form-control" disabled="">{{$pedido->delivery->endereco}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="observacao">Observação</label>
                      <textarea name="observacao" type="text" id="observacao" value="{{$pedido->delivery->observacao}}" autocomplete="observacao" autofocus class="form-control" disabled="">{{$pedido->delivery->observacao}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="entregador">Entregador</label>
                      <input name="entregador" type="text" id="entregador" value="{{@$pedido->delivery->user->name}}" autocomplete="entregador" autofocus class="form-control" disabled="">
                    </div>
                </div>
            @endif
          </div>

          <div class="col-lg-6">
            <div class="row justify-content-center table-responsive ml-1">
              <table class="table table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>DESCRICÃO</th>
                    <th>PREÇO</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr bgcolor="#F2F2F2">
                    <th>@if(!$pedido->trashed() and @$pedido->delivery->user->id == Auth::user()->id)<a class="btn btn-primary mb-2" href="{{route('financeiro.entrada.index', [$pedido->remember_token])}}#pagamento'">Finalizar</a>@endif</th>
                    <th>TOTAL: R$ {{$pedido->item->sum('produto.preco')}}</th>
                  </tr>
                </tfoot>
              <tbody>
                   @foreach ($pedido->item as $item)
                  <tr>
                    <td>{{$item->produto->descricao}} @if($item->observacao) ({{$item->observacao}}) @endif</td>
                    <td>R${{$item->produto->preco}}</td>
                 </tr>
                @endforeach 
              
              </tbody>
            </table>
  
            </div>
          </div>
        </div>
      </div>

    </section>
@endsection