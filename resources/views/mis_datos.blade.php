@extends('app')

@section('content')
<div class="row" id="app">

        <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">  <div class="panel panel-default panel-info">
      <div class="panel-heading">Datos Personales</div>
      <div class="panel-body">
        <div class="card">
          @if ($paciente->Sexo == 'F' )
            <img class="card-img-top" width="150rem" src="{{ url('images/female-silhouette_7.jpg') }}">
          @else
            <img class="card-img-top" width="150rem" src="{{ url('images/Man_silhouette.svg.png') }}">
          @endif
          <div class="card-block">
            <h4 class="card-title">{{ $paciente->Nombre, $paciente->Apellido }}</h4>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Historia Clinica: </li>
              <li class="list-group-item">Fecha Nacimiento: <fecha-nacimiento valor="{{ $paciente->FechaNacimiento }}"></fecha-nacimiento></li>
              <li class="list-group-item">DNI: {{ $paciente->Documento }}</li>
              <li class="list-group-item">Correo Electrónico: {{ $paciente->Mail }}</li>
              <li class="list-group-item">Sexo: {{ ($paciente->Sexo == "M") ? "Masculino" : "Femenino" }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Coberturas</div>
      <div class="panel-body">
        <div class="card">
          @foreach ($coberturas as $cobertura)

            @php
              $i = str_replace($cobertura->Cobertura,'.','')."-".$loop->index;
            @endphp

            <div class="panel-heading" role="tab" id="heading-{{ $i }}">
              <h5 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $i }}" aria-expanded="false" aria-controls="collapse-{{ $i }}">
                  <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                  {{$cobertura->Cobertura}}
                  <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
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
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

  <script type="text/javascript">

  Vue.component('fecha-nacimiento', {
    props: ['valor'],
    template: '<span>@{{ valor | fecha_format }}</span>'
  })

  Vue.filter('fecha_format', function (valor) {

    var date = new moment(valor);
    return date.format('DD/MM/YYYY');
  })
  var app = new Vue({
    el: '#app',
    data: {
    }
  })
  </script>
@endsection
