@extends('layouts.design')
@section('content')
 
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
              <center><h1 data-aos="fade-up">Editar produto</h1></center>
            </div>
            <form action="{{route('produto.update', [$produto->id])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Descrição</label>
                      <textarea name="descricao" type="text" id="descricao" required autocomplete="descricao" autofocus class="form-control ">{{$produto->descricao}}</textarea>
                      @error('descricao')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                      @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="name">Preço</label>
                      <input name="preco" type="number" min="0" step="0.010" max="999999.99" id="preco" value="{{$produto->preco}}" required autocomplete="preco" autofocus class="form-control ">
                      @error('preco')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                      @enderror
                    </div>
                    
                        <div class="col-md-6 form-group">
                          <label for="tipo">Tipo</label>
                          <select name="tipo" class="form-control" id="tipo" required>
                            <option value="1" @if(($produto->tipo)==1)selected @endif>Cozinha</option>
                            <option value="2" @if(($produto->tipo)==2)selected @endif>Estoque</option>          
                          </select>
                          @error('tipo')
                            <div class="alert alert-primary" role="alert">
                                {{ $message }}
                            </div>
                          @enderror
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

