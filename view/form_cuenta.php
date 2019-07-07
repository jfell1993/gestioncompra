<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Crear Cuenta</h3>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<form name="form_cuenta">
					<div class="form-group">
						<label for="txt_nro_cuenta">Numero Cuenta</label>
						<input type="text" class="form-control" name="txt_nro_cuenta" placeholder="Numero Cuenta">
					</div>
          			<div class="form-group">
						<label for="txt_descripcion">Descripción</label>
						<input type="text" class="form-control" name="txt_descripcion" placeholder="Descripción">
					</div>
				</form>
			</div>
			<div class="box-footer">
			<a class="btn btn-danger pull pull-left" href="?c=Cuenta&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_cuenta]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
			</div>
		</div>
	</div>
</div>
