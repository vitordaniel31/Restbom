@extends('layouts.design')
@section('content')
 
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
            <div class="col-md-8 text-center col-sm-12 ">
                <h1 data-aos="fade-up">Editar funcionário</h1>
              </div>
            </div>
            <form action="{{route('funcionario.update', [$funcionario->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Nome</label>
                      <input value="{{$funcionario->name}}" name="name" type="text" id="name" required autocomplete="name" autofocus class="form-control ">
                        @error('name')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Email</label>
                      <input value="{{$funcionario->email}}" name="email" type="email" id="email" required autocomplete="email" autofocus class="form-control ">
                        @error('email')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                @if(($funcionario->tipo_perfil)!='A')
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="tipo_perfil">Perfil</label>
                      <select name="tipo_perfil" class="form-control browser-default custom-select" id="tipo_perfil" required>
                        <option value="2" @if(($funcionario->tipo_perfil)==2)selected @endif>Cozinheiro</option>
                        <option value="3" @if(($funcionario->tipo_perfil)==3)selected @endif>Delivery</option>
                        <option value="4" @if(($funcionario->tipo_perfil)==4)selected @endif>Garçom</option>
                      </select>
                    </div>
                </div>
                @endif
             
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
