<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Producto</h3>
      </div>
      <form name="form_producto_edit">
        <div class="box-body">
          <div class="message"></div>
          <div class="form-group">
            <label for="txt_codigo">Código</label>
            <input type="text" class="form-control" name="txt_codigo" value="<?php echo $pro->codigo ?>">
          </div>
          <div class="form-group">
            <label for="txt_nombre">Nombre</label>
            <input type="text" class="form-control" name="txt_nombre" value="<?php echo $pro->nombre ?>">
          </div>
          <div class="form-group">
            <label for="txt_valor_unitario">Valor Unitario</label>
            <input type="number" class="form-control" name="txt_valor_unitario" value="<?php echo $pro->valor_unitario ?>">
          </div>
          <input style="display:none" name="id_producto" value="<?php echo $pro->id_producto ?>">
        </div>
        <div class="box-footer">
          <a class="btn btn-danger pull pull-left"href="?c=Producto&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_producto_edit]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
        </div>
      </form>
    </div>
  </div>
</div>