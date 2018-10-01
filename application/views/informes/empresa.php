
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
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-body">

            <?php echo form_open(base_url()."informes/empresa") ?>

                <div class="form-group row ">
                  <label class="col-3 col-form-label">Cliente</label>
                  <div class="col-9">
                  <select name="id_cliente" id="primary" class="form-control" >
                           <option value=""></option>
                           <?php foreach ($clientes as $item): ?>
                           <option value="<?php echo $item['id_cliente']; ?>" <?php echo set_select('id_cliente',$item['id_cliente']); ?> ><?php echo $item['nombre']." ".$item['apellido']; ?></option>
                            <?php endforeach; ?>
                        </select>
                         <div class="form-control-feedback"> <?php echo form_error('id_cliente'); ?> </div>
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


