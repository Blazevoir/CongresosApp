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
  <link href="assets/css/one-page-wonder.min.css" rel="stylesheet">
<style type="text/css">
    form{
        color:black;
    }
        form{
      display:flex;
      flex-wrap:wrap;
      justify-content:center;
      align-items:center;
    }
    form>*{
      width:50%;
      margin-bottom:20px;
    }
    input[type="submit"]{
      width:100%;
      cursor:pointer;
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
        </ul>
      </div>
    </div>
  </nav>


      @if(\Auth::user()->type == 'admin')
          <header class="masthead text-center text-white" style="background:linear-gradient(0deg,#E8B261 0,#D6963C 100%)">
      @endif
      @if(\Auth::user()->type == 'ponente')
          <header class="masthead text-center text-white" style="background:linear-gradient(0deg,#61CBE8 0,#32859C 100%)">
      @endif
      @if(\Auth::user()->type == 'comite')
          <header class="masthead text-center text-white" style="background:linear-gradient(0deg,#A1E9AB 0,#7FD48A 100%)">
      @endif
      @if(\Auth::user()->type == 'asistente')
          <header class="masthead text-center text-white" style="background:linear-gradient(0deg,#E86195 0,#9C325A 100%)">
      @endif
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">Home de {{Auth::user()->name}}</h1>
        <h4 class="masthead-subheading mb-0" style="font-size:2em">Logeado como {{Auth::user()->type}}</h4>
        @isset($pagado)
              @if(!$pagado)
                <div class="alert alert-danger" role="alert">
                    Aún no has hecho el pago por el congreso. Rellénalo más abajo
                </div>
              @elseif($pagado)
                <div class="alert alert-warning" role="alert">
                    Pago pendiente de verificacion.
                </div>
              @endif
            @endisset
            @yield('content')
      </div>
    </div>

  </header>
  @if(!(\Request::is('login') || \Request::is('register')))
  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="assets/img/perfil/{{Auth::user()->imagen}}" alt="Profile pic">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            
    			<div class="col-md-12 pl-md-5 py-md-5">
    				<div class="row justify-content-start pt-3 pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		          	<h2 class="subheading mb-3">Actualizar perfil</h2>
                    <form action="{{url('/update')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <label for="name">Nombre</label>
                        <input type="text" placeholder="{{Auth::user()->name}}" name="name" id="name">
                        <label for="email">Email</label>
                        <input type="email" placeholder="{{Auth::user()->email}}" name="email" id="email">
                        <label for="foto">Foto de perfil</label>
                        <input type="file" name="foto">
                  				@if(\App\Pago::where('iduser',Auth::user()->id)->first() == null)
            				        <label for="pago">Justificante de pago</label>
                            <input type="file" name="pago">
                          @endif
                        <input type="hidden" value="{{Auth::user()->id}}" name="iduser">
                        <input type="submit" value="Actualizar">
                    </form>
		          </div>
		        </div>
	        </div>
	        
            </div>
        </div>
      </div>
    </div>
  </section>

  
@endif
  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
      $('.submitform').click(function(){
        $('.formulario').submit();
      });
      
  </script>
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

</html>
