<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Vali Admin</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
      </div>
      <div class="login-box">
		
        <form class="login-form" method="post" action="<?php echo base_url()?>login">
          <h3 class="login-head">  <img  src="<?php echo base_url()."assets/img/logo.png"; ?>" alt="User Image">
      INICIAR</h3>
          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input autocomplete="off" class="form-control" name="login" type="text" placeholder="Usuario" autofocus>
              <span class="text-danger"><?php echo form_error('login'); ?></span>
          </div>
          <div class="form-group">
            <label class="control-label">CONTRASEÑA</label>
            <input class="form-control" name="password" type="password" placeholder="Contraseña">
              <span class="text-danger"><?php echo form_error('password'); ?></span>
          </div>
         
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>ENTRAR</button>
          </div>
          	<?php echo $mensaje; ?>
        </form>
        
      </div>
    </section>
     
					 
  </body>
  <!-- Essential javascripts for application to work-->
  <script src="<?php echo base_url()?>assets/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/popper.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
</html>
<script type="text/javascript">
  // Login Page Flipbox control
  $('.login-content [data-toggle="flip"]').click(function() {
  	$('.login-box').toggleClass('flipped');
  	return false;
  });
</script>