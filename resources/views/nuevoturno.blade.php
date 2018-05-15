@extends('app')
@section('css')
  <style>
  .tableFixHead { overflow-y: auto; height: 240px; }
  table { border-collapse: collapse; width: 100%; }
  th, td { padding: 8px 16px; }
  th { background:#eee; }
  </style>
@endsection

@section('content')

<div class="row" id="app">
  <div class="col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1">
      <div id="rootwizard">
        <!-- nav -->

        <div class="navbar">
      	  <div class="navbar-inner">
      	    <div class="container-fluid">
            	<ul>
            	  <li><a href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a></li>
            		<li><a href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></a></li>
            		<li><a href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span></a></li>
            		<li><a href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span></a></li>
            		<li><a href="#tab5" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
            		<li><a href="#tab6" data-toggle="tab"><span class="glyphicon glyphicon-scale" aria-hidden="true"></span></a></li>
            		<li><a href="#tab7" data-toggle="tab"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></a></li>
                <li><a href="#tab8" data-toggle="tab"><span class="glyphicon glyphicon-ok" aria-hidden="true"></a></li>
            	</ul>
      	    </div>
      	  </div>
        </div>

        <!-- /nav -->

      	<div id="bar" class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
        </div>

        @include('turnowizard.tab_content')

        <ul class="pager wizard">
          <li class="previous first" style="display:none;"><a href="#">First</a></li>
          <li class="previous"><a href="#">Anterior</a></li>
          <li class="next last" style="display:none;"><a href="#">Last</a></li>
          <li class="next"><a href="#">Siguiente</a></li>
          <li class="finish btn-lg">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tomar Turno</button></li>
        </ul>

    </div>
    <!-- /rootwizard -->
    <pre class="code">
        CodigoEspecialidad  @{{ CodigoEspecialidad }}
        CodigoCobertura  @{{ CodigoCobertura }}
        CodigoPlan  @{{ CodigoPlan }}
        CodigoProfesional  @{{ CodigoProfesional }}
        CodigosEstudios @{{ CodigosEstudios }}
        Opcion @{{ Opcion }}
        NuevoTurno @{{ NuevoTurno }}
    </pre>


</div>

<template id="bs-modal">
<!-- modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Confirmacion de Turno</h4>
          </div>
          <div class="modal-body">
            <p>¿Confirma la reseva del turno?</p>

              <p>Profesional: @{{ NuevoTurno.Profesional}}</p>
              <p>Especialidad: @{{ NuevoTurno.Especialidad}}</p>

              <p>Fecha: @{{ NuevoTurno.FechaTurno }}</p>
              <p>Hora: @{{ NuevoTurno.HoraTurno  }}</p>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" @click="grabarTurno(NuevoTurno)">Sí, Confirmo</button>
          </div>
        </div>

      </div>
    </div>
<!-- /modal -->
</template>
</div>  <!-- /row -->


@endsection


@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script type="text/javascript">

    Vue.component('modal', {
        template: '#bs-modal',
        data: function () {
            console.log("### DATA");
        },
    });

    Vue.filter('date_format', function (value) {

      var date = new moment(parseInt(value.substr(6)));
      return date.format('DD/MM/YYYY hh:mm');
    })

    Vue.filter('fecha_format', function (value) {

      var date = new moment(parseInt(value.substr(6)));
      return date.format('DD/MM/YYYY');
    })

    Vue.filter('hora_format', function (value) {

      var date = new moment(parseInt(value.substr(6)));
      return date.format('hh:mm');
    })

    var ws = "http://appturnos.markey.com.ar/hepta/";
    var vm =  new Vue({
      el: "#app",
      data: {
        coberturas: [],
        especialidades:[],
        medicos: [],
        paciente: [],
        estudios:[],
        ajax_data: [],
        CodigoEspecialidad: '{{ $CodigoEspecialidad }}',
        CodigoCobertura: '{{ $CodigoCobertura }}',
        CodigoPlan: '{{ $CodigoPlan }}',
        CodigoProfesional: '{{ $CodigoProfesional }}',
        CodigoCobertura: '{{ $CodigoCobertura == ''  ? 0 : $CodigoCobertura }}',
        CodigosEstudios: [],
        opciones: [
            {'valor':'Especialidad', 'descripcion': 'Busqueda por Especialidad' },
            {'valor':'Medico', 'descripcion': 'Busqueda por Médico' },
            {'valor':'Estudios', 'descripcion': 'Busqueda por Estudios' },
        ],
        Opcion: '{{ $CodigoEspecialidad <> '' ? 'Medico': '' }}',
        turnos: [],
        CodigoTurno: 0,
        NuevoTurno: [],
    },
      created: function(){
          this.paciente = {!! $paciente !!};
          this.obtenerCoberturas();
          this.obtenerEspecialidades();
          //this.obtenerMedicos();
          this.obtenerEstudios();
   },
   methods:{
     obtenerCoberturas: function(){
       this.$http.get(ws +'Pacientes.svc/ObtenerCoberturasPaciente?CodigoPaciente=' + this.paciente.CodigoPaciente ).then(function(response){
            this.ajax_data = response.body;
            this.coberturas = this.ajax_data.ObtenerCoberturasPacienteResult.CoberturasPaciente;
            }, function(){
               console.log("error al recuperar coberturas")
            });

     },
     obtenerEspecialidades: function(){
       this.$http.get(ws +'Turnos.svc/ObtenerEspecialidades').then(function(response){
          this.ajax_data = response.body;
          this.especialidades = this.ajax_data.ObtenerEspecialidadesResult.Especialidades;
        }, function(){
           console.log("error al recuperar especialidades")
       });
     },
     obtenerMedicos: function(){

       if (!(this.CodigoEspecialidad > 0) ){
         return;
       }

       this.$http.post(ws +'Turnos.svc/ObtenerProfesionales?CodigoEspecialidad='+ this.CodigoEspecialidad +'&CodigoCobertura='+this.CodigoCobertura+'&CodigoPlan='+this.CodigoPlan).then(function(response){
          this.ajax_data = response.body;
          this.medicos = this.ajax_data.ObtenerProfesionalesResult.Profesionales;
        }, function(){
           console.log("error al recuperar medicos")
       });
     },
     obtenerEstudios: function(){
       this.$http.get(ws +'Turnos.svc/ObtenerEstudios').then(function(response){
          this.ajax_data = response.body;
          this.estudios = this.ajax_data.ObtenerEstudiosResult.Estudios;
        }, function(){
           console.log("error al recuperar estudios")
       });
     },
     CodigoCoberturaPlanValue: function(val1,val2){
       return val1 + ' ' + val2;
     },
     grabarTurno: function(NuevoTurno){

       //GrabarTurno?CodigoProfesional={CodigoProfesional}&CodigoServicio={CodigoServicio}&CodigoDiaSemana={CodigoDiaSemana}&CodigoTurno={CodigoTurno}&CodigoPaciente={CodigoPaciente}&FechaTurno={FechaTurno}&CodigoEspecialidad={CodigoEspecialidad}&CodigoSubEspecialidad={CodigoSubEspecialidad}&CodigoCobertura={CodigoCobertura}&CodigoPlan={CodigoPlan}

       //La FechaTurno es string con formato YYYYMMDD HH:MM
       var FechaTurno = new moment(NuevoTurno.FechaTurno);
       FechaTurno =  FechaTurno.format('YYYYMMDD') + ' ' + NuevoTurno.HoraTurno;
       if (this.CodigoProfesional > 0 && this.CodigoEspecialidad > 0){
         var turnos_svc = 'Turnos.svc/GrabarTurno?CodigoProfesional='+ NuevoTurno.CodigoProfesional
                                        + '&CodigoServicio=' + NuevoTurno.CodigoServicio
                                        + '&CodigoEspecialidad=' + NuevoTurno.CodigoEspecialidad
                                        + '&CodigoDiaSemana=' + NuevoTurno.CodigoDiaSemana
                                        + '&CodigoPaciente='+ this.paciente.CodigoPaciente
                                        + '&CodigoTurno=' + NuevoTurno.CodigoTurno
                                        + '&FechaTurno=' + FechaTurno
                                        + '&CodigoSubEspecialidad=' + NuevoTurno.CodigoSubEspecialidad
                                        + '&CodigoCobertura=' + this.CodigoCobertura
                                        + '&CodigoPlan=' + this.CodigoPlan

         this.$http.get(ws + turnos_svc).then(function(response){
            console.log(response.body);
          }, function(){
             console.log("error al grabarTurno")
         });
       }
     },
     hoy: function(){
       //console.log(new Date().toISOString().slice(0,10));
       return new Date().toISOString().slice(0,10);
     },
     CodigoCoberturaPlanValue: function(val1,val2){
       return val1 + ' ' + val2;
     },
     obtenerTurnos: function(){
       FechaDesde = '20180601';
       if (this.CodigoProfesional > 0 && this.CodigoEspecialidad > 0){
         var turnos_svc = 'Turnos.svc/ObtenerTurnosDisponibles?CodigoProfesional='+ this.CodigoProfesional +'&CodigoEspecialidad=' + this.CodigoEspecialidad + '&FechaDesde=' + FechaDesde
         this.$http.get(ws + '/' + turnos_svc).then(function(response){
            this.turnos = response.body.ObtenerTurnosDisponiblesResult.TurnosDisponibles;

            this.turnos.forEach(function(element) {
              var date = new moment(parseInt(element.FechaTurno.substr(6)));
              element.FechaTurno =  date.format('DD/MM/YYYY');
              element.HoraTurno =  date.format('hh:mm');
            });
          }, function(){
             console.log("error al recuperar turnos")
         });
       }
     },

   },
   computed: {
      CodigoCoberturaPlan: {
        // getter
        get: function () {
          return this.CodigoCobertura + ' ' + this.CodigoPlan
        },
        // setter
        set: function (newValue) {
          var names = newValue.split(' ')
          this.CodigoCobertura = names[0]
          this.CodigoPlan = names[names.length - 1]
        }
      },
      TurnosDisponibles: function (){
        return this.turnos.length;
      },

  },
});

    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#rootwizard').bootstrapWizard(
          {
            onNext: function(tab, navigation, index) {
              //console.log(index);
            if (index==2){
              if (!$('input[name="cobertura"]').is(':checked')) {

                    alert('Debe seleccionar una Cobertura');
                      return false;
                  }
            }

            if (index==3){
              if (!$('input[name="opciones"]').is(':checked')) {

                    alert('Debe seleccionar una Opción de busqueda');
                      return false;
                  }
            }
            if (index >=3){

                vm.obtenerMedicos();
            }

            if (index >=4){
                vm.obtenerTurnos();
            }


            if($('input[name=opciones]:radio:checked').val() == "Especialidad" ) {
              $('#rootwizard').bootstrapWizard('display', 3);
              $('#rootwizard').bootstrapWizard('display', 4);
              $('#rootwizard').bootstrapWizard('hide', 5);
            }
            if($('input[name=opciones]:radio:checked').val() == "Medico" ) {
              $('#rootwizard').bootstrapWizard('hide', 3);
              $('#rootwizard').bootstrapWizard('display', 4);
              $('#rootwizard').bootstrapWizard('hide', 5);
            }
            if($('input[name=opciones]:radio:checked').val() == "Estudios" ) {
              $('#rootwizard').bootstrapWizard('hide', 3);
              $('#rootwizard').bootstrapWizard('hide', 4);
              $('#rootwizard').bootstrapWizard('display', 5);
            }

        }, onTabShow: function(tab, navigation, index) {

          var $total = navigation.find('li').length;
          var $current = index+1+2;
          var $percent = ($current/$total) * 100;
          $('#rootwizard .progress-bar').css({width:$percent+'%'});

        }
        , onTabClick: function(tab, navigation, index){
          return false;
        }
        , onInit: function(tab, navigation, index){

          @isset($CodigoCobertura)
            setTimeout(function() {
                  $('#rootwizard').bootstrapWizard('show', 6);
            }, 1);
            vm.obtenerMedicos();
          @endisset

          }
      });
      window.prettyPrint && prettyPrint();

      $('#myModal').on('shown.bs.modal', function () {

      });

      $('#rootwizard .finish').click(function() {
          $('#rootwizard').find("a[href*='tab1']").trigger('click');
      });

    });

    $('.item_check2').click(function() {

      $(this).children('td').children('input').prop('checked', true);
    });

    $('.tableFixHead').on('scroll', function() {
      $('thead', this).css('transform', 'translateY('+ this.scrollTop +'px)');
    });
</script>
@endsection
