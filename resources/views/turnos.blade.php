@extends('app')

@section('content')

<div class="row">
      <div class="col-sm-8 col-sm-offset-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default panel-info">
          <div class="panel-heading">Turnos</div>
          <div class="panel-body">
          </div>

          <ul class="list-group">
            @php
              $x =0;
            @endphp

            @foreach ($turnos as $turno)
            @php
              $dt = \App\Http\Controllers\TurnoController::ObtenerObjectoFecha( $turno->FechaTurno );
              $FechaTurno =  $dt->format('d/m/Y');

              $hora = str_replace("(-","(",$turno->Hora);
              $dt = \App\Http\Controllers\TurnoController::ObtenerObjectoFecha( $hora );
              $HoraTurno =  $dt->format('H:m');
            @endphp

              <li class="list-group-item"> <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{ $FechaTurno }}  <span class="glyphicon glyphicon-time" aria-hidden="true"></span> {{$HoraTurno}}  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{$turno->Especialidad}}   <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{$turno->Profesional}} <span class="label label-{{$turno->Estado == 'PRESENTE' ? 'success': 'danger'  }}">{{ $turno->Estado }}</span> </li>
            @endforeach
          </ul>
        </div>
      </div>
</div>

@endsection
