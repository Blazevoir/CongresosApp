<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>One Page Wonder - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ url('assets/css/one-page-wonder.min.css') }}" rel="stylesheet">
<style type="text/css">
    form,.card-header{
        color:black;
    }
</style>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('')}}">Inicio</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @if(isset(Auth::user()->id))
           <li class="nav-item">
            <a class="nav-link" href="{{ url('home')}}">Hola, {{Auth::user()->name}}</a>
          </li>
          <li class="nav-item">
            <form class="formulario" action="{{ url('logout') }}" method="POST">
                @csrf
            </form>
            <a class="nav-link submitform" href="#">Log out</a>
          </li>
                    <li class="nav-item" data-toggle="modal" data-target="#modalReset">
            <a class="nav-link" href="#/">Reset Password</a>
          </li>
          @endif
          @if(!isset(Auth::user()->id))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Sign up</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  @isset(Auth::user()->type)
      @if(\Auth::user()->type == 'admin')
          <header class="masthead text-center text-white" style="background:linear-gradient(0deg,#E8B261 0,#D6963C 100%)">
      @endif
      @if(\Auth::user()->type == 'ponente')
          <header class="masthead text-center text-white" style="background:linear-gradient(0deg,#61CBE8 0,#32859C 100%)">
      @endif
      @if(\Auth::user()->type == 'comite')
          <header class="masthead text-center text-white" style="background:linear-gradient(0deg,#A1E9AB 0,#7FD48A 100%)">
      @endif
  @endisset
  @if(!isset(Auth::user()->type) || Auth::user()->type == 'asistente')        
      <header class="masthead text-center text-white" style="background:linear-gradient(0deg,#E86195 0,#9C325A 100%)">
  @endif
      
    
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">Congresos</h1>
        <h2 class="masthead-subheading mb-0">Ponencias y demases</h2>
        @auth
        
            @isset(Auth::user()->id)
            <h4 class="masthead-subheading mb-0" style="font-size:2em">Logeado como {{Auth::user()->type}}</h4>
            @endisset
            @isset($message)
              @isset($registro)
              <div class="alert alert-success" role="alert">
                Registro completado con éxito. Checkea tu correo para obtener tu contraseña.
              </div>
                @endisset
                @if($message == 'verificado')
              <div class="alert alert-success" role="alert">
                Cuenta verificada. Cambia tu contraseña en el siguiente link: 
              </div>
                @endif
                

              <h1>mi poollla es {{$message}}</h1>
            @endisset
            <div class="d-inline-flex p-2 bd-highlight">
              <a class="btn btn-info mr-2 mt-5" href="{{ url('ponencia') }}">Lista de ponencias</a>
              @isset(Auth::user()->type)
                @if(\Auth::user()->type == 'ponente' || \Auth::user()->type == 'admin')
                  <a class="btn btn-info mr-2 mt-5" href="{{ url('ponencia/create') }}" role="button">Añadir ponencia &raquo;</a>
                @endif
                @if(\Auth::user()->type == 'comite' || \Auth::user()->type == 'admin')
                  <a href="{{ url('listausers') }}" class="btn btn-info mr-2 mt-5">Añadir ponente</a>
                @endif
              @endisset
          @endauth
        </div>
      </div>
    </div>
@yield('content')
  </header>
  
@yield('ponencias')

  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; Blaze 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!--MODAL-->
<div class="modal fade" id="modalReset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Resetea Contraseña</h3>
      </div>
      <div class="modal-body">
        <form action="resetpassword" method="POST">
           @csrf
           <input name="actual" type="password" placeholder="Contraseña actual" class="form-control"><br>
           <input name="nueva" type="password" placeholder="Contraseña nueva" class="form-control"><br>
           <input name="nueva2" type="password" placeholder="Repite contraseña" class="form-control"><br>
           <button type="submit" class="btn btn-success">Resetear Contraseña</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</body>
  <script>
      $('.submitform').click(function(){
        $('.formulario').submit();
      });
      
  </script>
</html>


