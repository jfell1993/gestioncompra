<div class="row">
	<div class="col-md-12">
		<?php if($sol->id_tipo_solicitud == 1): ?>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Solicitud</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="txt_tipo_solicitud_read">Tipo</label>
						<input type="text" class="form-control" name="txt_tipo_solicitud_read" value="<?php echo $tip->nombre ?>" readonly> 
					</div>
					<div class="form-group" id="div_fecha_requerimiento">
						<label for="txt_fecha_requerimiento_read">Fecha de Requerimiento</label>
						<input type="text" class="form-control" name="txt_fecha_requerimiento_read" value="<?php echo $sol->fecha_requerimiento ?>" readonly> 
					</div>
					<div class="form-group" id="div_objetivo">
						<label for="txt_objetivo_read">Objetivo</label>
						<input type="text" class="form-control" name="txt_objetivo_read" value="<?php echo $sol->objetivo ?>" readonly>
					</div>
					<div class="form-group" id="div_usuario_solicitante">
						<label for="txt_usuario_solicitante_read">Nombre del Solicitante</label>
						<input class="form-control" type="text" name="txt_usuario_solicitante_read" value="<?php echo $usu->nombre ?>" readonly>
					</div>
					<div class="form-group" id="div_area_carrera">
						<label for="txt_area_carrera_read">Area o Carrera</label>
						<input class="form-control" type="text" name="txt_area_carrera_read" value="<?php echo $cec->area_carrera ?>" readonly>
					</div>
					<div class="form-group" id="div_centro_costo">
						<label for="txt_centro_costo_read">Centro de Costo</label>
						<input type="text" class="form-control" name="txt_centro_costo_read" value="<?php echo $cec->ceco ?>" readonly>
					</div>
					<div class="form-group" id="div_cuenta">
						<label for="txt_cuenta_read">Cuenta</label>
						<input type="text" class="form-control" name="txt_cuenta_read" value="<?php echo $cue->nro_cuenta ?>" readonly>
					</div>
					<?php if ($sol->oco != 0): ?>
					<div class="form-group" id="div_cuenta">
						<label for="txt_oco">OCO</label>
						<input type="number" class="form-control" name="txt_oco" value="<?php echo $sol->oco ?>" readonly>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Detalle Solicitud</h3>
				</div>
				<div class="box-body">
					<?php if ($sol->observacion != null): ?>
					<div class="form-group" id="div_observacio">
						<div class="col-md-12">
							<label>Observación</label>
							<textarea class="form-control" name="txt_observacion" rows="2" readonly style="resize: none"><?php echo $sol->observacion ?></textarea>
						</div>
					</div>						
					<?php endif; ?>
					<div class="form-group" id="div_table_material_servicio">
						<div class="col-md-12" style="margin-top:20px;">
							<table class="table table-bordered table-striped table-hover" id="table_material_servicio">
							<thead>
								<tr>
									<th>Material</th>
									<th>Código</th>
									<th>Cantidad</th>
									<th>Valor Unitario</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($this->model_det->List($sol->id_solicitud) as $row): ?>
								<tr>
									<td><?php echo $row->material_servicio ?></td>
									<td><?php echo $row->codigo ?></td>
									<td><?php echo $row->cantidad ?></td>
									<td><?php echo $row->valor_unitario ?></td>
								</tr>
							<?php endforeach ?>
							</tbody>
							<tfoot>
							</tfoot>
							</table>
						</div>
					</div>
					<div class="form-group" id="div_table_archivo">
						<div class="col-md-12" style="margin-top:20px;">
							<table class="table table-bordered table-striped table-hover" id="table_archivo">
							<thead>
								<tr>
									<th>Archivos Adjuntos</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php foreach($this->model_arc->List_by($sol->id_solicitud) as $row): ?>
											<a class="btn btn-primary" href="docs/<?php echo $row->archivo ?>" style="margin-top:5px;" download><?php echo $row->archivo ?></a>
										<?php endforeach ?>
									</td>
								</tr>
							</tbody>
							<tfoot>
							</tfoot>
							</table>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a class="btn btn-danger pull pull-left" href="?c=Solicitud&a=Index"><i class="fa fa-arrow-left"></i> Volver</a>
				</div>
			</div>
		<?php endif?>	
		<?php if($sol->id_tipo_solicitud == 2): ?>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Solicitud</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="txt_tipo_solicitud_read">Tipo</label>
						<input type="text" class="form-control" name="txt_tipo_solicitud_read" value="<?php echo $tip->nombre ?>" readonly> 
					</div>
					<div class="form-group" id="div_fecha_requerimiento">
						<label for="txt_fecha_actividad_read">Fecha de Actividad</label>
						<input type="text" class="form-control" name="txt_fecha_actividad_read" value="<?php echo $sol->fecha_actividad ?>" readonly> 
					</div>
					<div class="form-group" id="div_fecha_requerimiento">
						<label for="txt_fecha_requerimiento_read">Fecha de Requerimiento</label>
						<input type="text" class="form-control" name="txt_fecha_requerimiento_read" value="<?php echo $sol->fecha_requerimiento ?>" readonly> 
					</div>
					<div class="form-group" id="div_objetivo">
						<label for="txt_objetivo_read">Objetivo</label>
						<input type="text" class="form-control" name="txt_objetivo_read" value="<?php echo $sol->objetivo ?>" readonly>
					</div>
					<div class="form-group" id="div_objetivo">
						<label for="txt_lugar_actividad_read">Lugar Actividad</label>
						<input type="text" class="form-control" name="txt_lugar_actividad_read" value="<?php echo $sol->lugar_actividad ?>" readonly>
					</div>
					<div class="form-group" id="div_usuario_solicitante">
						<label for="txt_usuario_solicitante_read">Nombre del Solicitante</label>
						<input class="form-control" type="text" name="txt_usuario_solicitante_read" value="<?php echo $usu->nombre ?>" readonly>
					</div>
					<div class="form-group" id="div_area_carrera">
						<label for="txt_area_carrera_read">Area o Carrera</label>
						<input class="form-control" type="text" name="txt_area_carrera_read" value="<?php echo $cec->area_carrera ?>" readonly>
					</div>
					<div class="form-group" id="div_centro_costo">
						<label for="txt_centro_costo_read">Centro de Costo</label>
						<input type="text" class="form-control" name="txt_centro_costo_read" value="<?php echo $cec->ceco ?>" readonly>
					</div>
					<div class="form-group" id="div_cuenta">
						<label for="txt_cuenta_read">Cuenta</label>
						<input type="text" class="form-control" name="txt_cuenta_read" value="<?php echo $cue->nro_cuenta ?>" readonly>
					</div>
					<?php if ($sol->oco != 0): ?>
					<div class="form-group" id="div_cuenta">
						<label for="txt_oco">OCO</label>
						<input type="number" class="form-control" name="txt_oco" value="<?php echo $sol->oco ?>" readonly>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Detalle Solicitud</h3>
				</div>
				<div class="box-body">
					<?php if ($sol->observacion != null): ?>
					<div class="form-group" id="div_observacio">
						<div class="col-md-12">
							<label>Observación</label>
							<textarea class="form-control" name="txt_observacion" rows="2" readonly style="resize: none"><?php echo $sol->observacion ?></textarea>
						</div>
					</div>						
					<?php endif; ?>
					<div class="form-group" id="div_table_material_servicio">
						<div class="col-md-12" style="margin-top:20px;">
							<table class="table table-bordered table-striped table-hover" id="table_material_servicio">
							<thead>
								<tr>
									<th>Material</th>
									<th>Cantidad</th>
									<th>Valor Unitario</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($this->model_det->List($sol->id_solicitud) as $row): ?>
								<tr>
									<td><?php echo $row->material_servicio ?></td>
									<td><?php echo $row->cantidad ?></td>
									<td><?php echo $row->valor_unitario ?></td>
								</tr>
							<?php endforeach ?>
							</tbody>
							<tfoot>
							</tfoot>
							</table>
						</div>
					</div>
					<div class="form-group" id="div_table_archivo">
						<div class="col-md-12" style="margin-top:20px;">
							<table class="table table-bordered table-striped table-hover" id="table_archivo">
							<thead>
								<tr>
									<th>Archivos Adjuntos</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php foreach($this->model_arc->List_by($sol->id_solicitud) as $row): ?>
											<a class="btn btn-primary" href="docs/<?php echo $row->archivo ?>" style="margin-top:5px;" download><?php echo $row->archivo ?></a>
										<?php endforeach ?>
									</td>
								</tr>
							</tbody>
							<tfoot>
							</tfoot>
							</table>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a class="btn btn-danger pull pull-left" href="?c=Solicitud&a=Index"><i class="fa fa-arrow-left"></i> Volver</a>
				</div>
			</div>
		<?php endif?>			
		<?php if($sol->id_tipo_solicitud == 3): ?>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Solicitud</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="txt_tipo_solicitud_read">Tipo</label>
						<input type="text" class="form-control" name="txt_tipo_solicitud_read" value="<?php echo $tip->nombre ?>" readonly> 
					</div>
					<div class="form-group" id="div_fecha_requerimiento">
						<label for="txt_fecha_actividad_read">Fecha de Actividad</label>
						<input type="text" class="form-control" name="txt_fecha_actividad_read" value="<?php echo $sol->fecha_actividad ?>" readonly> 
					</div>
					<div class="form-group" id="div_fecha_requerimiento">
						<label for="txt_fecha_requerimiento_read">Fecha de Requerimiento</label>
						<input type="text" class="form-control" name="txt_fecha_requerimiento_read" value="<?php echo $sol->fecha_requerimiento ?>" readonly> 
					</div>
					<div class="form-group" id="div_objetivo">
						<label for="txt_objetivo_read">Objetivo</label>
						<input type="text" class="form-control" name="txt_objetivo_read" value="<?php echo $sol->objetivo ?>" readonly>
					</div>
					<div class="form-group" id="div_objetivo">
						<label for="txt_cantidad_asistente_read">Cantidad Asistente</label>
						<input type="number" class="form-control" name="txt_cantidad_asistente_read" value="<?php echo $sol->cantidad_asistente ?>" readonly>
					</div>
					<div class="form-group" id="div_objetivo">
						<label for="txt_lugar_actividad_read">Lugar Actividad</label>
						<input type="text" class="form-control" name="txt_lugar_actividad_read" value="<?php echo $sol->lugar_actividad ?>" readonly>
					</div>
					<div class="form-group" id="div_objetivo">
						<label for="txt_hora_salida_sede_read">Hora Salida Sede</label>
						<input type="time" class="form-control" name="txt_hora_salida_sede_read" value="<?php echo $sol->hora_salida_sede ?>" readonly>
					</div>
					<div class="form-group" id="div_objetivo">
						<label for="txt_hora_regreso_sede_read">Hora Regreso Sede</label>
						<input type="time" class="form-control" name="txt_hora_regreso_sede_read" value="<?php echo $sol->hora_regreso_sede ?>" readonly>
					</div>
					<div class="form-group" id="div_usuario_solicitante">
						<label for="txt_usuario_solicitante_read">Nombre del Solicitante</label>
						<input class="form-control" type="text" name="txt_usuario_solicitante_read" value="<?php echo $usu->nombre ?>" readonly>
					</div>
					<div class="form-group" id="div_area_carrera">
						<label for="txt_area_carrera_read">Area o Carrera</label>
						<input class="form-control" type="text" name="txt_area_carrera_read" value="<?php echo $cec->area_carrera ?>" readonly>
					</div>
					<div class="form-group" id="div_centro_costo">
						<label for="txt_centro_costo_read">Centro de Costo</label>
						<input type="text" class="form-control" name="txt_centro_costo_read" value="<?php echo $cec->ceco ?>" readonly>
					</div>
					<div class="form-group" id="div_cuenta">
						<label for="txt_cuenta_read">Cuenta</label>
						<input type="text" class="form-control" name="txt_cuenta_read" value="<?php echo $cue->nro_cuenta ?>" readonly>
					</div>
					<?php if ($sol->oco != 0): ?>
					<div class="form-group" id="div_cuenta">
						<label for="txt_oco">OCO</label>
						<input type="number" class="form-control" name="txt_oco" value="<?php echo $sol->oco ?>" readonly>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Detalle Solicitud</h3>
				</div>
				<div class="box-body">
					<?php if ($sol->observacion != null): ?>
					<div class="form-group" id="div_observacio">
						<div class="col-md-12">
							<label>Observación</label>
							<textarea class="form-control" name="txt_observacion" rows="2" readonly style="resize: none"><?php echo $sol->observacion ?></textarea>
						</div>
					</div>						
					<?php endif; ?>
					<div class="form-group" id="div_table_material_servicio">
						<div class="col-md-12" style="margin-top:20px;">
							<table class="table table-bordered table-striped table-hover" id="table_material_servicio">
							<thead>
								<tr>
									<th>Material</th>
									<th>Cantidad</th>
									<th>Valor Unitario</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($this->model_det->List($sol->id_solicitud) as $row): ?>
								<tr>
									<td><?php echo $row->material_servicio ?></td>
									<td><?php echo $row->cantidad ?></td>
									<td><?php echo $row->valor_unitario ?></td>
								</tr>
							<?php endforeach ?>
							</tbody>
							<tfoot>
							</tfoot>
							</table>
						</div>
					</div>
					<div class="form-group" id="div_table_archivo">
						<div class="col-md-12" style="margin-top:20px;">
							<table class="table table-bordered table-striped table-hover" id="table_archivo">
							<thead>
								<tr>
									<th>Archivos Adjuntos</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php foreach($this->model_arc->List_by($sol->id_solicitud) as $row): ?>
											<a class="btn btn-primary" href="docs/<?php echo $row->archivo ?>" style="margin-top:5px;" download><?php echo $row->archivo ?></a>
										<?php endforeach ?>
									</td>
								</tr>
							</tbody>
							<tfoot>
							</tfoot>
							</table>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a class="btn btn-danger pull pull-left" href="?c=Solicitud&a=Index"><i class="fa fa-arrow-left"></i> Volver</a>
				</div>
			</div>
		<?php endif?>			
	</div>
</div>
