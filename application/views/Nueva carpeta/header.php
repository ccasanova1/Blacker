<!DOCTYPE html>
<html>
<head>
	<title>Blacked</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css')?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Blacked</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
  	<div>
  	   <form class="form-inline my-2 my-lg-0 justify-content-between">
      <input class="form-control mr-lg-2" type="text" placeholder="Buscar amigos" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
</div>
<div>
    <ul class="navbar-nav mr-auto">
    	<li>
    		<a class="navbar-brand" href="#">
    			<img src="<?php echo base_url('assets/imagenes/'.$foto_perfil); ?>" width="30" height="30" class="d-inline-block align-top" alt="">
    			<?php if($seleccion == "usuario"){
            echo $nombre." ".$apellido;
          }else{
            echo $nombre_pagina;
          }?>
  			</a>
    	</li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('login/logout'); ?>">Salir<span class="fa fa-globe"></span></a>
      </li>
    </ul>
</div>
  </div>
</nav>
</header>