
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Informe de Actividades Planificadas</h1>
 
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()."cliente/listar"; ?>">Informes</a></li>
          <li class="breadcrumb-item">Informe de actividades</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">

            <?php echo form_open(base_url()."informes/planificadas") ?>

               <div class="form-group row">
                  <label class="col-3 col-form-label">Fecha</label>
                   <div class="col-9">
                  <input class="form-control" autocomplete="off" name="fecha" type="date" value="<?php echo set_value('fecha'); ?>">
                    <div class="form-control-feedback"> <?php echo form_error('fecha'); ?> </div>
                    </div>
                </div>
              

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Generar Informe</button>
            </div>

              <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </main> 


