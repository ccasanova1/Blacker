<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='<?php echo base_url('assets/font-awesome/css/font-awesome.css') ?>' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/estilos.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/emojionearea.min.css') ?>">

    <title>Inicio</title>
</head>

<body>
    <header class="encabezado fixed-top" role="banner">
        <div class="container">
            <a href="<?php echo base_url('inicio')?>" class="logo">
            <img src="<?php echo base_url('assets/logo/icon.svg')?>" alt="logo">
          </a>
          <?php if(($seleccion) == "usuario"): ?>
           <form class="form-inline my-auto ml-auto p-auto" action="<?php echo base_url('inicio/buscar')?>" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" id="buscador" name="buscar" placeholder="<?php echo $buscar ?>" ">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    <?php endif; ?>
            <button type="button" class="boton-menu d-md-none" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false">
            <i class="fa fa-bars" aria-hidden="true"></i>
          </button>
            <nav class="collapse" id="menu-principal">
                <ul>
                    <li><a href="<?php echo base_url('inicio')?>">Inicio</a></li>
                    <li><a href="<?php echo base_url('publicacion'); ?>">Publicar</a></li>
                    <?php if ($seleccion == "usuario"):?>
                       <li><a href="registro.html">Grupos</a></li>
                    <?php endif?>
                    <li  id="user"><a class="d-none d-lg-block" href="">
                      <?php if($seleccion == "usuario"){
                              echo $nombre." ".$apellido;
                            }else{
                              echo $nombre_pagina;
                            }?>
                      </a>
                    </li>
                    <li><a class="d-none d-md-block" href="" id="perfil"><img src="<?php echo base_url('assets/imagenes/'.$foto_perfil); ?>" alt=""></a></li>
                    <li class="nav-item dropdown">
                    <button class="d-none d-md-block dropdown-toggle" type="button" id="opciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear" aria-hidden="true"></i></button>
                    <div class="dropdown-menu" id="opcion" aria-labelledby="opciones">
                        <a href="" class="dropdown-item">Configuracion</a>
                        <a href="<?php echo base_url('login/logout'); ?>" class="dropdown-item">Cerrar sesión</a>

                    </div>
                    </li>
                    <?php if ($seleccion = "pagina"): ?>
                        <li><a  class="d-none d-md-block" href="" id="opciones"><i class="fa fa-globe"><span class="label label-warning"></span></i></a>
                    </li>
                    <?php endif; ?>
                    
                </ul>  
            </nav>
            
        </div>
        
    </header>