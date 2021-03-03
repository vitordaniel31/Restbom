@extends('design')
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
  <section id='saidas' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

            <div class="row justify-content-center">
              <h1>Saídas</h1>
            </div>
          
        <div class="row">
          <table class="table table-hover">
            <thead>
              <tr bgcolor="#F2F2F2">
                <th>CÓDIGO</th>
                <th>DESCRIÇÃO</th>
                <th>VALOR (R$)</th>
                <th>DATA</th>
                <th>AÇÕES</th>
              </tr>
            </thead>
          <tbody>
            <tr>
            @foreach ($consulta as $resultado)
              
                <td>{{$resultado->sai_codigo}}</td>
                <td>{{$resultado->sai_descricao}}</td>
                <td>R$ {{$resultado->sai_valor}}</td>
                <td>{{date('d/m/Y'), strtotime('$resultado->sai_data')}}</td>
                <td>
                  <form action="{{url('/financeiro/excluir', [$resultado->sai_codigo])}}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">delete</i></button>
                  </form>
                  <form  action="{{url('/financeiro/atualizar')}}" method="POST" style="display: inline; ">
                      @csrf
                      <input type="hidden" name="id" value="{{$resultado->sai_codigo}}">
                      <button class="btn btn-sm bg-transparent" type="submit" name="action"><i style="color: #039be5" class="material-icons">edit</i></button>
                  </form>
    
                </td>
             </tr>
            @endforeach
          </tr>
        </tbody>
        <a class="btn btn-primary" href="{{route('insertSaida')}}">Nova saída</a>
        </table>
        </div>
      </div>

    </section>

@endsection