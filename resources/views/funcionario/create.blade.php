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
    <section id='registro' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
              <a href="#home"><img width="250px" src="{{asset('images/logo.png')}}" class="img-fluid" alt="Imagem responsiva"></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <h1>Registre-se</h1>
            </div>
            <form action="{{route('insertFuncionario')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Nome</label>
                      <input name="name" type="text" id="name" value="{{ old('name') }}" required autocomplete="name" autofocus class="form-control ">
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-12 form-group">
                          <label for="funcao">Função</label>
                          <select name="funcao" class="form-control browser-default custom-select" id="funcao" required>
                            <option value="Cozinheiro">Cozinheiro</option>
                            <option value="Delivery">Delivery</option>
                            <option value="Garcom">Garçom</option>
                            <option value="Gerente">Gerente</option>
                          </select>
                        </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Email</label>
                      <input name="email" type="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control ">
                        @if(@$email)
                            <div class="alert alert-primary">
                                {{$email}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" required autocomplete="current-password" autofocus class="form-control" min="8">
                        
                        <div id="alerta" style="display: none;" class="alert alert-primary">
                            As senhas não coincidem!
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="password_confirm">Confirmar senha</label>
                        <input type="password" id="password_confirm" name="password_confirmation" required autocomplete="new-password" autofocus class="form-control ">
                    </div>
                </div>
             
                <div class="row justify-content-center">
                    <div class="form-group">
                      <input type="submit" onclick="return verifica();" value="Enviar" class="btn btn-primary">
                    </div>
                </div>  
            </form>
          </div>
        </div>
      </div>

    </section>
    <script>
      function verifica() {
        var senha = document.getElementById('password').value; 
        var confirmar = document.getElementById('password_confirm').value;
        if (senha==confirmar) return true;
        else{
           document.getElementById('alerta').style.display = 'block';
           return false;
        }
      }
    </script>
@endsection
