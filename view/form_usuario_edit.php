<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Editar Usuario</h3>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<form name="form_usuario_edit">
					<div class="form-group">
						<label for="txt_nombre_usuario_edit">Nombre</label>
						<input type="text" class="form-control" name="txt_nombre_usuario_edit" value="<?php echo $usu->nombre; ?>">
					</div>
          			<div class="form-group">
						<label for="txt_email_usuario_edit">Email</label>
						<input type="text" class="form-control" name="txt_email_usuario_edit" value="<?php echo $usu->email; ?>">
					</div>
          			<div class="form-group">
						<label for="txt_password_usuario_edit">Password</label>
						<input type="text" class="form-control" name="txt_password_usuario_edit" value="**********">
					</div>
					<div class="form-group">
						<label for="ddl_perfil_usuario_edit">Perfil</label>
						<select class="form-control select2" name="ddl_perfil_usuario_edit">
							<?php foreach($this->model_per->List() as $row): ?>
							<?php if($usu->id_perfil == $row->id_perfil): ?>
							<option value="<?php echo $row->id_perfil ?>" selected><?php echo $row->nombre ?></option>
							<?php else: ?>
							<option value="<?php echo $row->id_perfil ?>"><?php echo $row->nombre ?></option>
							<?php endif ?>
							<?php endforeach?>
						</select>
					</div>
					<div class="form-group">
						<input type="hidden" name="id_usuario" value="<?php echo $usu->id_usuario ?>">
					</div>
				</form>
			</div>
			<div class="box-footer">
			<a class="btn btn-danger pull pull-left" href="?c=Usuario&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_usuario_edit]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
			</div>
		</div>
	</div>
</div>
