@extends('layotus.design')
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
          
        <div class="row">
           <div class="col-md-12 table-responsive">
            <a class="btn btn-primary mb-2" href="#pedidos">Novo pedido</a>
              <table id="dataTable" class="table table-bordered table-responsive-sm table-responsive-md table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>CÓDIGO</th>
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
                @foreach ($pedido as $pedidos)
                  
                    <td>{{$pedido->id}}</td>
                    <td>{{$pedido->cliente}}</td>
                    <td>@if(is_null($pedido->id_delivery))Não @else Sim @endif</td>
                    <td>{{$pedido->mesa}}</td>
                    <td>@if($pedido->status == 0) Em andamento
                    @else Finalizado
                    @endif
                    </td>
                    <td>{{(new DateTime($pedido->created_at))->format('d/m/Y H:i:s')}}</td>
                    <td>
                      
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