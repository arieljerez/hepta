<div class="panel panel-info">
  <div class="panel-heading">Turnos Disponibles @{{ TurnosDisponibles }}</div>
  <div class="panel-body">
    <div class="tableFixHead">
       <table class="table table-hover">
          <tbody>
              <tr v-for="(turno, index) in turnos" class="item_check2">
                <td>
                <input type="radio" id="CodigoTurno"  :value="turno" v-model="NuevoTurno">
                @{{ turno.Dia }}  @{{ turno.Fecha| date_format }} - @{{ turno.Profesional }} - @{{ turno.Especialidad }} </td>
              </tr>
          </tbody>
       </table>
  </div>
  </div>
</div>
