<div class="row">
  <div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Bandeja de Solicitudes</h3>
				<a class="btn btn-success pull pull-right" href="?c=Solicitud&a=Form_solicitud">
					<span style="margin-right:5px;">CREAR</span><i class="fa fa-plus-circle"></i>
				</a>
			</div>
			<div class="box-body">
				<div class="message"></div>
				<div class="form-group">
					<label for="ddl_estado">Filtrar Estado</label>
					<form name="form_estado" method="POST" action="?c=Solicitud&a=Set_estado">
						<select class="form-control select2" name="ddl_estado">
							<option value = "0">Todos</option>
							<?php foreach($this->model_est->List() as $row): ?>
							<option value ="<?php echo $row->id_estado ?>"><?php echo $row->nombre ?></option>
							<?php endforeach?>
						</select>
					</form>
				</div>
				<table class="table table-bordered table-striped table-hover" id="table_bandeja">
					<thead>
						<tr>
							<th style="width:50px;">Id</th>
			                <th style="width:250px;">Nombre Solicitante</th>
			                <th style="width:250px;">Responsable</th>
			                <th style="width:120px;">Días Transcurridos</th>
			                <th>Asunto</th>
			                <th style="width:120px;">Estado</th>
							<th style="width:20px;">Acción</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($this->model_sol->List_current_user($_SESSION['estado'], $_SESSION['nombre']) as $row): ?>
		            <tr>
			            <td><?php echo $row->id_solicitud ?></td>
			            <td><?php echo $row->id_usuario ?></td>
			            <td><?php echo $row->id_usuario_responsable ?></td>
			            <td>
                    		<?php
							$date1 = $row->fecha_solicitud;
							$date2 = date('Y-m-d H:i:s');
							$diff = abs(strtotime($date2) - strtotime($date1));
							$years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
							echo $days;
			            	?>
                  		</td>
			            <td><?php echo $row->objetivo ?></td>
			            <td>
			            	<?php
			            	if($row->estado == 'Creada') {
			            		echo '<span class="label label-danger" style="font-size:12px;">'.$row->estado.'</span>';
			            	} else if($row->estado == 'Cerrada') {
			            		echo '<span class="label label-success" style="font-size:12px;">'.$row->estado.'</span>';
			            	} else {
			            		echo '<span class="label label-warning" style="font-size:12px;">'.$row->estado.'</span>';
			            	}?>
			            </td>
						<td align="center"><a class="btn btn-primary" href="?c=Solicitud&a=Form_solicitud_read&id=<?php echo $row->id_solicitud ?>"><i class="glyphicon glyphicon-eye-open"></i></a></td>
		            </tr>
		            <?php endforeach; ?>
		            <?php $_SESSION['estado'] = 'Creada'; ?>
					</tbody>
					<tfoot>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
