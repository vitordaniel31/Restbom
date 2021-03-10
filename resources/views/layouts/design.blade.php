<!DOCTYPE html>
<html>
<head>
    <title>Restbom</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('foody/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('foody/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('foody/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('foody/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('foody/css/magnific-popup.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/favicon.ico') }}">

    <link rel="stylesheet" href="{{asset('foody/fonts/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('foody/fonts/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('foody/fonts/flaticon/font/flaticon.css')}}">
    <link href="{{asset('foody/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{asset('foody/css/style.css')}}">
    <style type="text/css">
      html {scroll-behavior: smooth;} 
    </style>
</head>
<body>
    <header role="banner ">
      <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="{{route('home')}}"><img height="100px" width="100px" src="{{asset('images/logo.png')}}"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav ml-auto pl-lg-5 pl-0">
              @if(Auth::check())
              <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" ondblclick="window.location.href = '{{route('financeiro.index')}}#financeiro'" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Financeiro</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <a class="dropdown-item" href="{{route('financeiro.despesa.create')}}#saidas">Nova despesa</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" ondblclick="window.location.href = '{{route('funcionario.index')}}#funcionarios'" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Funcionários</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <a class="dropdown-item" href="{{route('register.create')}}#registro">Novo funcionário</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" ondblclick="window.location.href = '{{route('pedido.index')}}#pedidos'" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pedidos</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <a class="dropdown-item" href="{{route('pedido.create')}}#pedidos">Novo pedido</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" ondblclick="window.location.href = '{{route('produto.index')}}#produtos'" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produtos</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <a class="dropdown-item" href="{{route('produto.create')}}#produtos">Novo produto</a>
                </div>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}#home">Cover</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}#login">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('password.request')}}#redefinir">Redefinir senha</a>
              </li>
            @endif 
            </ul>
            @if(Auth::check())
            <ul class="navbar-nav ml-auto">
              <li class="nav-item cta-btn">
                <form action="{{route('logout')}}" id="logout" method="POST">
                  @csrf
                  <a class="nav-link" onclick="document.getElementById('logout').submit();">Sair</a>
                </form>
              </li>
            </ul>
            @endif
          </div> 
        </div>
      </nav>
    </header>
    <!-- END header -->

    @yield('content')

    <footer class="site-footer" role="contentinfo">
      
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-4 mb-5">
            <h3>Sobre nós</h3>
            <p class="mb-5">Somos estudantes do Instituto de Educação, Ciência e Tecnologia do Rio Grande do Norte, do Curso Técnico Integrado em Nível Médio de Informática. Programadores fanáticos, decidimos fazer um sistema de administração de restaurantes perfeito para você<i class="fa fa-heart text-danger" aria-hidden="true"></i>. </p>
            <ul class="list-unstyled footer-link d-flex footer-social">
              <li><a href="#" class="p-2"><span class="fa fa-twitter"></span></a></li>
              <li><a href="#" class="p-2"><span class="fa fa-facebook"></span></a></li>
              <li><a href="#" class="p-2"><span class="fa fa-linkedin"></span></a></li>
              <li><a href="#" class="p-2"><span class="fa fa-instagram"></span></a></li>
            </ul>

          </div>
          <div class="col-md-5 mb-5">
            <div>
              <h3>Contatos</h3>
              <ul class="list-unstyled footer-link">
                <li class="d-block"><span class="d-block text-black">Telefone:</span><span>+55 83 99614 1306</span></li>
                <li class="d-block"><span class="d-block text-black">Email:</span><span>contato@restbom.com.br</span></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3 mb-5">
            <h3>Quick Links</h3>
            <ul class="list-unstyled footer-link">
              <li><a href="#">About</a></li>
              <li><a href="#">Terms of Use</a></li>
              <li><a href="#">Disclaimers</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
          <div class="col-md-3">
          
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-md-center text-left">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- END footer -->

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#cf1d16"/></svg></div>

    <script src="{{asset('foody/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('foody/js/popper.min.js')}}"></script>
    <script src="{{asset('foody/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('foody/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('foody/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('foody/js/aos.js')}}"></script>

    <script src="{{asset('foody/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('foody/js/magnific-popup-options.js')}}"></script>
    

    <script src="{{asset('foody/js/main.js')}}"></script>

    <script src="{{asset('foody/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('foody/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('foody/datatables/datatables-demo.js')}}"></script>

</body>
</html>