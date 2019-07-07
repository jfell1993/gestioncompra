<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Crear Centro de Costo</h3>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<form name="form_centro_costo">
					<div class="form-group">
						<label for="txt_centro_costo">Centro de Costo</label>
						<input type="text" class="form-control" name="txt_centro_costo" placeholder="Centro de Costo">
					</div>
          			<div class="form-group">
						<label for="txt_area_carrera">Area o Carrera</label>
						<input type="text" class="form-control" name="txt_area_carrera" placeholder="Area o Carrera">
					</div>
				</form>
			</div>
			<div class="box-footer">
			<a class="btn btn-danger pull pull-left" href="?c=Centro_costo&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_centro_costo]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
			</div>
		</div>
	</div>
</div>
