<div class="panel panel-info">
  <div class="panel-heading">Opción de busqueda</div>
  <div class="panel-body">
       Seleccione una opción para buscar:<br />
       <table class="table table-hover">
            <tbody>
                <tr v-for="(opcion, index) in opciones" class="item_check2">
                  <td>
                      <input type="radio" name="opciones" :value="opcion.valor" v-model="Opcion">
                  </td>
                  <td>@{{ opcion.descripcion }}</td>
                </tr>
            </tbody>
       </table>
  </div>
</div>
