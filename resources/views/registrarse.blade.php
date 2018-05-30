@extends('.app')

@section('content')
<div class="col-md-6 col-md-offset-3" id="app">
  <form class="form" method="post" action="{{ url('registrarse') }}">
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
      <div class="form-group col-md-4">
        <label for="dni" class="form-label">DNI</label>
        <input type="number" class="form-control" placeholder="DNI" name="documento" id="documento" value="{{$documento}}" required>
      </div>
      <div class="form-group col-md-4">
        <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
        <input type="date" class="form-control" placeholder="Fecha Nacimiento" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $fecha_nacimiento }}" required>
      </div>
      <div class="form-group col-md-4">
        <label for="Sexo" class="form-label">Sexo</label><br />
         <label for="Sexo" class="form-label">M:</label> <input type="radio" name="sexo" value="Masculino">
         <label for="Sexo" class="form-label">F:</label> <input type="radio" name="sexo" value="Femenino">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
          <div class="form-group">
            <label for="mail" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" placeholder="Correo Electrónico" name="email" id="email" required>
          </div>
          <div class="form-group">
            <label for="mail" class="form-label">Verifica Correo Electrónico</label>
            <input type="email" class="form-control" placeholder="Correo Electrónico" name="email_confirm" id="email" required>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <label for="telefono_1" class="form-label">Teléfono fijo</label>
                <input type="text" class="form-control" placeholder="+54 11 1599999999" name="telefono_fijo" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="telefono_2" class="form-label">Teléfono Celular</label>
            <input type="text" class="form-control" placeholder="(011) 9999-9999" name="telefono_celu" required>
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
            <label for="cobertura" class="form-label">Cobertura</label>

            <select class="form-control" placeholder="Cobertura" name="cobertura" v-model="selectcobertura">
              <option value="0">Seleccione Cobertura</option>
              @foreach($coberturas as $cobertura)
              <option value="{{ $cobertura->CodigoCobertura }}">{{ $cobertura->DescripcionCobertura }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="plan" class="form-label">Plan</label>

            <select class="form-control" placeholder="Plan" name="plan" v-model="selectplan">
              <option value="0">Seleccione Plan</option>
              <template v-for="plan in planes">
                <option :value="plan.CodigoPlan">@{{ plan.DescripcionPlan }}</option>
              </template>
            </select>

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
  <pre class="code">
    selectcobertura: @{{ selectcobertura}}
    selectplan :  @{{ selectplan}}
    coberturas: @{{ coberturas }}
    planes: @{{ planes }}
  </pre>
</div>


@endsection

@section('js')
    <script type="text/javascript">

    var ws = '{{ env("WS_BASE_URI")  ."/". env("WS_RESOURCE")."/" }}';

    var vm =  new Vue({
      el: "#app",
      data: {
        coberturas: [],
        planes: [],
        selectcobertura: 0,
        selectplan: 0
      },
      methods: {
        obtenerPlanes: function(){
          this.$http.get(ws +'Turnos.svc/ObtenerPlanes?CodigoCobertura=' + this.selectcobertura).then(function(response){
               this.planes = response.body.ObtenerPlanesResult.Planes;
               }, function(){
                  console.log("error al recuperar coberturas")
               });

        },
      },
      watch: {
        selectcobertura: function(){
          if (this.selectcobertura > 0){
              this.obtenerPlanes();
          }
        }
      }
  });
  </script>
@endsection
