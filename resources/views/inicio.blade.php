@extends('app');

@section('content')

<div id="app">

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
                <td>{{ $FechaTurno }}</td>
                <td>{{ $HoraTurno }}</td>
                <td>{{ $TurnoPaciente->Profesional }}</td>
                <td>{{ $TurnoPaciente->Especialidad }}</td>
                <td><a href="nuevoturno" class="btn btn-success">Nuevo Turno</a></td>
              </tr>
            @endforeach

          </tbody>
     </table>

    </div>
  </div>  <!-- /medico -->
</div>
@endsection
