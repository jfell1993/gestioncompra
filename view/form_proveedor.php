<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Agregar Proveedor</h3>
      </div>
      <form name="form_proveedor">
        <div class="box-body">
          <div class="mensajes"></div>
          <div class="form-group">
            <label for="txt_razon_social">Razón Social</label>
            <input type="text" class="form-control" name="txt_razon_social" placeholder="Razón Social" maxlength="45">
          </div>
          <div class="form-group">
            <label for="txt_rut">Rut</label>
            <input type="text" class="form-control" name="txt_rut" placeholder="19856458k" pattern="[0-9]{7,8}-[0-9Kk]{1}">
          </div>
          <div class="form-group">
            <label for="txt_giro_actividad">Giro o Actividad</label>
            <input type="text" class="form-control" name="txt_giro_actividad" placeholder="Giro o Actividad" maxlength="45">
          </div>
          <div class="form-group">
            <label for="txt_direccion">Dirección</label>
            <input type="text" class="form-control" name="txt_direccion" placeholder="Ciudad, Calle 100" maxlength="100">
          </div>
          <div class="form-group">
            <label for="txt_telefono">Teléfono</label>
            <input type="number" class="form-control" name="txt_telefono" placeholder="990909090" pattern="[0-9]{9}">
          </div>
          <div class="form-group">
            <label for="txt_persona_contacto">Persona Contacto</label>
            <input type="text" class="form-control" name="txt_persona_contacto" placeholder="Persona Contacto" maxlength="45">
          </div>
          <div class="form-group">
            <label for="txt_correo_electronico">Correo Electrónico</label>
            <input type="text" class="form-control" name="txt_correo_electronico" placeholder="Ejemplo@ejemplo.cl" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
          </div>
          <div class="form-group">
            <label for="ddl_documento_tributario">Documento Tributario</label>
            <select name="ddl_documento_tributario" class="form-control select2">
                <?php foreach($this->model_doc->List() as $row): ?>
                <option value="<?php echo $row->id_documento_tributario?>"><?php echo $row->nombre?></option>
                <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="ddl_medio_pago">Medio de Pago</label>
            <select name="ddl_medio_pago" class="form-control select2">
                <?php foreach($this->model_med->List() as $row): ?>
                <option value="<?php echo $row->id_medio_pago?>"><?php echo $row->nombre?></option>
                <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="txt_cuenta_empresa">Cuenta Empresa</label>
            <input type="number" class="form-control" name="txt_cuenta_empresa" placeholder="00322366308">
          </div>
          <div class="form-group">
            <label for="ddl_banco">Banco</label>
            <select name="ddl_banco" class="form-control select2">
                <?php foreach($this->model_ban->List() as $row): ?>
                <option value="<?php echo $row->id_banco?>"><?php echo $row->nombre?></option>
                <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="box-footer">
          <a class="btn btn-danger pull pull-left"href="?c=Proveedor&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_proveedor]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
        </div>
      </form>
    </div>
  </div>
</div>