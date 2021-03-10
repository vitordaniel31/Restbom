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
<section id='itens' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
            <div class="col-md-8 text-center col-sm-12 ">
                <h1 style="display: inline;" data-aos="fade-up">Comanda {{$pedido->id}}</h1>
                <img height="200px" width="200px"  src="{{route('pedido.qrcode', [$pedido->remember_token])}}"> <!--gerar qr code -->
              </div>
            </div>
            @if(!$pedido->trashed())
            <form action="{{route('pedido.item.store', [$pedido->remember_token])}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 form-group">
                          <label for="id_produto">Produto</label>
                          <select name="id_produto" class="form-control browser-default custom-select" id="id_produto" required>
                            @foreach ($produtos as $produto)
                            <option value="{{$produto->id}}">{{$produto->descricao}} - R${{$produto->preco}}</option>
                            @endforeach                  
                          </select>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="descricao">Descrição</label>
                      <textarea name="descricao" type="text" id="descricao" value="{{ old('descricao') }}" autocomplete="descricao" autofocus class="form-control "></textarea>
                    </div>
                </div>
                
                <div class="row justify-content-center">
                    <div class="form-group">
                      <input type="submit" value="Adicionar" class="btn btn-primary">
                    </div>
                </div>  
            </form>
            @endif
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center table-responsive ml-1">
              <table class="table table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>DESCRICÃO</th>
                    <th>PREÇO</th>
                    <th>ESPERA</th>
                    <th>STATUS</th>
                    <th>AÇÕES</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr bgcolor="#F2F2F2">
                    <th class="text-right">TOTAL:</th>
                    <th>R$ {{$pedido->item->sum('produto.preco')}}</th>
                    <th></th>
                    <th>@if(!$pedido->trashed())<a class="btn btn-primary mb-2" href="{{route('produto.create')}}#produtos">Pagar</a>@endif</th>
                    <th></th>
                  </tr>
                </tfoot>
              <tbody>
                   @foreach ($pedido->item as $item)
                  <tr>
                    <td>{{$item->produto->descricao}} @if($item->observacao) ({{$item->observacao}}) @endif</td>
                    <td>R${{$item->produto->preco}}</td>
                    <td>@if((strtotime(date("Y-m-d H:i:s")) - strtotime($item->created_at))>=3600){{number_format(((strtotime(date("Y-m-d H:i:s")) - strtotime($item->created_at))/3600), 2, ',', '')}} horas @else {{number_format(((strtotime(date("Y-m-d H:i:s")) - strtotime($item->created_at))/60), 2, ',', '')}} minutos @endif</td>
                    <td>@if($item->status==0) Em preparo @elseif($item->status==1) À servir @elseif($item->status==2) Servido @elseif($item->status==3) Entregue @endif</td>
                    <td>@if(Auth::check())
                        @if($item->status==1 and !$pedido->delivery)
                          <form action="{{route('pedido.item.update', [$item->id])}}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('PUT')
                                  <button title="Servir" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">room_service</i></button>
                              </form>
                          @endif
                        @endif
                      @if($item->status==0 or ($item->produto->tipo==2 and $item->status==1))
                      <form action="{{route('pedido.item.destroy', [$item->id])}}" method="POST" style="display: inline;">
                              @csrf
                              @method('DELETE')
                              <button title="Excluir" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">delete</i></button>
                          </form>
                      @endif  
                    </td>
                 </tr>
                @endforeach 
              
              </tbody>
            </table>
            @if($pedido->delivery and !$pedido->trashed())
              <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="endereco">Descrição</label>
                      <textarea type="text" id="endereco" autocomplete="endereco" autofocus class="form-control" disabled="">{{$pedido->delivery->endereco}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="observacao">Observação</label>
                      <textarea  type="text" id="observacao" value="{{$pedido->delivery->observacao}}" autocomplete="observacao" autofocus class="form-control" disabled="">{{$pedido->delivery->observacao}}</textarea>
                    </div>
                </div>
              <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="entregador">Entregador</label>
                      <input type="text" id="entregador" value="{{@$pedido->delivery->user->name}}" autocomplete="entregador" autofocus class="form-control" disabled="">
                    </div>
                </div>
            </div>
            @endif

          </div>
        </div>
      </div>

    </section>
@endsection