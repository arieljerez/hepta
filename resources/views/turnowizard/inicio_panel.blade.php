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
