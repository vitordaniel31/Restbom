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
  <section id='produtos' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

  
            <div class="row justify-content-center">
              <h1>Produtos</h1>
            </div>
          
        <div class="row">
          <table class="table table-hover">
            <thead>
              <tr bgcolor="#F2F2F2">
                <th>DESCRIÇÃO</th>
                <th>TIPO</th>
                <th>PREÇO (R$)</th>
                <th>AÇÕES</th>
              </tr>
            </thead>
          <tbody>
            <tr>
            @foreach ($produtos as $produto)
                <td>{{$produto->descricao}}</td>
                <td>{{$produto->tipo}}</td>
                <td>R$ {{$produto->preco}}</td>
                <td>
                  <a href="{{route('produto.edit', [$produto->id])}}#produtos"><i style="color: #039be5" class="material-icons">edit</i></a>
                </td>
             </tr>
            @endforeach
          </tr>
        </tbody>
        <a class="btn btn-primary" href="{{route('produto.create')}}#produtos">Novo produto</a>
        </table>
        </div>
      </div>

    </section>

@endsection