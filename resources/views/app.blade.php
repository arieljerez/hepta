
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Hepta - Centro Medico -  Portal de turnos</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- wizard -->
    <link href="wizard/prettify.css" rel="stylesheet">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <div class="navbar-header">
             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="#">Hepta</a>
           </div>

        </div>

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ route('inicio')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio </a></li>
            <li><a href="{{ route('mis-datos')}}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Mis Datos</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Mis Turnos</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Nuevo Turno</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Nuevo Turno</button>
          </ul>

          <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Nombre, usuario <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar Sesión</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>

        </div>



      </div>
    </nav>
<div class="container-fluid">
  @yield('content')
</div> <!-- /container -->
    <footer class="footer">
      <div class="container">
        <span class="text-muted">2018 - Copyright </span>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="wizard/jquery.bootstrap.wizard.js"></script>
    <script src="wizard/prettify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.0"></script>
    <script src="https://unpkg.com/vue-cookies@1.5.5/vue-cookies.js"></script>
    @yield('js')
  </body>
</html>