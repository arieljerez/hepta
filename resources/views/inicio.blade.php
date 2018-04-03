@extends('app');

@section('content')

<div id="app">

  <div class="panel panel-success">
    <div class="panel-heading">Ultimos Turnos</div>
    <div class="panel-body">

     <table class="table table-hover">
          <tbody>
              <tr v-for="(ultimoturno, index) in ultimosturnos">
                <td>@{{ ultimoturno.FechaTurno }}</td>
                <td>@{{ ultimoturno.Profesional }}</td>
                <td>@{{ ultimoturno.Especialidad }}</td>
                <td><a href="nuevoturno" class="btn btn-success">Nuevo Turno</a></td>
              </tr>
          </tbody>
     </table>

    </div>
  </div>  <!-- /medico -->
</div>
@endsection
@section('js')
<script src="js/json.date-extensions.min.js"></script>
<script>
    JSON.useDateParser();
</script>
<script type="text/javascript">

  var ws = "http://appturnos.markey.com.ar/hepta/";
  var vm =  new Vue({
    el: "#app",
    data: {
      ultimosturnos: [],
      CodigoPaciente: '{{ $CodigoPaciente }}'
    },

    created: function(){

    this.$http.get(ws + 'Pacientes.svc/ObtenerUltimosTurnosPaciente?CodigoPaciente='+this.CodigoPaciente).then(function(response){

        var  ajax_data = response.body;
        this.ultimosturnos = ajax_data.ObtenerUltimosTurnosPacienteResult.TurnosPaciente;

      }, function(){
        console.log("error comunicacion vuelva a intentar");
   });


  }
});
</script>
@endsection
