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
       
      @foreach (['primary', 'success'] as $msg)
        @if(Session::has('alert-' . $msg))
          <div class="alert alert-{{ $msg }}" role="alert">
            {{ Session::get('alert-' . $msg) }}
          </div>
        @endif
      @endforeach
          
        <div class="row">
          <table class="table table-hover">
            <thead>
              <tr bgcolor="#F2F2F2">
                <th>DESCRIÇÃO</th>
                <th>TIPO</th>
                <th>PREÇO (R$)</th>
                <th>STATUS</th>
                <th>AÇÕES</th>
              </tr>
            </thead>
          <tbody>
            @foreach ($produtos as $produto)
            <tr>
                <td>{{$produto->descricao}}</td>
                <td>@if($produto->tipo==1) Cozinha @elseif($produto->tipo==2) Estoque @endif</td>
                <td>R$ {{$produto->preco}}</td>
                <td>@if($produto->trashed())Inativo @else Ativo @endif</td>
                <td>
                  @if(!$produto->trashed())
                  <button title="Editar" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('produto.edit', [$produto->id])}}#produtos'"><i style="color: #039be5" class="material-icons">edit</i></button>
                  @if($produto->tipo=='E')
                  <button title="Estoque" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('estoque.edit', [$produto->id])}}#estoque'"><i style="color: #039be5" class="material-icons">input</i></button>
                  @endif
                  <form action="{{route('produto.destroy', [$produto->id])}}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button title="Desativar" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">cancel</i></button>
                  </form>
                  @endif

                  @if($produto->trashed())
                  <form action="{{route('produto.restore', [$produto->id])}}" method="POST" style="display: inline;">
                      @csrf
                      @method('PUT')
                      <button title="Ativar" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">check</i></button>
                  </form>
                  @endif

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