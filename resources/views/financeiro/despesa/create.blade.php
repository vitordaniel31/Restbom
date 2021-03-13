@extends('layouts.design')
@section('content')
  
<section id='saidas' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
              <a href="#home"><img width="250px" src="{{asset('images/logo.png')}}" class="img-fluid" alt="Imagem responsiva"></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <h1>Cadastro de despesa</h1>
            </div>
            <form action="{{route('financeiro.despesa.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="descricao">Descrição</label>
                      <textarea name="descricao" type="text" id="descricao" value="{{ old('descricao') }}" required autocomplete="descricao" autofocus class="form-control "></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="valor">Valor</label>
                      <input name="valor" type="number" min="0" step="0.010" max="999999.99" id="valor" value="{{ old('valor') }}" required autocomplete="valor" autofocus class="form-control ">
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="data">Data</label>
                      <input value="{{date('Y-m-d')}}" name="data" type="date" id="data" required autocomplete="data" autofocus class="form-control ">
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