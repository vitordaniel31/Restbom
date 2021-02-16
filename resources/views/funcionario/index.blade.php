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
  <section id='funcionarios' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

        <div class="row justify-content-center">
          <h1>Funcionários</h1>
        </div>

        @foreach (['primary', 'success'] as $msg)
          @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }}" role="alert">
              {{ Session::get('alert-' . $msg) }}
            </div>
          @endif
        @endforeach
        <div class="row">
          <table class="table table-hover">
            <thead>
              <tr bgcolor="#F2F2F2">
                <th>NOME</th>
                <th>EMAIL</th>
                <th>PERFIL</th>
                <th>STATUS</th>
                <th>AÇÕES</th>
              </tr>
            </thead>
          <tbody>
            @foreach ($funcionarios as $funcionario)
              <tr>
                <td>{{$funcionario->name}}</td>
                <td>{{$funcionario->email}}</td>
                <td>{{$funcionario->tipo_perfil}}</td>
                <td>@if($funcionario->trashed())Inativo @else Ativo @endif</td>
                <td>
                  @if(!$funcionario->trashed())
                  <button title="Editar" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('funcionario.edit', [$funcionario->id])}}#registro'"><i style="color: #039be5" class="material-icons">edit</i></button>
                  @if(($funcionario->tipo_perfil)!='A')
                  <form action="{{route('funcionario.destroy', [$funcionario->id])}}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button title="Desativar" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">cancel</i></button>
                  </form>
                  @endif
                  @endif

                  @if(($funcionario->tipo_perfil)!='A' and $funcionario->trashed())
                  <form action="{{route('funcionario.restore', [$funcionario->id])}}" method="POST" style="display: inline;">
                      @csrf
                      @method('PUT')
                      <button title="Ativar" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">check</i></button>
                  </form>
                  @endif
                </td>
              </tr>
            @endforeach
        </tbody>
        </table>
        </div>
      </div>

    </section>

@endsection