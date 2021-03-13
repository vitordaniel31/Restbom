@extends('layouts.design')
@section('content')
 
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
          <div class="col-md-12 table-responsive">
              <a class="btn btn-primary mb-2" href="{{route('register.create')}}#registro">Novo funcionário</a>
              <table id="dataTable" class="table table-hover">
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
                    <td>@if($funcionario->tipo_perfil==1)Administrador @elseif($funcionario->tipo_perfil==2)Cozinheiro @elseif($funcionario->tipo_perfil==3)Delivery @elseif($funcionario->tipo_perfil==4)Garçom @endif</td>
                    <td>@if($funcionario->trashed())Inativo @else Ativo @endif</td>
                    <td>
                      @if(!$funcionario->trashed())
                      <button title="Editar" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('funcionario.edit', [$funcionario->id])}}#registro'"><i style="color: #039be5" class="material-icons">edit</i></button>
                      @if($funcionario->tipo_perfil!='A')
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
      </div>

    </section>

@endsection