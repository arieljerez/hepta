@extends('app')

@section('content')
<div class="row">
  <div class="panel panel-default panel-info">
      <div class="panel-heading">Datos Personales</div>
      <div class="panel-body">
        <div class="card">
          <img class="card-img-top" width="150rem" src="/avatars/female-silhouette_7.jpg" alt="Card image cap">
          <div class="card-block">
            <h4 class="card-title">{{ $paciente->Nombre, $paciente->Apellido }}</h4>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Historia Clinica: </li>
              <li class="list-group-item">Fecha Nacimiento: {{ $paciente->FechaNacimiento }}</li>
              <li class="list-group-item">DNI: {{ $paciente->Documento }}</li>
              <li class="list-group-item">Correo Electrónico: {{ $paciente->Mail }}</li>
              <li class="list-group-item">Sexo: {{ $paciente->Sexo }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default panel-info">
      <div class="panel-heading">Coberturas</div>
      <div class="panel-body">
        <div class="card">
          @foreach ($coberturas as $cobertura)

            @php
              $i = $cobertura->Cobertura."-".$loop->index;
            @endphp

            <div class="panel-heading" role="tab" id="heading-{{ $i }}">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $i }}" aria-expanded="false" aria-controls="collapse-{{ $i }}">
                  <i class="fa fa-credit-card fa-2x" aria-hidden="true" style="margin-right:3px"></i>
                  {{$cobertura->Cobertura}}  <i class="fa fa-angle-down fa-1x" aria-hidden="true"></i>

                </a>
              </h5>
            </div>

            <div id="collapse-{{ $i }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{ $i }}">
              @component('cobertura_form',
                ['cobertura' => $cobertura ]
              )
              @endcomponent
            </div>

          @endforeach

          </div>
        </div>
      </div>
    </div>
</div>

@endsection
