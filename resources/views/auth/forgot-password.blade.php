@extends('layouts.design')
@section('content')
    <section id='recuperar' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
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
                <h1 data-aos="fade-up">Recupere sua senha</h1>
              </div>
            </div>
            <p>Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e nós enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.</p>
            <form action="{{route('password.email')}}" method="post">
                @csrf
                @if(Session::has('status'))
                  <div class="alert alert-success" role="alert">
                    {{ Session::get('status') }}
                  </div>
                @endif
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
             
                <div class="row justify-content-center">
                    <div class="form-group">
                      <input type="submit" value="Enviar" class="btn btn-primary">
                    </div>
                </div>  
                <div class="row justify-content-center">
                    <a class="btn btn-link" href="{{ route('login') }}">Fazer login</a>
                </div>  
            </form>
          </div>
        </div>
      </div>

    </section>

  <script type="text/javascript">
    window.location.href="#recuperar";
  </script>
@endsection

