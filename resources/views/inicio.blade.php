@extends('app')
@section('content')

<div id="app">

        <div class="col-sm-8 col-sm-offset-8 col-md-8 col-md-offset-2">
  <div class="panel panel-success">
    <div class="panel-heading">Ultimos Turnos</div>
    <div class="panel-body">

     <table class="table table-hover">
          <tbody>
            @foreach ($TurnosPaciente as $TurnoPaciente)

            @php
              $dt = \App\Http\Controllers\TurnoController::ObtenerObjectoFecha( $TurnoPaciente->FechaTurno  );
              $FechaTurno =  $dt->format('d/m/Y');

              $hora = str_replace("(-","(",$TurnoPaciente->Hora);
              $dt = \App\Http\Controllers\TurnoController::ObtenerObjectoFecha( $hora );
              $HoraTurno =  $dt->format('H:m');
            @endphp

              <tr>
                <td> <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{ $FechaTurno }}
                  <span class="glyphicon glyphicon-time" aria-hidden="true"></span> {{ $HoraTurno }}</td>
                <td><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $TurnoPaciente->Profesional }}</td>
                <td><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $TurnoPaciente->Especialidad }}</td>
                <td><a href="{{ url("nuevoturno/$TurnoPaciente->CodigoCobertura/$TurnoPaciente->CodigoPlan/$TurnoPaciente->CodigoEspecialidad/$TurnoPaciente->CodigoProfesional")}}" class="btn btn-success">Nuevo Turno</a></td>
              </tr>
            @endforeach

          </tbody>
     </table>

    </div>
  </div>  <!-- /medico -->
</div>
</div>
@endsection
