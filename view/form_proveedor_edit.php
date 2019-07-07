<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Proveedor</h3>
      </div>
      <form action="?c=Proveedor&a=Edit" method="post" enctype="multipart/form-data" name="form_proveedor_edit">
        <div class="box-body">
          <input type="hidden" name="id" value="<?php echo $pro->id_proveedor; ?>">
          <div class="mensajes"></div>
          <div class="form-group">
            <label for="txt_razon_social_edit">Razón Social</label>
            <input type="text" class="form-control" name="txt_razon_social_edit" value="<?php echo $pro->razon_social;?>">
          </div>
          <div class="form-group">
            <label for="txt_rut_edit">Rut</label>
            <input type="text" class="form-control" name="txt_rut_edit" value="<?php echo $pro->rut;?>">
          </div>
          <div class="form-group">
            <label for="txt_giro_actividad_edit">Giro o Actividad</label>
            <input type="text" class="form-control" name="txt_giro_actividad_edit" value="<?php echo $pro->giro_actividad;?>">
          </div>
          <div class="form-group">
            <label for="txt_direccion_edit">Dirección</label>
            <input type="text" class="form-control" name="txt_direccion_edit" value="<?php echo $pro->direccion;?>">
          </div>
          <div class="form-group">
            <label for="txt_telefono_edit">Teléfono</label>
            <input type="number" class="form-control" name="txt_telefono_edit" value="<?php echo $pro->telefono;?>">
          </div>
          <div class="form-group">
            <label for="txt_persona_contacto_edit">Persona Contacto</label>
            <input type="text" class="form-control" name="txt_persona_contacto_edit" value="<?php echo $pro->persona_contacto;?>">
          </div>
          <div class="form-group">
            <label for="txt_correo_electronico_edit">Correo Electrónico</label>
            <input type="text" class="form-control" name="txt_correo_electronico_edit" value="<?php echo $pro->correo_electronico;?>">
          </div>
          <div class="form-group">
            <label for="ddl_documento_tributario_edit">Documento Tributario</label>
            <select name="ddl_documento_tributario_edit" class="form-control select2">
              <?php foreach($this->model_doc->List() as $row): ?>
              <?php if($row->id_documento_tributario == $pro->id_documento_tributario): ?>
              <option value="<?php echo $row->id_documento_tributario?>" selected><?php echo $row->nombre?></option>
              <?php else:?>
              <option value="<?php echo $row->id_documento_tributario?>"><?php echo $row->nombre?></option>
              <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="ddl_medio_pago_edit">Medio de Pago</label>
            <select name="ddl_medio_pago_edit" class="form-control select2">
              <?php foreach($this->model_med->List() as $row): ?>
              <?php if($row->id_medio_pago == $pro->id_medio_pago): ?>
              <option value="<?php echo $row->id_medio_pago?>" selected><?php echo $row->nombre?></option>
              <?php else:?>
              <option value="<?php echo $row->id_medio_pago?>"><?php echo $row->nombre?></option>
              <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="txt_cuenta_empresa_edit">Cuenta Empresa</label>
            <input type="number" class="form-control" name="txt_cuenta_empresa_edit" value="<?php echo $pro->cuenta_empresa;?>">
          </div>
          <div class="form-group">
            <label for="ddl_banco_edit">Banco</label>
            <select name="ddl_banco_edit" class="form-control select2">
              <?php foreach($this->model_ban->List() as $row): ?>
              <?php if($row->id_banco == $pro->id_banco): ?>
              <option value="<?php echo $row->id_banco?>" selected><?php echo $row->nombre?></option>
              <?php else:?>
              <option value="<?php echo $row->id_banco?>"><?php echo $row->nombre?></option>
              <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="box-footer">
          <a class="btn btn-danger pull pull-left" href="?c=Proveedor&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_proveedor_edit]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
        </div>
      </form>
    </div>
  </div>
</div>