<div class="row">
  <div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Mantenedor Productos</h3>
				<a class="btn btn-success pull pull-right" href="?c=Producto&a=Form_producto">
					<span style="margin-right:5px;">CREAR</span><i class="fa fa-plus-circle"></i>
				</a>
			</div>
			<div class="box-body">
				<div class="message"></div>
				<table class="table table-bordered table-striped table-hover" id="table_producto">
					<thead>
						<tr>
							<th>Código</th>
			                <th>Nombre</th>
			                <th>Valor Unitario</th>
							<th style="width:100px;">Acción</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($this->model_pro->List() as $row): ?>
		            <tr>
		            	<td><?php echo $row->codigo ?></td>
			            <td><?php echo $row->nombre ?></td>
			            <td><?php echo $row->valor_unitario ?></td>
		          	    <td align="center"><a class="btn btn-primary" href="?c=Producto&a=Form_producto_edit&id=<?php echo $row->id_producto ?>" style="margin-right:5px;"><i class="glyphicon glyphicon-edit"></i></a> <a class="btn btn-danger" href="?c=Producto&a=Delete&id=<?php echo $row->id_producto ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
		            </tr>
		            <?php endforeach; ?>
					</tbody>
					<tfoot>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>