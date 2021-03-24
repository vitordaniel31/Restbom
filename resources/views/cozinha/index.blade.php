@extends('layouts.design')
@section('content')
  <section id='cozinha' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

  
      <div class="row justify-content-center">
        <h1>Cozinha</h1>
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
              <table id="dataTable" class="table table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>DESCRIÇÃO</th>
                    <th>AÇÕES</th>
                  </tr>
                </thead>
              <tbody>
                @foreach ($itens as $item)
                <tr>
                    <td>{{$item->produto->descricao}} {{($item->observacao)}}</td>
                    <td>
                      <form action="{{route('cozinha.update', [$item->id])}}" method="POST" style="display: inline;">
                          @csrf
                          @method('PUT')
                          <button title="Pronto" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">check</i></button>
                      </form>
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