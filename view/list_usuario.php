<div class="row">
  <div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Mantenedor Usuarios</h3>
				<a class="btn btn-success pull pull-right" href="?c=Usuario&a=Form_usuario">
				<span style="margin-right:5px;">CREAR</span><i class="fa fa-plus-circle"></i></a>
			</div>
			<div class="box-body">
				<div class="mensajes"></div>
				<table class="table table-bordered table-striped dataTable" id="table_usuario">
					<thead>
						<tr>
			        <th>Nombre Usuario</th>
			        <th>Email</th>
			        <th>Perfil</th>
			        <th style="width:100px;">Acción</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($this->model_usu->List() as $row): ?>
		            <tr>
			            <td><?php echo $row->nombre ?></td>
			            <td><?php echo $row->email ?></td>
			            <td><?php echo $row->perfil ?></td>
			            <td align="center">
			            	<a class="btn btn-primary" href="?c=Usuario&a=Form_usuario_edit&id=<?php echo $row->id_usuario ?>" style="margin-right:5px;">
			            		<i class="glyphicon glyphicon-edit"></i>
			            	</a>
			            	<a class="btn btn-danger" data-toggle="modal" data-target="#removeModal" onclick="delete_usuario(<?php echo $row->id_usuario ?>)">
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
							<p>Eliminar Usuario?</p>
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
