@extends('layouts.design')
@section('content')
 
<section id='pagamento' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center table-responsive">
              <div class="col-md-8 text-center col-sm-12 ">
                <h1 style="display: inline;" data-aos="fade-up">Comanda {{$pedido->id}}</h1>
                <img height="200px" width="200px"  src="{{route('pedido.qrcode', [$pedido->remember_token])}}"> <!--gerar qr code -->
              </div>
              <table class="table table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>DESCRICÃO</th>
                    <th>PREÇO</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr bgcolor="#F2F2F2">
                    <th></th>
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
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <center><h1 data-aos="fade-up">Pagamento</h1></center>
            </div>
            <form action="{{route('financeiro.entrada.store', [$pedido->remember_token])}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="forma">Forma de pagamento</label>
                      <select name="forma" class="form-control browser-default custom-select" id="forma" required>
                        @foreach ($formas as $forma)
                            <option value="{{$forma->id}}">{{$forma->descricao}} - R${{$produto->preco}}</option>
                          @endforeach    
                      </select>
                      @error('tipo')
                              <div class="alert alert-primary" role="alert">
                                  {{ $message }}
                              </div>
                      @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="name">Total</label>
                      <textarea name="descricao" type="text" id="descricao" value="{{ old('descricao') }}" required autocomplete="descricao" autofocus class="form-control "></textarea>
                      @error('descricao')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                      @enderror
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="name">Pago</label>
                      <textarea name="descricao" type="text" id="descricao" value="{{ old('descricao') }}" required autocomplete="descricao" autofocus class="form-control "></textarea>
                      @error('descricao')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                      @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="name">Líquido</label>
                      <textarea name="descricao" type="text" id="descricao" value="{{ old('descricao') }}" required autocomplete="descricao" autofocus class="form-control "></textarea>
                      @error('descricao')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                      @enderror
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="name">Juros</label>
                      <textarea name="descricao" type="text" id="descricao" value="{{ old('descricao') }}" required autocomplete="descricao" autofocus class="form-control "></textarea>
                      @error('descricao')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                      @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group">
                      <input type="submit" value="Salvar" class="btn btn-primary">
                    </div>
                </div>  
            </form>
          </div>
        </div>
      </div>

    </section>
@endsection