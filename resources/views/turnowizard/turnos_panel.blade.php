<div class="panel panel-info">
  <div class="panel-heading">Turnos Disponibles @{{ TurnosDisponibles }}</div>
  <div class="panel-body">
    <div v-show="loading" class="loader center-block"></div>
    <div class="tableFixHead">
       <table class="table table-hover">
          <tbody>
              <tr v-for="(turno, index) in turnos" class="item_check2">
                <td>

                <input type="radio" id="CodigoTurno"  :value="turno" v-model="NuevoTurno">
                @{{ turno.Dia }}  <fecha-turno :title="turno.FechaTurno"></fecha-turno><hora-turno :title="turno.FechaTurno"></hora-turno>
                 <profesional-tag :title="turno.Profesional"></profesional-tag>
                 <especialidad-tag :title="turno.Especialidad"></especialidad-tag>

              </td>
              </tr>
          </tbody>
       </table>
  </div>
  </div>
</div>
