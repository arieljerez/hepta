<div class="panel panel-info">
  <div class="panel-heading">Médico</div>
  <div class="panel-body">
    <div v-show="loading" class="loader center-block"></div>
      <div class="tableFixHead">
        <table class="table table-hover">
             <tbody>
                 <tr v-for="(medico, index) in medicos">
                   <td>
                       <input type="radio" name="medico" :value="medico.CodigoProfesional" v-model="CodigoProfesional" >
                   </td>
                   <td>@{{ medico.Profesional }} <fecha-turno :title="medico.PrimerTurno"></fecha-turno> </td>

                 </tr>
             </tbody>
        </table>
      </div>
  </div>
</div>
