<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Editar Centro de Costo</h3>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<form name="form_centro_costo_edit">
					<div class="form-group">
						<label for="txt_centro_costo">Centro de Costo</label>
						<input type="text" class="form-control" name="txt_centro_costo" value="<?php echo $cec->ceco; ?>">
					</div>
          			<div class="form-group">
						<label for="txt_area_carrera">Area o Carrera</label>
						<input type="text" class="form-control" name="txt_area_carrera" value="<?php echo $cec->area_carrera; ?>">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_centro_costo" value="<?php echo $cec->id_centro_costo ?>">
					</div>
				</form>
			</div>
			<div class="box-footer">
			<a class="btn btn-danger pull pull-left" href="?c=Centro_costo&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_centro_costo_edit]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
			</div>
		</div>
	</div>
</div>
