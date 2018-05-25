
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
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">

    <style>
    html, body {
          background-color: #E2E2E0;
          margin-top: 10px;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
</style>

  </head>

  <body>

<div id="app" class="container flex-center"  >

<form id="loginForm" method="post" action="{{ route('login')}}">
    <div class="row">
      <div class="col-4">
        <a href="#" class="thumbnail well-lg" style="background-color: #D8E2EB">
          <img src="{{ asset('images/logo_grande.png') }}" alt="...">
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
          <h2 class="form-signin-heading">Módulo de autogestión</h2>
<div class="form-group">
  <label for="documento">Número de documento</label>
  <input type="number" id="documento" name="documento" v-model="documento" class="form-control" placeholder="9999999" required autofocus>
  <label for="clave">Contraseña</label>
  <input type="password" id="clave" name="clave" v-model="clave" class="form-control" placeholder="*******" required>

</div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></button>
          {{ csrf_field() }}

          <p>
            Es nuevo u olvidó su contraseña? haga click <a href="{{ route('recuperarclave') }}">aquí</a>
          </p>
      </div>
    </div>

</form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.0"></script>
<script src="https://unpkg.com/vue-cookies@1.5.5/vue-cookies.js"></script>
