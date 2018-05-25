@extends('app')

@section('content')

<div class="row" id="app">
      <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
        <div class="panel panel-default panel-info">
          <div class="panel-heading">Turnos</div>
          <div class="panel-body">
          </div>

          <ul class="list-group">
            @foreach ($turnos as $turno)
            <li class="list-group-item">
              <fecha-turno title="{{   $turno->FechaTurno  }}"></fecha-turno>
              <hora-turno title="{{   $turno->FechaTurno  }}"></hora-turno>
              <profesional-tag title="{{ $turno->Profesional }}"></profesional-tag>
              <especialidad-tag title="{{ $turno->Especialidad }}"></especialidad-tag>
              <turno-estado-tag estado="{{ $turno->Estado }}"></turno-estado-tag>
              @if ($turno->Estado == 'FUTURO')
                <button class ="btn btn-danger   pull-right" type="submit" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i> Cancelar Turno  </button>
              @endif
              </li>
            @endforeach
          </ul>
        </div>
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

  Vue.component('profesional-tag', {
    props: ['title'],
    template: '<div><span class="glyphicon glyphicon-user" aria-hidden="true"></span> @{{ title }}</div>'
  })

  Vue.component('especialidad-tag', {
    props: ['title'],
    template: '<div><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> @{{ title }}</div>'
  })

  Vue.component('turno-estado-tag', {
    props: ['estado'],
    template: '<span :class="obtenerLabel(estado)">@{{ estado }}</span>',
    methods:{
      obtenerLabel: function (estado){
        if(estado == "AUSENTE") return " label label-danger";
        if(estado == "PRESENTE") return " label label-success";
        if(estado == "FUTURO") return " label label-warning";
      }
    }
  })



  Vue.filter('fecha_format', function (value) {

    var date = new moment(value);
    return date.format('DD/MM/YYYY');
  })

    Vue.filter('hora_format', function (value) {

      var date = new moment(value);
      return date.format('HH:mm');
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
