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
  <section id='financeiro' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container">

            <div class="row justify-content-center">
              <h1>Despesas</h1>
            </div>
          
        <div class="row">
          <div class="col-md-12 table-responsive">
            <a class="btn btn-primary mb-2" href="{{route('financeiro.despesa.create')}}#saidas">Nova despesa</a>
              <table id="dataTable" class="table table-hover">
                <thead>
                  <tr bgcolor="#F2F2F2">
                    <th>DESCRIÇÃO</th>
                    <th>VALOR (R$)</th>
                    <th>DATA</th>
                    <th>AÇÕES</th>
                  </tr>
                </thead>
              <tbody>
                <tr>
                @foreach ($despesas as $despesa)
                    <td>{{$despesa->descricao}}</td>
                    <td>R$ {{$despesa->valor}}</td>
                    <td>{{date('d/m/Y'), strtotime('$despesa->data')}}</td>
                    <td>
                      <button title="Editar" class="btn btn-sm bg-transparent " onclick="window.location.href='{{route('financeiro.despesa.edit', [$despesa->id])}}#saidas'"><i style="color: #039be5" class="material-icons">edit</i></button>
                      <form action="{{route('financeiro.despesa.destroy', [$despesa->id])}}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button title="Excluir" class="btn btn-sm bg-transparent " type="submit" name="action"><i style="color: #039be5" class="material-icons">cancel</i></button>
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