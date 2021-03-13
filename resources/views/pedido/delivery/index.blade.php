@extends('layouts.design')
@section('content')

    <div class="slider-wrap">
      <section id="home" class="home-slider owl-carousel">


        <div class="slider-item" style="background-image: url({{asset('foody/img/hero_1.jpg')}});">
          
          <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
              <div class="col-md-8 text-center col-sm-12 ">
                <h1 data-aos="fade-up">Enjoy Your Food at Foody</h1>
                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente et sed quasi.</p>
                
              </div>
            </div>
          </div>

        </div>

        <div class="slider-item" style="background-image: url({{asset('foody/img/hero_2.jpg')}});">
          <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
              <div class="col-md-8 text-center col-sm-12 ">
                <h1 data-aos="fade-up">Delecious Food</h1>
                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente et sed quasi.</p>
              </div>
            </div>
          </div>
          
        </div>

      </section>
    <!-- END slider -->
    </div> 
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
                      <label for="endereco">Descrição</label>
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
                    <th>@if(!$pedido->trashed())<a class="btn btn-primary mb-2" href="{{route('produto.create')}}#produtos">Pagar</a>@endif</th>
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