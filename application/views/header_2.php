<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

   <link rel="stylesheet" href="<?php echo base_url();?>assets2/fullcalendar/dist/fullcalendar.css">

 



    <title>InvetAustral</title>
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Invet Austral</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Configuración</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Salir</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo base_url()."assets/img/logo.png"; ?>" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">Alberto S</p>
          <p class="app-sidebar__user-designation">Administrador</p>
        </div>
      </div>
      <ul class="app-menu">
       <li><a class="app-menu__item <?php if($selected=="Actividades") echo "active"?> " href="<?php echo base_url();?>actividad\listar">        <i class="app-menu__icon fa fa-bug fa-lg"></i><span class="app-menu__label">Actividades</span></a></li>
        <li><a class="app-menu__item <?php if($selected=="Calendario") echo "active"?>" href="<?php echo base_url();?>actividad\calendario">   <i class="app-menu__icon fa fa-calendar fa-lg"></i><span class="app-menu__label">Calendario</span></a></li>
        <li class="treeview"><a class="app-menu__item <?php if($selected=="Administración") echo "active"?>" href="#" data-toggle="treeview">      <i class="app-menu__icon fa fa-cog fa-lg"></i><span class="app-menu__label">Administración</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu ">
            <li><a class="treeview-item" href="<?php echo base_url();?>servicio/listar"><i class="icon fa fa-circle-o"></i> Servicios</a></li>
            <li><a class="treeview-item" href="<?php echo base_url();?>cliente/listar"><i class="icon fa fa-circle-o"></i> Clientes</a></li>
            <li><a class="treeview-item" href="<?php echo base_url();?>sucursal/listar"><i class="icon fa fa-circle-o"></i> Sucursales</a></li>
            <li><a class="treeview-item" href="<?php echo base_url();?>principal/hacer_backup"><i class="icon fa fa-circle-o"></i> Respaldos</a></li>
            <li><a class="treeview-item" href="<?php echo base_url();?>usuario/listar"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
          </ul>
        </li>
      </ul>
    </aside>