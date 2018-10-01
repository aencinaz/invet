 <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Finalizar Actividad</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()."actividad/listar"; ?>">Actividad</a></li>
          <li class="breadcrumb-item">Finalizar</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">

        <?php echo form_open(base_url()."actividad/finalizar/".$id) ?> 
        
        <div class="form-group">
                  <label class="control-label">Cliente</label>
                  <input readonly class="form-control" autocomplete="off" name="cliente" type="text" value="<?php echo $actividad['nombre_cliente']?>" placeholder="Nombre del cliente">   
         </div>
        <div class="form-group">
                  <label class="control-label">Sucursal</label>
                  <input readonly class="form-control" autocomplete="off" name="sucursal" type="text" value="<?php echo $actividad['nombre_sucursal']?>" placeholder="Nombre de la sucursal">  
                   <input readonly name ="id_sucursal"  autocomplete="off" value="<?php echo $actividad['id_sucursal']; ?>" type="hidden" class="form-control"> 
         </div>
          <div class="form-group">
                  <label class="control-label">Fecha de la Actividad</label>
                  <input readonly class="form-control" autocomplete="off" name="fecha_actividad" type="date" value="<?php echo $actividad['fecha_actividad']?>">  
      
         </div>
        

       <div class="form-group">
                  <label class="control-label">Observaciones</label>
                  <input class="form-control" autocomplete="off" name="observaciones" type="text" value="<?php echo $actividad['observaciones']?>" placeholder="">  
                  <div class="form-control-feedback"> <?php echo form_error('observaciones'); ?> </div>
         </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo base_url()."actividad/listar";?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
            </div>

              <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </main>