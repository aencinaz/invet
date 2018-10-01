
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Nuevo Cliente</h1>
 
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()."cliente/listar"; ?>">Cliente</a></li>
          <li class="breadcrumb-item">Nuevo</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">

            <?php echo form_open(base_url()."cliente/nuevo") ?>

                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" autocomplete="off" name="nombre" type="text" placeholder="Ingrese Nombre">
                  <div class="form-control-feedback"> <?php echo form_error('nombre'); ?> </div>
                 
                </div>
                <div class="form-group">
                  <label class="control-label">Rut</label>
                  <input class="form-control" autocomplete="off" name="rut" type="text" placeholder="Ingrese RUT ">
                </div>
              <div class="form-group">
                  <label class="control-label">Teléfono</label>
                  <input class="form-control" autocomplete="off" name="telefono" type="text" placeholder="Ingrese Teléfono ">
                </div>
              <div class="form-group">
                  <label class="control-label">Dirección</label>
                  <input class="form-control" autocomplete="off" name="direccion" type="text" placeholder="Ingrese Dirección">
                </div>
              

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo base_url()."cliente/listar";?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
            </div>

              <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </main> 


