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
    <section id='login' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
              <a href="#home"><img width="250px" src="{{asset('images/logo.png')}}" class="img-fluid" alt="Imagem responsiva"></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
            <div class="col-md-8 text-center col-sm-12 ">
                <h1 data-aos="fade-up">Login</h1>
              </div>
            </div>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="email">Email</label>
                      <input name="email" type="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control ">
                        @error('email')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" required autocomplete="current-password" autofocus class="form-control ">
                        @error('password')
                        <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
             
                <div class="row justify-content-center">
                    <div class="form-group">
                      <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>
                </div>  
                <div class="row justify-content-center">
                    <a class="btn btn-link" href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                </div>  
            </form>
          </div>
        </div>
      </div>

    </section>
@endsection

