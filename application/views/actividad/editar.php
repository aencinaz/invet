  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Editar Actividad</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()."actividad/listar"; ?>">Actividad</a></li>
          <li class="breadcrumb-item">Editar</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-8">



          <div class="tile">
            <div class="tile-body">



              <div class="bs-component">
              <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Datos</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#operadores">Operadores</a></li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="home">
            <div class="card-body">
      


          <?php echo form_open(base_url()."actividad/editar/".$actividad['id_actividad']) ?> 

              
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
                  <input  class="form-control" autocomplete="off" name="fecha_actividad" type="date" value="<?php echo $actividad['fecha_actividad']; ?>" placeholder="Ingrese fecha">
                </div>
                </div>


                 <div class="form-group row">
                  <label class="col-3 col-form-label">Observaciones</label>
                  <div class="col-9">
                  <input  class="form-control" autocomplete="off" name="observaciones" type="text" value="<?php echo $actividad['observaciones']; ?>" placeholder="">

                </div>
                </div>
              
</div>
                              </div>
                <div class="tab-pane fade" id="profile">
                  <div class="card-body">
                  <div class="form-group row">
                   <div class="col">

<table class="table">
  <tr><th>Servicios</th></tr>
                <?php $i=0; foreach ($servicios as $servicio_item): ?>
               
              <?php $seleccionado=FALSE;
                 foreach ($servicios_actividad as $item_actividad_servicio) {
                  if($item_actividad_servicio['id_servicio']==$servicio_item['id_servicio']){
                    $seleccionado=TRUE;
                  }
                }

                ?>
               
               <tr>
                <td>

                <?php if($seleccionado){ ?>
                  <input class="form-check-input" type="checkbox" name="id_servicio[]" checked value="<?php echo $servicio_item['id_servicio']; ?>">
                <?php } else {?>
                  <input class="form-check-input" type="checkbox" name="id_servicio[]" value="<?php echo $servicio_item['id_servicio']; ?>">
                  <?php }?>
                 


                  <label class="form-check-label" for="defaultCheck1">
                    <?php echo $servicio_item['nombre']; ?> 
                    <?php echo $servicio_item['descripcion']; ?>
                  </label>
             </td>
              
              </tr>
              <?php $i++; endforeach; ?>
            </table>
                <div class="form-control-feedback"> <?php echo form_error('id_servicio'); ?> </div>
                </div>
                </div>
              </div>


                </div>
         
       <div class="tab-pane fade" id="operadores">
                  <div class="card-body">
                  <div class="form-group row">
                   <div class="col-9">


                <?php foreach ($operadores as $operador_item): ?>
                <?php $seleccionado=FALSE;
                 foreach ($operadores_actividad as $item_operadores_actividad) {
                  if($item_operadores_actividad['id_operador']==$operador_item['id_operador']){
                    $seleccionado=TRUE;
                  }
                }

                ?>

                <div class="form-check">
                    <?php if($seleccionado){ ?>
                  <input class="form-check-input" type="checkbox" name="id_operador[]" checked value="<?php echo $operador_item['id_operador']; ?>">
                   <?php } else {?>
                  <input class="form-check-input" type="checkbox" name="id_operador[]" value="<?php echo $operador_item['id_operador']; ?>">
                    <?php }?>

                  <label class="form-check-label" for="defaultCheck1">
                    <?php echo $operador_item['nombre']; ?> 
                    <?php echo $operador_item['apellido']; ?>
                  </label>
                </div>

  <?php endforeach; ?>
                <div class="form-control-feedback"> <?php echo form_error('id_servicio'); ?> </div>
                </div>
                </div>
              </div>


                </div>
         



              </div>
            </div>


            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo base_url()."actividad/listar";?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
            </div>
          
              <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </main> 



