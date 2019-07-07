<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Agregar Producto</h3>
      </div>
      <form name="form_producto">
        <div class="box-body">
          <div class="message"></div>
          <div class="form-group">
            <label for="txt_codigo">Código</label>
            <input type="text" class="form-control" name="txt_codigo" placeholder="Código">
          </div>
          <div class="form-group">
            <label for="txt_nombre">Nombre</label>
            <input type="text" class="form-control" name="txt_nombre" placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="txt_valor_unitario">Valor Unitario</label>
            <input type="number" class="form-control" name="txt_valor_unitario" placeholder="Valor Unitario">
          </div>
        </div>
        <div class="box-footer">
          <a class="btn btn-danger pull pull-left"href="?c=Producto&a=Index"><i class="fa fa-arrow-left"></i> Volver</a> <a onclick="$('[name=form_producto]').submit();" class="btn btn-success pull pull-right">Guardar <i class="fa fa-save"></i></a>
        </div>
      </form>
    </div>
  </div>
</div>