<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Crear Cuenta Asociada</h3>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<form name="form_cuenta_asoc">
					<div class="form-group">
						<label for="ddl_cuenta_asoc">Cuenta</label>
						<select class="form-control select2" name="ddl_cuenta_asoc">
							<?php foreach ($this->model_cue->List() as $row):?>
							<option value="<?php echo $row->id_cuenta ?>"> <?php echo $row->nro_cuenta." - ".$row->descripcion ?></option>	
							<?php endforeach; ?>
						</select>
					</div>
          			<div class="form-group">
						<label for="ddl_centro_costo_asoc">Centro de Costo</label>
						<select class="form-control select2" name="ddl_centro_costo_asoc">
							<?php foreach ($this->model_cec->List() as $row):?>
							<option value="<?php echo $row->id_centro_costo ?>"> <?php echo $row->ceco." - ".$row->area_carrera ?></option>	
							<?php endforeach; ?>
						</select>
					</div>
				</form>
			</div>
			<div class="box-footer">
			<a class="btn btn-danger pull pull-left" href="?c=Cuenta_asoc&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_cuenta_asoc]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
			</div>
		</div>
	</div>
</div>
