<div class="panel-body">
  <div class="form-group col-md-6">
    <label class="control-label">{{ __('Cobertura') }}</label>
    <input readonly="true" name="cobertura" maxlength="100" type="text" required="required" class="form-control" placeholder="Cobertura" value="{{ $cobertura->Cobertura }}" />
    <label class="control-label">{{ __('Plan') }}</label>
    <input readonly="true" name="plan" maxlength="100" type="text" required="required" class="form-control" placeholder="Plan" value="{{  $cobertura->Plan }}" />
  </div>
  <div class="form-group col-md-6">
    <label class="control-label">{{ __('Tipo Contratacion') }}</label>
    <input readonly="true" name="type_recruitment" maxlength="100" type="text" required="required" class="form-control" placeholder="Cobertura" value="{{ $cobertura->Contratacion }}"  />
    <label class="control-label">{{ __('Numero Afiliado') }}</label>
    <input readonly="true" name="affiliate_number" maxlength="100" type="number" required="required" class="form-control" placeholder="Número Afiliado" value="{{ $cobertura->Afiliado }}"  />
  </div>
</div>
