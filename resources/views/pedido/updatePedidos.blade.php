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
<section id='produtos' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
              <a href="#home"><img width="250px" src="{{asset('images/logo.png')}}" class="img-fluid" alt="Imagem responsiva"></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <h1>Editar produto</h1>
            </div>
            <form action="{{route('editProduto')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Descrição</label>
                      <input type="hidden" name="pro_codigo" value="{{$resultado->pro_codigo}}">
                      <textarea name="pro_descricao" type="text" id="descricao" value="{{$resultado->pro_descricao}}" required autocomplete="descricao" autofocus class="form-control ">{{$resultado->pro_descricao}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="name">Preço</label>
                      <input name="pro_preco" type="number" min="0" step="0.010" max="999999.99" id="preco" value="{{$resultado->pro_preco}}" required autocomplete="preco" autofocus class="form-control ">
                    </div>
                    
                        <div class="col-md-6 form-group">
                          <label for="tipo">Tipo</label>
                          <select name="pro_tipo" class="form-control" id="tipo" required>
                            <option value="@if (($resultado->pro_tipo)=='Cozinha') echo Cozinha @else Estoque @endif">@if (($resultado->pro_tipo)=='Cozinha') Cozinha @else Estoque @endif</option>
                            <option value="@if (($resultado->pro_tipo)=='Cozinha') Estoque @else Cozinha @endif">@if (($resultado->pro_tipo)=='Cozinha') Estoque @else Cozinha @endif</option>
                                                    
                          </select>
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

