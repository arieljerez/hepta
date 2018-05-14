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
