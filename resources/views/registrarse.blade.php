@extends('.app')

@section('content')
<div class="col-md-6 col-md-offset-3">
  <form class="form"  method="post">
    <div class="panel panel-default panel-info">
    <div class="panel-heading">Registrarse</div>

    <div class="panel-body">
    <div class="row">
      <div class="col-md-4">
        <img class="card-img-top" width="150rem" src="{{ url('images/Man_silhouette.svg.png') }}">
      </div>

      <div class="col-md-8">
        <div class="row">
          <div class="form-group col-md-12">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" placeholder="Apellido" name="apellido" id="apellido" required>
          </div>
          <div class="form-group col-md-12">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" required>
          </div>
        </div>

      </div>

    </div>

    <div class="row">
      <div class="form-group col-md-3">
        <label for="dni" class="form-label">DNI</label>
        <input type="number" class="form-control" placeholder="DNI" name="documento" id="documento" value="{{$documento}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
        <input type="date" class="form-control" placeholder="Fecha Nacimiento" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $fecha_nacimiento }}" required>
      </div>
      <div class="form-group col-md-3">
        <label for="Sexo" class="form-label">Sexo</label><br />
         <label for="Sexo" class="form-label">M:</label> <input type="radio" name="sexo" value="Masculino">
         <label for="Sexo" class="form-label">F:</label> <input type="radio" name="sexo" value="Femenino">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
          <div class="form-group">
            <label for="mail" class="form-label">Correo Electrónico</label>
            <input type="text" class="form-control" placeholder="Correo Electrónico" name="email" id="email" required>
          </div>
          <div class="form-group">
            <label for="mail" class="form-label">Verifica Correo Electrónico</label>
            <input type="text" class="form-control" placeholder="Correo Electrónico" name="email" id="email" required>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <label for="telefono_1" class="form-label">Teléfono 1</label>
                <input type="text" class="form-control" placeholder="Teléfono 1" name="telefono_1" id="telefono_1" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="telefono_2" class="form-label">Teléfono 2</label>
            <input type="text" class="form-control" placeholder="Teléfono 2" name="telefono_2" id="telefono_2" required>
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
            <label for="cobertura" class="form-label">Cobertura</label>
            <input type="text" class="form-control" placeholder="Cobertura" name="cobertura" id="cobertura" required>
          </div>
          <div class="form-group">
            <label for="plan" class="form-label">Plan</label>
            <input type="text" class="form-control" placeholder="Plan" name="plan" id="plan" required>
          </div>
          <div class="form-group">
            <label for="numero_afiliado" class="form-label">Número Afiliado</label>
            <input type="number" class="form-control" placeholder="Número Afiliado" name="numero_afiliado" id="numero_afiliado" required>
          </div>

      </div>
    </div>

    </div>
      <div class="panel-footer">
        {{ csrf_field() }}
        <button type="submit" name="button"class="btn btn-success">Registrarme</button>
        <a href="{{route('inicio')}}" class="btn btn-primary">Cancelar</a>
      </div>
  </div>
  </form>
</div>
@endsection
