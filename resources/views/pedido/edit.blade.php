@extends('layouts.design')
@section('content')
<section id='pedidos' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
              <a href="#home"><img width="250px" src="{{asset('images/logo.png')}}" class="img-fluid" alt="Imagem responsiva"></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <h1>Comanda {{$pedido->id}}</h1>
            </div>
            @error('cliente')
              <div class="alert alert-primary" role="alert">
                {{ $message }}
              </div>
            @enderror
            @error('delivery')
              <div class="alert alert-primary" role="alert">
                {{ $message }}
              </div>
            @enderror
            @error('mesa')
              <div class="alert alert-primary" role="alert">
                {{ $message }}
              </div>
            @enderror
            @error('observacao')
              <div class="alert alert-primary" role="alert">
                {{ $message }}
              </div>
            @enderror
            @error('endereco')
              <div class="alert alert-primary" role="alert">
                {{ $message }}
              </div>
            @enderror

            <form action="{{route('pedido.update', [$pedido->id])}}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="cliente">Cliente</label>
                      <input name="cliente" type="text" id="descricao" value="{{$pedido->cliente}}" required autocomplete="cliente" autofocus class="form-control ">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-check">
                      <input onchange="if(document.getElementById('delivery').checked){document.getElementById('mesa1').style.display = 'none'; document.getElementById('mesa').removeAttribute('required'); document.getElementById('mesa').removeAttribute('name'); document.getElementById('endereco1').style.display = 'block'; document.getElementById('endereco').setAttribute('required','required'); document.getElementById('endereco').setAttribute('name','endereco'); document.getElementById('observacao1').style.display = 'block'; document.getElementById('observacao').setAttribute('name','observacao'); }else{document.getElementById('mesa1').style.display = 'block'; document.getElementById('mesa').setAttribute('required','required'); document.getElementById('mesa').setAttribute('name','mesa'); document.getElementById('endereco1').style.display = 'none'; document.getElementById('endereco').removeAttribute('required'); document.getElementById('endereco').removeAttribute('name'); document.getElementById('observacao1').style.display = 'none'; document.getElementById('observacao').removeAttribute('required'); document.getElementById('observacao').removeAttribute('name');}" class="form-check-input" type="checkbox" value="1" id="delivery" name="delivery" @if($pedido->delivery)checked @endif>
                      <label class="form-check-label" for="flexCheckDefault">
                        Delivery
                      </label>
                    </div>
                </div>
         
                  <div id="mesa1" class="row" style="display: @if($pedido->delivery)none @else block @endif">
                    <div class="col-md-12 form-group">
                      <label for="mesa">Mesa</label>
                      <input type="text" id="mesa" value="{{$pedido->mesa}}" autocomplete="mesa" autofocus class="form-control" @if(!$pedido->delivery)name="mesa" required @endif>
                    </div>
                </div>

                <div id="endereco1" class="row" style="display: @if($pedido->delivery)block @else none @endif;">
                    <div class="col-md-12 form-group">
                      <label for="endereco">Endereço</label>
                      <input type="text" id="endereco" value="{{@$pedido->delivery->endereco}}" autocomplete="endereco" autofocus class="form-control" @if($pedido->delivery)name="endereco" required @endif>
                    </div>
                </div>

                <div id="observacao1" class="row"  style="display: @if($pedido->delivery)block @else none @endif;">
                    <div class="col-md-12 form-group">
                      <label for="observacao">Observação</label>
                      <input type="text" id="observacao" value="{{@$pedido->delivery->observacao}}" autocomplete="observacao" autofocus class="form-control" @if($pedido->delivery)name="observacao" required @endif>
                    </div>
                </div>
                
                <div class="row justify-content-center">
                    <div class="form-group">
                      <input type="submit" value="Enviar" class="btn btn-primary">
                    </div>
                </div>  
            </form>
          </div>
        </div>
      </div>

    </section>

@endsection