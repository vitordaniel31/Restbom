@extends('layouts.design')
@section('content')
  <section id='produtos' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

  
      <div class="row justify-content-center">
        <h1>Produtos</h1>
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
            <a class="btn btn-primary mb-2" href="{{route('produto.create')}}#produtos">Novo produto</a>
              <table id="dataTable" class="table table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>DESCRIÇÃO</th>
                    <th>TIPO</th>
                    <th>PREÇO (R$)</th>
                    <th>STATUS</th>
                    <th>AÇÕES</th>
                  </tr>
                </thead>
              <tbody>
                @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->descricao}}</td>
                    <td>@if($produto->tipo==1) Cozinha @elseif($produto->tipo==2) Estoque @endif</td>
                    <td>R$ {{$produto->preco}}</td>
                    <td>@if($produto->trashed())Inativo @else Ativo @endif</td>
                    <td>
                      @if(!$produto->trashed())
                      <button title="Editar" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('produto.edit', [$produto->id])}}#produtos'"><i style="color: #039be5" class="material-icons">edit</i></button>
                      @if($produto->estoque)
                      <button title="Estoque" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('estoque.edit', [$produto->id])}}#estoque'"><i style="color: #039be5" class="material-icons">input</i></button>
                      @endif
                      <form action="{{route('produto.destroy', [$produto->id])}}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button title="Desativar" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">cancel</i></button>
                      </form>
                      @endif

                      @if($produto->trashed())
                      <form action="{{route('produto.restore', [$produto->id])}}" method="POST" style="display: inline;">
                          @csrf
                          @method('PUT')
                          <button title="Ativar" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">check</i></button>
                      </form>
                      @endif

                    </td>
                 </tr>
                @endforeach
              </tr>
            </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>

@endsection