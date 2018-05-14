<div class="panel panel-info">
  <div class="panel-heading">Fecha</div>
  <div class="panel-body">
    <p>
      Seleccione la fecha estimada.
    </p>
   <label for="Fecha">Primer turno a partir del: </label>
   <input type="date" name="Fecha" class="form-control" :value="hoy()" :min="hoy()" required>
  </div>
</div>
