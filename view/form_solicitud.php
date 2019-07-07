<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Generar Solicitud</h3>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<form name="form_solicitud">
				<div class="form-group">
					<label for="ddl_tipo_solicitud">Tipo</label>
					<select class="form-control select2" name="ddl_tipo_solicitud">
						<option value="1">Producto</option>
						<option value="2">Actividad Dentro de Sede</option>
						<option value="3">Actividad Fuera de Sede</option>
					</select>
				</div>
				<div class="form-group" id="div_fecha_actividad" style="display:none">
                	<label for="txt_fecha_actividad">Fecha de Actividad</label>
					<div class="input-group date">
						<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control pull-right" name="txt_fecha_actividad">
					</div>
              	</div>
				<div class="form-group" id="div_fecha_requerimiento" style="display:none">
                	<label for="txt_fecha_requerimiento">Fecha de Requerimiento</label>
					<div class="input-group date">
					<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
					</div>
					<input type="text" class="form-control pull-right" name="txt_fecha_requerimiento">
					</div>
              	</div>
				<div class="form-group" id="div_objetivo" style="display:none">
					<label for="txt_objetivo" id="lbl_objetivo"></label>
					<textarea class="form-control" rows="1" placeholder="" name="txt_objetivo"></textarea>
				</div>
				<div class="form-group" id="div_cantidad_asistente" style="display:none">
					<label for="txt_cantidad_asistente">Cantidad de Asistentes</label>
					<input type="number" class="form-control" name="txt_cantidad_asistente">
				</div>
				<div class="form-group" id="div_lugar_actividad" style="display:none">
					<label for="txt_lugar_actividad">Lugar de Actividad</label>
					<input type="text" class="form-control" name="txt_lugar_actividad">
				</div>
				<div class="form-group" id="div_hora_salida_sede" style="display:none">
					<label for="txt_hora_salida_sede">Hora Salida Sede</label>
					<input type="time" class="form-control" name="txt_hora_salida_sede">
				</div>
				<div class="form-group" id="div_hora_regreso_sede" style="display:none">
					<label for="txt_hora_regreso_sede">Hora Regreso Sede</label>
					<input type="time" class="form-control" name="txt_hora_regreso_sede">
				</div>
				<div class="form-group" id="div_usuario_solicitante" style="display:none">
					<label for="ddl_usuario_solicitante">Nombre del Solicitante</label>
					<select class="form-control select2" name="ddl_usuario_solicitante">
						<?php foreach($this->model_usu->List() as $row): ?>
						<?php if($row->nombre == $_SESSION['nombre']): ?>
						<option value="<?php echo $row->id_usuario ?>" selected><?php echo $row->nombre ?></option>
						<?php else: ?>
						<option value="<?php echo $row->id_usuario ?>"><?php echo $row->nombre ?></option>
						<?php endif; ?>
						<?php endforeach?>
					</select>
				</div>
				<div class="form-group" id="div_area_carrera" style="display:none">
					<label for="ddl_area_carrera">Area o Carrera</label>
					<select class="form-control select2" name="ddl_area_carrera">
						<?php foreach($this->model_ceco->ListBy($_SESSION['nombre']) as $row): ?>
						<option value="<?php echo $row->centro_costo ?>"><?php echo $row->area_carrera ?></option>
						<?php endforeach?>
					</select>
				</div>
				<div class="form-group" id="div_centro_costo" style="display:none">
					<label for="txt_centro_costo">Centro de Costo</label>
					<input type="text" class="form-control" name="txt_centro_costo">
				</div>
				<div class="form-group" id="div_cuenta" style="display:none">
					<label for="txt_cuenta">Cuenta</label>
					<select class="form-control select2" name="ddl_cuenta">
					</select>
				</div>
				<div class="form-group" id="div_oco" style="display:none">
					<label for="txt_oco">OCO</label>
					<input type="number" class="form-control" name="txt_oco" placeholder="(Opcional)">
				</div>
			</div>
		</div>		

		<div class="box box-default"  id="div_detalle" style="display:none">
			<div class="box-header with-border">
				<h3 class="box-title">Detalle Solicitud</h3>
			</div>
			<div class="box-body">
				<div class="form-group" id="div_file">
					<div class="col-md-12">
						<label for="txt_file">Adjuntar Archivos</label>
						<input type="file" class="form-control" id="file" name="file[]" multiple/>
					</div>
				</div>
				<div id="div_material_servicio">
					<div class="col-md-5">
						<div class="form-group">
							<label for="txt_material_servicio" id="lbl_material" style="display:none">Material</label>
							<label for="txt_material_servicio" id="lbl_servicio" style="display:none">Servicio</label>
							<input type="text" class="form-control" name="txt_material_servicio"/>
							<div id="suggesstion-box"></div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="txt_codigo">Código</label>
							<input type="text" class="form-control" name="txt_codigo">
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group">
							<label for="txt_cantidad">Cantidad</label>
							<input type="number" class="form-control" name="txt_cantidad">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="txt_valor_unitario">Valor Unitario</label>
							<input type="number" class="form-control" name="txt_valor_unitario">
						</div>
					</div>
					<div class="col-md-2">
						<a class="form-control btn btn-success" onclick="add_material_servicio()" name="btn_add_material" style="margin-top:25px;"><i class="fa fa-plus"></i></a>
					</div>
				</div>
				<div class="form-group" id="div_table_material_servicio">
					<div class="col-md-12" style="margin-top:20px;">
						<table class="table table-bordered table-striped table-hover" id="table_material_servicio">
						<thead>
							<tr>
								<th><span id="spn_material">Material</span><span id="spn_servicio">Servicio</span></th>
								<th>Código</th>
								<th>Cantidad</th>
								<th>Valor Unitario</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
						</tfoot>
						</table>
					</div>
				</div>
				</form>
			</div>
			<div class="box-footer">
				<a class="btn btn-danger pull pull-left" href="?c=Solicitud&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_solicitud]').submit();" class="btn btn-success pull pull-right">Enviar <i class="fa fa-paper-plane"></i></a>
			</div>	
		</div>
	</div>	
</div>