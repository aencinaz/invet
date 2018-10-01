 <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Actividad</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()."actividad/listar"; ?>">Actividad</a></li>
          <li class="breadcrumb-item">Ficha</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">

     
             


              <div class="form-group row">
                  <label class="col-3 col-form-label">Cliente</label>
                     <div class="col-9">
                  <input readonly class="form-control" autocomplete="off" name="periodo" type="text" value="<?php echo $actividad['nombre_cliente']; ?>" placeholder="Ingrese días ">
                </div>
                </div>

                <div class="form-group row">
                  <label class="col-3 col-form-label">Sucursal</label>
                     <div class="col-9">
                  <input readonly class="form-control" autocomplete="off" name="periodo" type="text" value="<?php echo $actividad['nombre_sucursal']; ?>" placeholder="Ingrese días ">
                </div>
                </div>

            


              <div class="form-group row">
                  <label class="col-3 col-form-label">Fecha Inicio Actividad</label>
                  <div class="col-9">
                  <input readonly class="form-control" autocomplete="off" name="fecha_actividad" type="date" value="<?php echo $actividad['fecha_actividad']; ?>" placeholder="Ingrese fecha">
                </div>
                </div>


                 <div class="form-group row">
                  <label class="col-3 col-form-label">Observaciones</label>
                  <div class="col-9">
                  <input readonly class="form-control" autocomplete="off" name="observaciones" type="text" value="<?php echo $actividad['observaciones']; ?>" placeholder="">

                </div>
                </div>
              



      <div class='row'>
      <div class='col'>
      <ul class="list-group">
       <li class="list-group-item active">Servicios</li>
      <?php foreach ($servicios as $item) {?>
        <li class="list-group-item"><?php echo $item['nombre']."  ".$item['descripcion'];?></li>
      <?php }?>
      </ul>
      </div>
      <div class='col'>
      <ul class="list-group">
       <li class="list-group-item active">Operadores</li>
      
      <?php foreach ($operadores as $item) { ?>
        <li class="list-group-item"><?php echo $item['nombre']." ".$item['apellido'];?></li>
      <?php } ?>
        </ul>
      </div>

      <div>




       
              <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </main> 


