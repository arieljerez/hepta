@extends('app')
@section('content')

<div id="app">

  <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
  <div class="panel panel-success">
    <div class="panel-heading">Ultimos Turnos</div>
    <div class="panel-body">

     <table class="table table-hover">
          <tbody>
            @foreach ($TurnosPaciente as $TurnoPaciente)

              <tr>
                <td>

                  <fecha-turno title="{{  $TurnoPaciente->FechaTurno }}"></fecha-turno>
                  <hora-turno title="{{  $TurnoPaciente->FechaTurno }}"></hora-turno>

                <p>
                  <p>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $TurnoPaciente->Profesional }}
                  </p>
                  <p>
                    <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $TurnoPaciente->Especialidad }}
                  </p>

                  <a href="{{ url("nuevoturno/$TurnoPaciente->CodigoCobertura/$TurnoPaciente->CodigoPlan/$TurnoPaciente->CodigoEspecialidad/$TurnoPaciente->CodigoProfesional")}}" class="btn btn-success pull-right">Nuevo Turno</a>
              </td>
              </tr>
            @endforeach

          </tbody>
     </table>

    </div>
  </div>  <!-- /medico -->
</div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>



  <script type="text/javascript">

  Vue.component('fecha-turno', {
    props: ['title'],
    template: '<div><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> @{{ title | fecha_format }}</div>'
  })

  Vue.component('hora-turno', {
    props: ['title'],
    template: '<div><span class="glyphicon glyphicon-time" aria-hidden="true"></span> @{{ title | hora_format }}</div>'
  })

  Vue.filter('fecha_format', function (value) {

    var date = new moment(value);
    return date.format('DD/MM/YYYY ZZ');
  })

    Vue.filter('hora_format', function (value) {

      var date = new moment(value);
      return date.format('HH:mm A');
    })
    var vm =  new Vue({
      el: "#app",
      data: {
      fecha: '',
      hora: ''
  },
    });
  </script>
  @endsection
