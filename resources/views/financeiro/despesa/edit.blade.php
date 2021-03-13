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
              <h1>Editar despesa</h1>
            </div>
            <form action="{{route('financeiro.despesa.update', [$despesa->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="descricao">Descrição</label>
                      <textarea name="descricao" type="text" id="descricao" required autocomplete="descricao" autofocus class="form-control ">{{$despesa->descricao}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="valor">Valor</label>
                      <input name="valor" type="number" min="0" step="0.010" max="999999.99" id="valor" value="{{$despesa->valor}}" required autocomplete="valor" autofocus class="form-control ">
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="data">Data</label>
                      <input value="{{$despesa->data}}" name="data" type="date" id="data" required autocomplete="data" autofocus class="form-control ">
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