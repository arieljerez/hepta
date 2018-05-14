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
