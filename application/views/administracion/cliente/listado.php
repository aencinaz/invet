 <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Clientes     <a href="<?php echo base_url();?>cliente\nuevo" class="btn btn-primary" type="button">Nuevo</a> </h1>       
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Cliente</a></li>
        </ul>
      </div>
        <!-- Buttons-->
            <?php if($mensaje!= FALSE){ ?>
                <div class="row">
                <div class="col-md-12">
                  <div class="bs-component">
                    <div class="alert alert-dismissible alert-<?php echo $mensaje['class']; ?>">
                      <button class="close" type="button" data-dismiss="alert">×</button><strong><?php echo $mensaje['strong']; ?>!</strong> <?php echo $mensaje['mensaje']; ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>   
            <div class="row">
              <div class="col-md-12">
                <div class="tile">

          
          <table id="sampleTable" class="table table-sm table-striped">
        	  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Rut</th>
			      <th scope="col">Teléfono</th>
			      <th scope="col">Dirección</th>
			      <th scope="col"></th>
			      <th scope="col"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $i=1; foreach ($clientes as $cliente_item): ?>
			    <tr>
			      <th scope="row"><?php echo $i; ?></th>
			      <td><?php echo $cliente_item['nombre']; ?></td>
			      <td><?php echo $cliente_item['rut']; ?></td>
			      <td><?php echo $cliente_item['telefono']; ?></td>
			      <td><?php echo $cliente_item['direccion']; ?></td>
			      <td><a href="<?php echo base_url().'cliente/editar/'.$cliente_item['id_cliente']; ?>">Editar</a></td>
			      <td><a id="confirmar"  onclick="return confirmar()" href="<?php echo base_url().'cliente/eliminar/'.$cliente_item['id_cliente']; ?>">Eliminar</a></td>
			     </tr>
			    <?php $i++; endforeach; ?>
			  </tbody>
			</table>


        
          </div>
        </div>
      </div>
    </main>
