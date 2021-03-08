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
               @foreach ($pedido->item as $item)
                <td>{{$item->produto->descricao . ' (' . $item->observacao . ')'}}</td>
                <td>{{date("Y-m-d H:i:s")-$item->created_at}}</td>
                <td>Em preparo</td>
                <td></td>
             </tr>
            @endforeach 
          </tr>
        </tbody>
        </table>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
            <div class="col-md-8 text-center col-sm-12 ">
                <h1 style="display: inline;" data-aos="fade-up">Comanda {{$pedido->id}}</h1>
                <img height="200px" width="200px"  src="{{route('pedido.qrcode', [$pedido->id])}}"> <!--gerar qr code -->
              </div>
            </div>
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                          <label for="id_produto">Produto</label>
                          <select name="id_produto" class="form-control browser-default custom-select" id="id_produto" required>
                            @foreach ($produtos as $produto)
                            <option value="{{$produto->id}}">{{$produto->descricao}}</option>
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
          </div>
        </div>
      </div>

    </section>
@endsection