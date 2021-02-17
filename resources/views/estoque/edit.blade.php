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
<section id='estoque' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            @foreach (['primary', 'success'] as $msg)
            @if(Session::has('alert-' . $msg))
              <div class="alert alert-{{ $msg }}" role="alert">
                {{ Session::get('alert-' . $msg) }}
              </div>
            @endif
          @endforeach
            <div class="row justify-content-center">
              <a href="#home"><img width="250px" src="{{asset('images/logo.png')}}" class="img-fluid" alt="Imagem responsiva"></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <center><h1 data-aos="fade-up">Estoque de produto</h1></center>
            </div>
            <form action="{{route('estoque.update', [$estoque->id])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Descrição</label>
                      <textarea type="text" id="descricao" autocomplete="descricao" autofocus class="form-control" disabled>{{$produto->descricao}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="preco">Preço</label>
                      <input id="preco" value="{{$produto->preco}}" class="form-control" disabled>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="name">Quantidade</label>
                      <input name="quantidade" type="integer" min="0" id="quantidade" value="{{$estoque->quantidade}}" required autocomplete="quantidade" autofocus class="form-control">
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="atualizacao">Última atualização</label>
                      <input id="atualizacao" value="{{date('d/m/Y H:i:s', strtotime($estoque->updated_at))}}" class="form-control" disabled>
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

