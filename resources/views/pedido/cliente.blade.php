@extends('design')
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
              <table class="table table-hover">
            <thead>
              <tr bgcolor="#F2F2F2">
                <th>DESCRICÃO</th>
                <th>ESPERA</th>
                <th>STATUS</th>
                <th>AÇÕES</th>
              </tr>
            </thead>
          <tbody>
            <tr>
            @foreach ($consulta2 as $resultado2)
                <td>{{$resultado2->pro_descricao . ' ' . $resultado2->itp_descricao}}</td>
                <td>{{$resultado2->pro_descricao}}</td>
                <td>@if($resultado2->itp_status == 0 and $resultado2->pro_tipo=='Cozinha') Em preparo
                @elseif($resultado2->itp_status == 0 and $resultado2->pro_tipo=='Estoque') Em estoque
                @elseif($resultado2->itp_status == 1 and $resultado2->pro_tipo=='Cozinha') Pronto
                @elseif($resultado2->itp_status == 2) Entregue
                @endif
                </td>
                <td>
                  <form action="{{url('/pedidos/excluir', [$resultado->ped_codigo])}}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">delete</i></button>
                  </form>
                  <form  action="{{url('/pedidos/atualizar')}}" method="POST" style="display: inline; ">
                      @csrf
                      <input type="hidden" name="id" value="{{$resultado->ped_codigo}}">
                      <button class="btn btn-sm bg-transparent" type="submit" name="action"><i style="color: #039be5" class="material-icons">edit</i></button>
                  </form>
    
                </td>
             </tr>
            @endforeach
          </tr>
        </tbody>
        </table>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <h1>Comanda {{$resultado}}</h1>
            </div>
            <form action="{{route('insertItem')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                          <label for="codigo">Tipo</label>
                          <select name="itp_pro_codigo" class="form-control browser-default custom-select" id="codigo" required>
                            @foreach ($consulta3 as $resultado3)
                            <option value="{{$resultado3->pro_codigo}}">{{$resultado3->pro_descricao}}</option>
                            @endforeach                  
                          </select>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                      <input type="hidden" name="itp_ped_codigo" value="{{$resultado}}">
                      <label for="descricao">Descrição</label>
                      <textarea name="itp_descricao" type="text" id="descricao" value="{{ old('descricao') }}" required autocomplete="descricao" autofocus class="form-control "></textarea>
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