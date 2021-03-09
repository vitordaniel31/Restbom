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
  <section id='pedidos' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

            <div class="row justify-content-center">
            <div class="col-md-8 text-center col-sm-12 ">
                <h1 data-aos="fade-up">Pedidos</h1>
              </div>
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
            <a class="btn btn-primary mb-2" href="{{route('pedido.create')}}#pedidos">Novo pedido</a>
              <table id="dataTable" class="table table-bordered table-responsive-sm table-responsive-md table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>CLIENTE</th>
                    <th>DELIVERY</th>
                    <th>MESA</th>
                    <th>STATUS</th>
                    <th>DATA</th>
                    <th>AÇÕES</th>
                  </tr>
                </thead>
              <tbody>
                <tr>
                @foreach ($pedidos as $pedido)
                    <td>{{$pedido->cliente}}</td>
                    <td class="text-center">@if($pedido->delivery)<button title="Ver delivery" class="btn btn-secondary">Ver delivery</i></button>@else <i class="material-icons">cancel</i>@endif</td>
                    <td class="text-center">@if($pedido->mesa){{$pedido->mesa}} @else <i class="material-icons">cancel</i> @endif</td>
                    <td>@if($pedido->status == 0) Em andamento
                    @else Finalizado
                    @endif
                    </td>
                    <td>{{(new DateTime($pedido->created_at))->format('H:i:s d/m/Y')}}</td>
                    <td><button title="Ver pedido" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('pedido.item.index', [$pedido->remember_token])}}#itens'"><i style="color: #039be5" class="material-icons">visibility</i></button>
                      <button title="Editar" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('pedido.edit', [$pedido->id])}}#pedidos'"><i style="color: #039be5" class="material-icons">edit</i></button>
                    </td>
                 </tr>
                @endforeach
              </tr>
            </tbody>
            </table>
        </div>
      </div>

    </section>

@endsection