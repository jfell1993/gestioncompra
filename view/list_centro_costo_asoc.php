<div class="row">
  <div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Mantenedor Centros de Costo Asociados</h3>
				<a class="btn btn-success pull pull-right" href="?c=Centro_costo_asoc&a=Form_centro_costo_asoc">
				<span style="margin-right:5px;">CREAR</span><i class="fa fa-plus-circle"></i></a>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<table class="table table-bordered table-striped table-hover" id="table_usuario">
					<thead>
						<tr>
			        <th>Centro Costo - Area o Carrera</th>
			        <th>Nombre Usuario</th>
			        <th style="width:20px;">Acción</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($this->model_cec_asoc->List() as $row): ?>
		            <tr>
			            <td><?php echo $row->centro_costo." - ".$row->area_carrera ?></td>
			            <td><?php echo $row->nombre_usuario ?></td>
			            <td align="center">
			            	<a class="btn btn-danger" data-toggle="modal" data-target="#removeModal" onclick="delete_centro_costo_asoc(<?php echo $row->id_usuario_ceco ?>)">
			            		<i class="glyphicon glyphicon-trash"></i>
			            	</a>
			            </td>
		            </tr>
		     		<?php endforeach; ?>
					</tbody>
					<tfoot>
					</tfoot>
				</table>
			</div>
			<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"></span>Eliminar</h4>
						</div>
						<div class="modal-body">
							<p>Eliminar Centro de Costo Asociado?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull pull-left" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" id="removeBtn">Guardar Cambios</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
