<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Editar Cuenta</h3>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<form name="form_cuenta_edit">
					<div class="form-group">
						<label for="txt_nro_cuenta">Numero Cuenta</label>
						<input type="text" class="form-control" name="txt_nro_cuenta" value="<?php echo $cue->nro_cuenta; ?>">
					</div>
          			<div class="form-group">
						<label for="txt_descripcion">Descripción</label>
						<input type="text" class="form-control" name="txt_descripcion" value="<?php echo $cue->descripcion; ?>">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_cuenta" value="<?php echo $cue->id_cuenta ?>">
					</div>
				</form>
			</div>
			<div class="box-footer">
			<a class="btn btn-danger pull pull-left" href="?c=Cuenta&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_cuenta_edit]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
			</div>
		</div>
	</div>
</div>
