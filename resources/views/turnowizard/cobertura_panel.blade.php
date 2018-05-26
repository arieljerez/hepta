<div class="panel panel-info">
  <div class="panel-heading">Coberturas</div>
  <div class="panel-body">
    Seleccione una Cobertura para solicitar el turno:<br />
    <div v-show="loading" class="loader center-block"></div>
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
