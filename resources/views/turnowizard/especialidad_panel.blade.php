<div class="panel panel-info">
  <div class="panel-heading">Especialidades</div>
  <div class="panel-body">
    <div v-show="loading" class="loader center-block"></div>
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
