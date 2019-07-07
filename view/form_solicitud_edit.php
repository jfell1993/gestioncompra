<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Editar Solicitud</h3>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<form name="form_solicitud_edit">
					<div class="form-group">
						<label for="ddl_estado_edit">Estado</label>
						<select class="form-control select2" name="ddl_estado_edit">
							<?php foreach($this->model_est->List() as $row): ?>
							<?php if($row->id_estado == $sol->id_estado): ?>
							<option value="<?php echo $row->id_estado ?>" selected><?php echo $row->nombre ?></option>
							<?php else: ?>
							<option value="<?php echo $row->id_estado ?>"><?php echo $row->nombre ?></option>
							<?php endif; ?>
							<?php endforeach?>
						</select>
					</div>
					<div class="form-group">
						<label for="ddl_responsable_edit">Responsable</label>
						<select class="form-control select2" name="ddl_responsable_edit">
							<?php foreach($this->model_usu->List() as $row): ?>
							<?php if($row->id_usuario == $sol->id_usuario_responsable): ?>
							<option value="<?php echo $row->id_usuario ?>" selected><?php echo $row->nombre ?></option>
							<?php else: ?>
							<option value="<?php echo $row->id_usuario ?>"><?php echo $row->nombre ?></option>
							<?php endif; ?>
							<?php endforeach?>
						</select>
					</div>
					<div class="form-group" id="div_archivos" style="display:none">
						<label for="txt_file">Adjuntar Archivos</label>
						<input type="file" class="form-control" id="file" name="file[]" multiple/>
					</div>
					<div class="form-group" id="div_observacion"> 
						<label for="txt_observacion">Observación</label>
						<textarea class="form-control" name="txt_observacion" placeholder="Observación" rows="2" style="resize: none"><?php if($sol->observacion != null){ echo $sol->observacion; }?></textarea>
					</div>
					<div class="form-group">
						<input type="hidden" name="id_solicitud" value="<?php echo $sol->id_solicitud ?>">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_cuenta" value="<?php echo $sol->id_cuenta ?>">
					</div>
				</form>
			</div>
			<div class="box-footer">
			<a class="btn btn-danger pull pull-left" href="?c=Solicitud&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_solicitud_edit]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
			</div>
		</div>
	</div>
</div>
