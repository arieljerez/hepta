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

    <div class="tab-content">

      <!-- inicio -->
        <div class="tab-pane" id="tab1">
          <div class="panel panel-info">
            <div class="panel-heading">Asistente</div>
            <div class="panel-body">
    			       <p>@{{ paciente.Sexo == 'M' ?  'Bienvenido': 'Bienvenida'}}</p>
                 <p>@{{ paciente.Nombre}}  @{{paciente.Apellido }}</p>
                 <p>
                   Recuerde que la asignación de turnos finaliza con la visualización de un código generado por el sistema, el mismo podrá ser solicitado por la secretaria del sector correspondiente el día de la consulta.
                 </p>
            </div>
          </div>

        </div>
      <!-- /inicio -->


      <!-- coberturas -->
      <div class="tab-pane" id="tab2">

          <div class="panel panel-info">
            <div class="panel-heading">Coberturas</div>
            <div class="panel-body">
              Seleccione una Cobertura para solicitar el turno:<br />

               <table class="table table-hover">
                <thead>
                  <th>&nbsp;</th>
                  <th>Cobertura</th>
                  <th>Afiliado</th>
                </thead>
                <tbody>
                    <tr v-for="cobertura in coberturas" class="item_check3">
                      <td><input type="radio" id="cobertura" name="cobertura" v-bind:value="CodigoCoberturaPlanValue(cobertura.CodigoCobertura,cobertura.CodigoPlan)" v-model="CodigoCoberturaPlan"></td>
                      <td>@{{ cobertura.Cobertura }}</td>
                      <td>@{{ cobertura.Afiliado }}</td>
                    </tr>
                </tbody>
               </table>

            </div>
          </div>

        </div>
        <!-- /coberturas -->

      <!-- Opciones -->
       <div class="tab-pane" id="tab3">
          <div class="panel panel-info">
            <div class="panel-heading">Opción de busqueda</div>
            <div class="panel-body">
    			       Seleccione una opción para buscar:<br />
                 <table class="table table-hover">
                      <tbody>
                          <tr v-for="(opcion, index) in opciones" class="item_check2">
                            <td>
                                <input type="radio" name="opciones" :value="opcion.valor">
                            </td>
                            <td>@{{ opcion.descripcion }}</td>
                          </tr>
                      </tbody>
                 </table>
            </div>
    	   </div>
       </div>
       <!-- /Opciones -->

<!-- Especialidad -->
  <div class="tab-pane" id="tab4">

    <div class="panel panel-info">
      <div class="panel-heading">Especialidades</div>
      <div class="panel-body">
        <div class="tableFixHead">
           <table class="table table-hover">
            <tbody>
                <tr v-for="(especialidad, index) in especialidades">
                  <td>
                      <input type="radio" name="especialidades" id="especialidades" v-model="CodigoEspecialidad" :value="especialidad.CodigoEspecialidad">
                  </td>
                  <td>@{{ especialidad.Especialidad }}</td>
                </tr>
            </tbody>
           </table>
        </div> <!-- tableFixHead -->
      </div>
    </div>

  </div>
<!-- /Especialidad -->

<!-- Médico -->
<div class="tab-pane" id="tab5">
  <div class="panel panel-info">
    <div class="panel-heading">Médico</div>
    <div class="panel-body">
        <div class="tableFixHead">
          <table class="table table-hover">
               <tbody>
                   <tr v-for="(medico, index) in medicos">
                     <td>
                         <input type="radio" name="medico" :value="medico.CodigoProfesional" v-model="CodigoProfesional" >
                     </td>
                     <td>@{{ medico.Profesional }}</td>

                   </tr>
               </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
<!-- Médico -->

<!-- Estudios -->
<div class="tab-pane" id="tab6">
  <div class="panel panel-info">
    <div class="panel-heading">Estudios</div>
    <div class="panel-body">
      <div class="tableFixHead">
         <table class="table table-hover">
            <tbody>
                <tr v-for="(estudio, index) in estudios" class="item_check2">
                  <td>
                      <input type="checkbox" :id="estudio.CodigoEstudio" :value="estudio.CodigoEstudio" v-model="CodigosEstudios">
                  </td>
                  <td>@{{ estudio.Estudio }}</td>
                </tr>
            </tbody>
         </table>
      </div>
    </div>
  </div>
</div>
<!-- /Estudios -->

<!-- Fecha -->
<div class="tab-pane" id="tab7">
  <div class="panel panel-info">
    <div class="panel-heading">Fecha</div>
    <div class="panel-body">
      <p>
        Seleccione la fecha estimada.
      </p>
     <label for="Fecha">Primer turno a partir del: </label>
     <input type="date" name="Fecha" class="form-control" :value="hoy()" :min="hoy()" required>
    </div>
  </div>
</div>
<!-- /Fecha -->

<!-- Estudios -->
<div class="tab-pane" id="tab8">

  <div class="panel panel-info">
    <div class="panel-heading">Turnos</div>
    <div class="panel-body">
      <div class="tableFixHead">
         <table class="table table-hover">
            <tbody>
                <tr v-for="(turno, index) in turnos" class="item_check2">
                  <td>
                      <input type="radio" id="CodigoTurno" name="CodigoTurno" :value="turno.CodigoTurno" v-model="CodigoTurno">
                  </td>
                  <td>@{{ turno.Fecha }} - @{{ turno.Profesional }} - @{{ turno.Especialidad }} - @{{ turno.Estudio }}</td>
                </tr>
            </tbody>
         </table>
    </div>
    </div>
  </div>

</div>
<!-- /Estudios -->

</div>
<!-- /tab content -->

    <ul class="pager wizard">
      <li class="previous first" style="display:none;"><a href="#">First</a></li>
      <li class="previous"><a href="#">Anterior</a></li>
      <li class="next last" style="display:none;"><a href="#">Last</a></li>
      <li class="next"><a href="#">Siguiente</a></li>
      <li class="finish btn-lg"><a href="javascript:;" data-toggle="modal" data-target="#myModal">Tomar Turno</a></li>
    </ul>

</div>
<!-- /rootwizard -->
<pre class="code">
    CodigoEspecialidad  @{{ CodigoEspecialidad }}
    CodigoCobertura  @{{ CodigoCobertura }}
    CodigoPlan  @{{ CodigoPlan }}
    CodigoProfesional  @{{ CodigoProfesional }}
    CodigosEstudios @{{ CodigosEstudios }}
</pre>
</div>

</div>  <!-- /row -->

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
            LEGARRE, JUAN CARLOS - ECOGRAFIA ABDOMEN - Miércoles 28/03/2018 10:50
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" >Sí, Confirmo</button>
          </div>
        </div>

      </div>
    </div>
<!-- /modal -->
@endsection


@section('js')
    <script type="text/javascript">
    var ws = "http://appturnos.markey.com.ar/hepta/";
    var vm =  new Vue({
      el: "#app",
      data: {
        coberturas: [],
        especialidades:[],
        medicos: [],
        paciente: [
          {'Apellido':'LANDA','CodigoPaciente':'188780','Nombre':'DIEGO GERMAN','Sexo':'M'},
        ],
        estudios:[],
        ajax_data: [],
        CodigoEspecialidad: 0,
        CodigoCobertura:1,
        CodigoPlan:1,
        CodigoProfesional:0,
        CodigosEstudios: [],
        opciones: [
            {'valor':'Especialidad', 'descripcion': 'Busqueda por Especialidad' },
            {'valor':'Medico', 'descripcion': 'Busqueda por Médico' },
            {'valor':'Estudios', 'descripcion': 'Busqueda por Estudios' },
        ],
        turnos: [
          {'CodigoTurno': 1 ,'Profesional' :'aaaaaa -1', 'Especialidad': 'sdasdsad', 'Estudio':'eeeee', 'Fecha': '21/03/2018'},
          {'CodigoTurno': 2 ,'Profesional' :'aaaaaa -2', 'Especialidad': 'sdasdsad', 'Estudio':'eeeee', 'Fecha': '21/03/2018'},
          {'CodigoTurno': 3 ,'Profesional' :'aaaaaa -3', 'Especialidad': 'sdasdsad', 'Estudio':'eeeee', 'Fecha': '21/03/2018'},
          {'CodigoTurno': 4 ,'Profesional' :'aaaaaa -4', 'Especialidad': 'sdasdsad', 'Estudio':'eeeee', 'Fecha': '21/03/2018'},

        ],
        CodigoTurno: 0,
    },
      created: function(){
        console.log(this.paciente.Apellido); 
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
       this.$http.get(ws +'Turnos.svc/ObtenerProfesionales?CodigoEspecialidad='+ this.CodigoEspecialidad +'&CodigoCobertura='+this.CodigoCobertura+'&CodigoPlan='+this.CodigoPlan).then(function(response){
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
     hoy: function(){
       //console.log(new Date().toISOString().slice(0,10));
       return new Date().toISOString().slice(0,10);
     },
     CodigoCoberturaPlanValue: function(val1,val2){
       return val1 + ' ' + val2;
     },
     ObtenerTurnos(){

     }
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
      }
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

          //console.log(index);
          //console.log(navigation.find('li').find('style').length);
          var $total = navigation.find('li').length;
          var $current = index+1+2;
          var $percent = ($current/$total) * 100;
          $('#rootwizard .progress-bar').css({width:$percent+'%'});

        }
        , onTabClick(tab, navigation, index){
          return false;
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
      console.log('item_check2');
      $(this).children('td').children('input').prop('checked', true);
    });

    $('.tableFixHead').on('scroll', function() {
      $('thead', this).css('transform', 'translateY('+ this.scrollTop +'px)');
    });
</script>
@endsection
