@extends('app')
@section('content')

<div id="app" class="row">
  <form action="{{ route('login') }}" id="generarForm" method="get" v-on:submit="generar">
      <div class=" col-md-6 col-md-offset-3"  >
        <div class="panel panel-default panel-info">
          <div class="panel-heading">Confirmar Correo Electrónico</div>
          <div class="panel-body">
            <h4>
              @{{ paciente.Sexo = "M" ? "Bienvenido": "Bienvenida" }}  @{{ paciente.Nombre }} @{{ paciente.Apellido }}
            </h4>
            <p class="text-info">
              Al generar la nueva contraseña el sistema enviará un mail a su casilla de correo con los datos correspondientes
            </p>
              <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="form-group has-success">
                      <label class="control-label" for="email">Correo</label>
                      <input type="text" class="form-control input-error" id="email" name="email" v-model="paciente.Mail">
                      <label class="control-label" for="email">Correo Confirmación:</label>
                      <input type="text" class="form-control input-error" id="email_confirmation" name="email_confirmation" v-model="email_confirmation">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <a href="{{ url('/') }}" type="button" name="button" class="btn btn-primary">Cancelar</a>
                  <button type="submit" name="button" class="btn btn-success pull-right">Generar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <input type="hidden" nane="CodigoPaciente" v-model="paciente.CodigoPaciente">
    {{ csrf_field() }}
  </form>
</div>
@endsection
@section('js')
<script type="text/javascript">
var ws = "http://appturnos.markey.com.ar/hepta/";
var vm =  new Vue({
  el: "#app",
  data: {
    paciente: [],
    email_confirmation: "",
    documento: '{{ $documento }}',
    fecha_nacimiento: '{{ $fecha_nacimiento }}',
},
  created: function(){
    this.$http.get(ws + 'Pacientes.svc/VerificarPaciente?Documento=24823959&FechaNacimiento=07/28/1975').then(function(response){
    this.paciente = response.body.VerificarPacienteResult.Pacientes[0];
    document.getElementById("email_confirmation").focus();
  }, function(){
    console.log("error comunicacion vuelva a intentar");
 });
 },
 methods: {
   generar: function(){
     event.preventDefault();

     if (this.email_confirmation != this.paciente.Mail){
       document.getElementById("email_confirmation").focus();
       alert ("Debe confirmar la dirección de correo");
       return false;
     }

     this.$http.get(ws + 'Pacientes.svc/GenerarClavePaciente?CodigoPaciente=' + this.paciente.CodigoPaciente + '&Mail='+ this.paciente.Mail ).then(function(response){

      if (response.body.GenerarClavePacienteResult.Mensaje=="OK"){
        alert ("Se ha enviado la contraseña a su dirección de mail");
        document.getElementById("generarForm").submit();
      };

    }, function(){
      console.log("error comunicacion vuelva a intentar");
    });

   }
 }
});

</script>
@endsection
