<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Nuevo Usuario</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()."usuario/listar"; ?>">Usuario</a></li>
          <li class="breadcrumb-item">Nuevo</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">

             <?php echo form_open(base_url()."usuario/nuevo") ?>	


               <div class="form-group">
                  <label class="control-label">Login</label>
                  <input class="form-control" autocomplete="off" name="login" type="text" placeholder="Ingrese Login">
                  <div class="form-control-feedback"> <?php echo form_error('login'); ?> </div>
                 
                </div>

				<div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" autocomplete="off" name="nombre" type="text" placeholder="Ingrese Nombre">
                  <div class="form-control-feedback"> <?php echo form_error('nombre'); ?> </div>
                 
                </div>

                <div class="form-group">
                  <label class="control-label">Contraseña</label>
                  <input class="form-control" autocomplete="off" name="pass" type="text" placeholder="Ingrese Contraseña">
                  <div class="form-control-feedback"> <?php echo form_error('pass'); ?> </div>
                </div>
              

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo base_url()."usuario/listar";?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
            </div>

              <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </main> 



