@extends('app')

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
            <button type="button" class="btn btn-primary">Tomar Turno</button></li>
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
        FechaTurno  @{{ FechaTurno }}
        loading @{{ loading }}
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

              <p>Fecha: <fecha-turno :title="NuevoTurno.FechaTurno"></fecha-turno></p>
              <p>Hora: <hora-turno :title=" NuevoTurno.FechaTurno"></hora-turno></p>

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

<div id="mensaje" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>

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

    Vue.component('fecha-turno', {
      props: ['title'],
      template: '<span><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> @{{ title | fecha_format }}</span>'
    })

    Vue.component('hora-turno', {
      props: ['title'],
      template: '<span><span class="glyphicon glyphicon-time" aria-hidden="true"></span> @{{ title | hora_format }}</span>'
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
    Vue.filter('date_format', function (value) {

      var date = new moment(value);
      return date.format('DD/MM/YYYY hh:mm');
    })

    Vue.filter('fecha_format', function (value) {

      var date = new moment(value);
      return date.format('DD/MM/YYYY');
    })

    Vue.filter('hora_format', function (value) {

      var date = new moment(value);
      return date.format('HH:mm');
    })

    var ws = '{{ env("WS_BASE_URI")  ."/". env("WS_RESOURCE")."/" }}';

    var vm =  new Vue({
      el: "#app",
      data: {
        coberturas: [],
        especialidades:[],
        medicos: [],
        paciente: [],
        estudios:[],
        ajax_data: [],
        CodigoEspecialidad: '{{ $CodigoEspecialidad == '' ? 0 : $CodigoEspecialidad}}',
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
        Opcion: '{{ $CodigoEspecialidad <> '' ? 'Especialidad': '' }}',
        turnos: [],
        CodigoTurno: 0,
        NuevoTurno: [],
        FechaTurno: '',
        loading: false
    },
      created: function(){
          this.paciente = {!! $paciente !!};
          this.FechaTurno = this.hoy();
   },
   methods:{
     obtenerCoberturas: function(){
       this.loading = true;
       this.$http.get(ws +'Pacientes.svc/ObtenerCoberturasPaciente?CodigoPaciente=' + this.paciente.CodigoPaciente ).then(function(response){
            this.ajax_data = response.body;
            this.coberturas = this.ajax_data.ObtenerCoberturasPacienteResult.CoberturasPaciente;
            this.loading = false;
            }, function(){
               console.log("error al recuperar coberturas")
            });

     },
     obtenerEspecialidades: function(){
       this.loading = true;
       this.$http.get(ws +'Turnos.svc/ObtenerEspecialidades').then(function(response){
          this.ajax_data = response.body;
          this.especialidades = this.ajax_data.ObtenerEspecialidadesResult.Especialidades;
       this.loading = false;
        }, function(){
           console.log("error al recuperar especialidades")
       });
     },
     obtenerMedicos: function(){

       this.loading = true;
       this.$http.post(ws +'Turnos.svc/ObtenerProfesionales?CodigoEspecialidad='+ this.CodigoEspecialidad +'&CodigoCobertura='+this.CodigoCobertura+'&CodigoPlan='+this.CodigoPlan).then(function(response){
          this.medicos = response.body.ObtenerProfesionalesResult.Profesionales;
          this.loading = false;
        }, function(){
           console.log("error al recuperar medicos")
       });
     },
     obtenerEstudios: function(){
       this.loading = true;
       this.$http.get(ws +'Turnos.svc/ObtenerEstudios').then(function(response){
          this.estudios = response.body.ObtenerEstudiosResult.Estudios;
       this.loading = false;
        }, function(){
           console.log("error al recuperar estudios")
       });
     },
     CodigoCoberturaPlanValue: function(val1,val2){
       return val1 + ' ' + val2;
     },
     grabarTurno: function(NuevoTurno){
       var FechaTurno = new moment(NuevoTurno.FechaTurno);
       FechaTurno =  FechaTurno.format('YYYYMMDD HH:mm')

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
            alert(response.body.GrabarTurnoResult.Mensaje);
            if (response.body.GrabarTurnoResult.CodigoRespuesta == 0){
              window.location = "{!! env('APP_URL') !!}/inicio";
            }
          }, function(){
             console.log("error al grabarTurno")
         });
       }
     },
     hoy: function(){
       //console.log(new Date().toISOString().slice(0,10));
       return new moment().format('YYYY-MM-DD');
     },
     CodigoCoberturaPlanValue: function(val1,val2){
       return val1 + ' ' + val2;
     },
     obtenerTurnos: function(){

       if (this.CodigoProfesional > 0 && this.FechaTurno != "" ){

        this.loading = true;
        FechaDesde = new moment(this.FechaTurno).format('YYYYMMDD');
         var turnos_svc = 'Turnos.svc/ObtenerTurnosDisponibles?CodigoProfesional='+ this.CodigoProfesional +'&CodigoEspecialidad=' + this.CodigoEspecialidad + '&FechaDesde=' + FechaDesde

         this.$http.get(ws + '/' + turnos_svc).then(function(response){
         this.turnos = response.body.ObtenerTurnosDisponiblesResult.TurnosDisponibles;

         this.loading = false;
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
        if(this.turnos == null) {
          return 0;
        }
        return this.turnos.length;
      },

  },
});

    </script>
    <script type="text/javascript">
    $(document).ready(function() {

      $(":radio").change(function ()
      {
         if($('input[name=opciones]:radio:checked').val() == "Especialidad") {
              $('#rootwizard').bootstrapWizard('enable', 3);
              $('#rootwizard').bootstrapWizard('enable', 4);
              $('#rootwizard').bootstrapWizard('disable', 5);
          }

          if($('input[name=opciones]:radio:checked').val() == "Medico" ) {
              $('#rootwizard').bootstrapWizard('disable', 3);
              $('#rootwizard').bootstrapWizard('enable', 4);
              $('#rootwizard').bootstrapWizard('disable', 5);
          }

          if($('input[name=opciones]:radio:checked').val() == "Estudios" ) {
              $('#rootwizard').bootstrapWizard('disable', 3);
              $('#rootwizard').bootstrapWizard('disable', 4);
              $('#rootwizard').bootstrapWizard('enable', 5);
          }

     });
        $('#rootwizard').bootstrapWizard(
          {
            onNext: function(tab, navigation, index) {

              /*
              1 - cobertura
              2- opciones
              3- especialidad
              4- profesional
              5- Estudios
              6- fecha
              7- turnos
              */


            // TAB OPCIONES Especialidad, Medico, Estudios
            if (index == 2){
              if (!$('input[name="cobertura"]').is(':checked')) {
                    alert('Debe seleccionar una Cobertura'); // TODO: Cambiar a Modal
                    return false;
              }
            }

            if (index == 3){
              if (!$('input[name="opciones"]').is(':checked')) {
                  alert('Debe seleccionar una Opción de busqueda'); // TODO: Cambiar a Modal
                  return false;
              }
            }

            if (index == 6){
              if($('input[name=opciones]:radio:checked').val() == "Estudios" ) {
                if (vm.CodigosEstudios.length == 0){
                  alert('Debe seleccionar al menos un estudio');
                  return false;
                }
              }
            }

            if (index == 7){
                if ($('input[name="Fecha"]').val() == "") {
                      alert('Debe seleccionar una Fecha');
                      return false;
                }
            }

        }, onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard .progress-bar').css({width:$percent+'%'});

            if (index == 1 ){
                setTimeout(function() {
                  vm.obtenerCoberturas();
                }, 1);
            }

            if (index == 3){
                setTimeout(function() {
                    vm.obtenerEspecialidades();
                }, 1);
            }

            if (index == 4){
                setTimeout(function() {
                    vm.obtenerMedicos();
                }, 1);
            }

            if (index == 5){
                setTimeout(function() {
                    vm.obtenerEstudios();
                }, 1);
            }

            if(index == 7){
                setTimeout(function() {
                    vm.obtenerTurnos();
                }, 1);
            }
        }
        , onTabClick: function(tab, navigation, index){
          //return false;
        }
        , onInit: function(tab, navigation, index){

          @isset($CodigoCobertura)
            setTimeout(function() {
                  $('#rootwizard').bootstrapWizard('enable', 3);
                  $('#rootwizard').bootstrapWizard('enable', 4);
                  $('#rootwizard').bootstrapWizard('disable', 5);

                  $('#rootwizard').bootstrapWizard('show', 6);
            }, 1);
            vm.obtenerMedicos();
          @endisset

          }
      });
      window.prettyPrint && prettyPrint();

      $('#rootwizard .finish').click(function() {
        //  $('#rootwizard').find("a[href*='tab1']").trigger('click');
        //
           $('#myModal').modal(true);


      });

    });

    $('#myModal').on('hidden.bs.modal', function (e) {
        $('#mensaje').modal(true);
    })

    $('.item_check').click(function(event) {
      var tr = $(event.target).parent();
      $(tr).children('td').children('input').trigger('click').prop('checked', true);
    });

    $('.tableFixHead').on('scroll', function() {
      $('thead', this).css('transform', 'translateY('+ this.scrollTop +'px)');
    });
</script>
@endsection
