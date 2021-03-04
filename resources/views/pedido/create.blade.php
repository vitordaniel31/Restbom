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
<section id='pedidos' class="section pt-5 top-slant-white2 relative-higher bottom-slant-gray">
      <div class="container card">  
        <div class="row">
          <div class="col-lg-6 ">
            <div class="row justify-content-center">
              <a href="#home"><img width="250px" src="{{asset('images/logo.png')}}" class="img-fluid" alt="Imagem responsiva"></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row justify-content-center">
              <h1>Cadastro de pedido</h1>
            </div>
            <form action="{{route('pedido.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="cliente">Cliente</label>
                      <input name="cliente" type="text" id="descricao" value="{{ old('cliente') }}" required autocomplete="cliente" autofocus class="form-control ">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-check">
                      <input onchange="if(document.getElementById('delivery').checked){document.getElementById('mesa1').style.display = 'none'; document.getElementById('mesa').removeAttribute('required'); document.getElementById('mesa').removeAttribute('name'); document.getElementById('endereco1').style.display = 'block'; document.getElementById('endereco').setAttribute('required','required'); document.getElementById('endereco').setAttribute('name','endereco'); document.getElementById('observacao1').style.display = 'block'; document.getElementById('observacao').setAttribute('name','observacao'); }else{document.getElementById('mesa1').style.display = 'block'; document.getElementById('mesa').setAttribute('required','required'); document.getElementById('mesa').setAttribute('name','mesa'); document.getElementById('endereco1').style.display = 'none'; document.getElementById('endereco').removeAttribute('required'); document.getElementById('endereco').removeAttribute('name'); document.getElementById('observacao1').style.display = 'none'; document.getElementById('observacao').removeAttribute('required'); document.getElementById('observacao').removeAttribute('name');}" class="form-check-input" type="checkbox" value="1" id="delivery" name="delivery">
                      <label class="form-check-label" for="flexCheckDefault">
                        Delivery
                      </label>
                    </div>
                </div>
         
                  <div id="mesa1" class="row">
                    <div class="col-md-12 form-group">
                      <label for="mesa">Mesa</label>
                      <input name="mesa" type="text" id="mesa" value="{{ old('mesa') }}" autocomplete="mesa" autofocus class="form-control" required>
                    </div>
                </div>

                <div id="endereco1" class="row" style="display: none;">
                    <div class="col-md-12 form-group">
                      <label for="endereco">Endereço</label>
                      <input name="endereco" type="text" id="endereco" value="{{ old('endereco') }}" autocomplete="endereco" autofocus class="form-control">
                    </div>
                </div>

                <div id="observacao1" class="row" style="display: none;">
                    <div class="col-md-12 form-group">
                      <label for="observacao">Observação</label>
                      <input name="observacao" type="text" id="observacao" value="{{ old('observacao') }}" autocomplete="observacao" autofocus class="form-control">
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

    <script type="text/javascript">
      function select() {
        alert(1);
        document.getElementById('mesa1').style.display = 'block';
      }
    </script>

    
@endsection