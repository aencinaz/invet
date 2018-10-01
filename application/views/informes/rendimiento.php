
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Informe del Cliente</h1>
 
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()."cliente/listar"; ?>">Informes</a></li>
          <li class="breadcrumb-item">Informe de actividades Cliente</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">

            <?php echo form_open(base_url()."informes/rendimiento") ?>

                <div class="form-group row">
                  <label class="col-3 col-form-label">Fecha</label>
                   <div class="col-9">
                  <input class="form-control" autocomplete="off" onchange="submit()" name="fecha"  type="month" value="<?php echo set_value('fecha'); ?>">
                    <div class="form-control-feedback"> <?php echo form_error('fecha'); ?> </div>
                    </div>
                </div>
                <table class="table table-striped">
                  <thead class="thead-inverse"><tr><th>Operador</th><th>Actividades Realizadas</th><th>Actividades Replanificadas<br>(por operador)</th><th>Rendimiento</th></tr></thead>
                  <tbody>
            <?php echo form_close(); ?>
                           <?php foreach ($rendimiento as $item): ?>

                            <?php 
                            $rendimiento=(($item['cnt_actividades']-$item['cnt_movimientos'])*100)/$item['cnt_actividades'];
                            ?>

                            <tr><td><?php echo $item['nombre']." ".$item['apellido']."</td><td>".$item['cnt_actividades']."</td><td>".$item['cnt_movimientos']."</td><td>".round($rendimiento)."%" ?></td></tr>
                            <?php endforeach; ?> 
                         </tbody> </table>
            
              <?php echo form_close(); ?>
          </div>
        </div>
      </div>
        

 </div>
 

    </main> 


