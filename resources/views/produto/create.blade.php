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
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
              <a href="#home"><img width="250px" src="{{asset('images/logo.png')}}" class="img-fluid" alt="Imagem responsiva"></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <center><h1 data-aos="fade-up">Cadastro de produto</h1></center>
            </div>
            <form action="{{route('produto.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Descrição</label>
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
                    <label for="tipo">Tipo</label>
                    <select name="tipo" class="form-control browser-default custom-select" id="tipo" required>
                      <option value="1">Cozinha</option>
                      <option value="2">Estoque</option>
                    </select>
                    @error('tipo')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                    @enderror
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="preco">Preço</label>
                    <input name="preco" type="number" min="0" step="0.010" max="999999.99" id="preco" value="{{ old('preco') }}" required autocomplete="preco" autofocus class="form-control ">
                    @error('preco')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                    @enderror
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