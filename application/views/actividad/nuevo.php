  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Nueva Actividad</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()."actividad/listar"; ?>">Actividad</a></li>
          <li class="breadcrumb-item">Nuevo</li>
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
      


          <?php echo form_open(base_url()."actividad/nuevo") ?> 

                <div class="form-group row ">
                  <label class="col-3 col-form-label">Cliente</label>
                  <div class="col-9">
                  <select name="id_cliente" id="primary" class="form-control" >
                           <option value=""></option>
                           <?php foreach ($clientes as $cliente_item): ?>
                           <option value="<?php echo $cliente_item['id_cliente']; ?>" <?php echo set_select('id_cliente',$cliente_item['id_cliente']); ?> ><?php echo $cliente_item['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                            <div class="form-control-feedback"> <?php echo form_error('id_cliente'); ?> </div>
                   </div>     
              
                </div>




                <div class="form-group row">
                  <label class="col-3 col-form-label">Sucursal</label>
                   <div class="col-9">
                    <select name="id_sucursal" id="secondary" class="form-control" ></select>
                    <div class="form-control-feedback"> <?php echo form_error('id_sucursal'); ?> </div>
                    </div>
                </div>
           
                  <div class="form-group row">
                  <label class="col-3 col-form-label">Termino Planificación</label>
                   <div class="col-9">
                  <input class="form-control" autocomplete="off" name="fecha_termino" type="date" value="<?php echo set_value('fecha_termino'); ?>" placeholder="Ingrese fecha">
                    <div class="form-control-feedback"> <?php echo form_error('fecha_termino'); ?> </div>
                    </div>
                </div>

                 <div class="form-group row">
                  <label class="col-3 col-form-label">Observaciones</label>
                   <div class="col-9">
                  <input class="form-control" autocomplete="off" name="observaciones" type="text" value="<?php echo set_value('observaciones'); ?>" placeholder="Ingrese Observación">
                    </div>
                </div>
              
</div>
                              </div>
                <div class="tab-pane fade" id="profile">
                  <div class="card-body">
                  <div class="form-group row">
                   <div class="col">

<table class="table">
  <tr><th>Servicio</th><th>Repetir cada</th><th>Fecha Inicio</th></tr>
                <?php $i=0; foreach ($servicios as $servicio_item): ?>

               
               <tr>
                <td>
                 <input class="form-check-input" type="hidden" name="id_servicio[]" value="<?php echo $servicio_item['id_servicio']; ?>">
                 <input class="form-check-input" type="checkbox" name="seleccionados[]" value="<?php echo $i; ?>">
                  <label class="form-check-label" for="defaultCheck1">
                    <?php echo $servicio_item['nombre']; ?> 
                    <?php echo $servicio_item['descripcion']; ?>
                  </label>
             </td>
              <td>
                  <input class="form-control" autocomplete="off" name="periodo[]" type="number" value="<?php echo set_value('periodo'); ?>" placeholder="Ingrese días ">
              </td>
              <td>
               <input class="form-control" autocomplete="off" name="fecha_actividad[]" type="date" value="<?php echo set_value('fecha_actividad'); ?>" placeholder="Ingrese fecha">
                </div>
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
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="id_operador[]" value="<?php echo $operador_item['id_operador']; ?>">
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



