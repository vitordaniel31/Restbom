@extends('layouts.design')
@section('content')
    <section id='alterar' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
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
                <h1 data-aos="fade-up">Altere sua senha</h1>
              </div>
            </div>
            <form action="{{ route('password.update') }}" method="post">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="password_confirm">Confirmar senha</label>
                        <input type="password" id="password_confirm" name="password_confirmation" required autocomplete="new-password" autofocus class="form-control ">
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

  <script type="text/javascript">
    window.location.href="#alterar";
  </script>
@endsection

