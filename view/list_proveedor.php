<div class="row">
  <div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="box-title">
					<h3 class="box-title">Mantenedor Proveedores</h3>
				</div>
				<a class="btn btn-success pull pull-right" href="?c=Proveedor&a=FormAdd">
				<span style="margin-right:5px;">CREAR</span><i class="fa fa-plus-circle"></i></a>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped table-hover" id="dataTable">
					<thead>
						<tr>
							<th>Razon Social</th>
			                <th>Rut</th>
			                <th>Giro o Actividad</th>
							<th>Direccion</th>
							<th>Teléfono</th>
			                <th>Persona Contacto</th>
			                <th>Correo Electrónico</th>
			                <th>Documento Tributario</th>
			                <th>Medio de Pago</th>
			                <th>Cuenta Empresa</th>
			                <th>Banco</th>
			                <th style="width:100px">Acción</th>
						</tr>
					</thead>
					<tbody>
		            <?php foreach($this->model_pro->List() as $row): ?>
		            <tr>
			            <td><?php echo $row->razon_social?></td>
			            <td><?php echo $row->rut?></td>
			            <td><?php echo $row->giro_actividad?></td>
			            <td><?php echo $row->direccion?></td>
			            <td><?php echo $row->telefono?></td>
			            <td><?php echo $row->persona_contacto?></td>
			            <td><?php echo $row->correo_electronico?></td>
			            <td><?php echo $row->documento_tributario?></td>
			            <td><?php echo $row->medio_pago?></td>
			            <td><?php echo $row->cuenta_empresa?></td>
			            <td><?php echo $row->banco?></td>
		          	    <td align="center"><a class="btn btn-primary" href="?c=Proveedor&a=FormEdit&id=<?php echo $row->id_proveedor ?>" style="margin-right:5px;"><i class="glyphicon glyphicon-edit"></i></a> <a class="btn btn-danger" href="?c=Proveedor&a=Delete&id=<?php echo $row->id_proveedor ?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
