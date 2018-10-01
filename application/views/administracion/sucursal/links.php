<nav class="col-sm-3 col-md-1 d-none d-sm-block bg-light sidebar">
	<ul class="nav nav-pills flex-column">
		<li class="nav-item"><a class="nav-link <?php if($link_selected==="Nuevo"){echo "active";} ?>" href="<?php echo base_url();?>sucursal\nuevo">Nuevo</a></li>
		<li class="nav-item"><a class="nav-link <?php if($link_selected==="Listado"){echo "active";} ?>" href="<?php echo base_url();?>sucursal\listar">Listado</a></li>
	</ul>
</nav>