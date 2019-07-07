<div class="row">
  <div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="col-md-12">
					<div class="message"></div>
					<h3 class="box-title">Presupuesto</h3>
				</div>
			</div>
			<div class="box-body">
				<form method="post" enctype="multipart/form-data" name="form_upload_presupuesto" class="col-md-12">
					<input class="btn-presupuesto pull pull-left" type="file" name="btn_presupuesto" value="Cargar Presupuesto" style="margin-bottom:10px;">
					<button type="submit" class="btn btn-primary pull pull-right" style="margin-bottom:10px"><span style="margin-right:5px;">CARGAR PRESUPUESTO</span><i class="fa fa-upload"></i></button>
				</form>		
				<div class="col-md-12 table-responsive"  style="margin-top:10px">	
					<table class="table table-bordered table-striped table-hover" id="dataTable">
						<thead>
							<tr>
								<th class="all">Sociedad</th>
						        <th class="all">Division</th>
						        <th class="all">Centro de costo</th>
						        <th class="all">Cuenta de Mayor</th>
						        <th class="none">Actividad</th>
						        <th class="none">Detalle</th>
						        <th class="all">Enero</th>
						        <th class="all">Febrero</th>
						        <th class="all">Marzo</th>
						        <th class="all">Abril</th>
						        <th class="all">Mayo</th>
						        <th class="all">Junio</th>
						        <th class="none">Julio</th>
						        <th class="none">Agosto</th>
						        <th class="none">Septiembre</th>
						        <th class="none">Octubre</th>
						        <th class="none">Noviembre</th>
						        <th class="none">Diciembre</th>
								<th class="all">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($this->model_pre->List() as $row):?>
							<tr>
								<td><?php echo $row->sociedad ?></td>
								<td><?php echo $row->division ?></td>
								<td><?php echo $row->centro_costo ?></td>
								<td><?php echo $row->cuenta_mayor ?></td>
								<td><?php echo $row->actividad ?></td>
								<td><?php echo $row->detalle ?></td>
								<td><?php echo $row->enero ?></td>
								<td><?php echo $row->febrero ?></td>
								<td><?php echo $row->marzo ?></td>
								<td><?php echo $row->abril ?></td>
								<td><?php echo $row->mayo ?></td>
								<td><?php echo $row->junio ?></td>
								<td><?php echo $row->julio ?></td>
								<td><?php echo $row->agosto ?></td>
								<td><?php echo $row->septiembre ?></td>
								<td><?php echo $row->octubre ?></td>
								<td><?php echo $row->noviembre ?></td>
								<td><?php echo $row->diciembre ?></td>
								<td><?php echo $row->total ?></td>
							</tr>
							<?php endforeach ?>
						</tbody>
						<tfoot>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
