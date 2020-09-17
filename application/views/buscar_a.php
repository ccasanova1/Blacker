    <div class="container" id="principio">
        <div class="row">
           <div class="col-lg-2 aside" id="laterali">
            <a href=""><img src="<?php echo base_url('assets/imagenes/'.$foto_perfil); ?>"></a>
               <nav class="nav-aside">
                   <ul>

                       <li><a href="">Galeria</a></li>
                       <?php if ($seleccion == 'usuario'): ?>
                           <li><a href="">Grupos registrados:</a></li>
                           <?php foreach ($grupo_ingresado as $grupos_t): ?>
                               <li><a href="<?php echo base_url('inicio/grupo/'.$grupos_t->id_grup) ?>"><?php echo $grupos_t->nombre_grupo ?></a></li>
                           <?php endforeach ?>
                           <li><a href="<?php echo base_url('inicio/crear_grupo') ?>">+Crear grupo</a></li>
                       <?php endif ?>
                   </ul>
               </nav>
           </div>
            <div class="col-12 col-md-8 col-lg-6 offset-lg-3 offset-md-2">
                <div class="container-fluid " id="muro">
                    <div class="row">
                        <?php foreach ($resultado as $usuarios): ?>
                        <div class="parte1 col-12 d-flex flex-row align-items-center mt-3 p-3">
                        <a class="mr-2" href="<?php echo base_url('inicio/perfil')."/".$usuarios->id; ?>">
                        <img class="img-fluid" src="<?php echo base_url('assets/imagenes/'.$usuarios->foto_perfil); ?>" alt="">
                        </a>
                        <div class="buscar">
                            <?php if(!empty($usuarios->nombre_entidad)): ?>

                                <p class="h6">Es una pagina
                                   
                                   </p>

                            <?php endif;?>
                            <a href="<?php echo base_url('inicio/perfil')."/".$usuarios->id; ?>"> 
                                <p class="h6">Nombre: <?php if(empty($usuarios->nombre)){
                                    echo $usuarios->nombre_entidad;       
                                    }else{
                                echo $usuarios->nombre;
                            }?></p>
                            </a>
                            <?php if(!empty($usuarios->nombre)): ?>
                                <a href="<?php echo base_url('inicio/perfil')."/".$usuarios->id ?>">
                                <p class="h6">Apellido: 
                                   <?php echo $usuarios->apellido; ?>
                                   </p>
                            </a>
                            <?php endif;?>
                            <a href="<?php echo base_url('inicio/perfil')."/".$usuarios->id; ?>"> 
                                <p class="h6">Correo: <?php echo $usuarios->email;?></p>
                            </a>
                             <?php if(!empty($usuarios->fecha_nacimiento)): ?>
                                <p class="h6">Edad:
                                        <?php list($Y,$m,$d) = explode("-",$usuarios->fecha_nacimiento);
                                        echo( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );?>
                                </p>

                                        <?php endif;?>

                                <p class="h6">Telefono: <?php echo $usuarios->telefono;?></p>

                            <?php if(!empty($usuarios->nombre)): ?>

                                <p class="h6">Genero: 
                                   <?php echo $usuarios->genero; ?>
                                   </p>

                            <?php endif;?>
                            <?php if(empty($usuarios->nombre)): ?>

                                <p class="h6">Descripcion: 
                                   <?php echo $usuarios->descripcion; ?>
                                   </p>

                            <?php endif;?>
                            </div>
                            <div class="ml-auto">
                                <a href="<?php echo base_url('inicio/perfil')?>/<?php echo $usuarios->id; ?>">
                                <button type="submit" class="btn btn-primary" id="publicar">Visitar</button>
                                </a>
                            </div>
                        
                </div>
                        
                <?php endforeach; ?>
                <?php foreach ($resultado2 as $grupos): ?>
                        <div class="parte1 col-12 d-flex flex-row align-items-center mt-3 p-3">
                        <a class="mr-2" href="<?php echo base_url('inicio/grupo')."/".$grupos->id_grupo; ?>">
                        <img class="img-fluid" src="<?php echo base_url('assets/imagenes/'.$grupos->ruta_foto); ?>" alt="">
                        </a>
                        <div class="buscar">
                            <a href="<?php echo base_url('inicio/grupo')."/".$grupos->id_grupo; ?>"> 
                                <p class="h6">Nombre: <?php echo $grupos->nombre_grupo; ?></p>
                            </a>

                                <p class="h6">Fecha de creacion: <?php echo $grupos->fecha_creacion;?></p>
                                <p class="h6">Descripcion: 
                                   <?php echo $grupos->grupo_descripcion; ?>
                                   </p>
                            </div>
                            <div class="ml-auto">
                                <a href="<?php echo base_url('inicio/grupo')?>/<?php echo $grupos->id_grupo; ?>">
                                <button type="submit" class="btn btn-primary" id="publicar">Visitar</button>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
            </div>
            <div class="col-md-2 col-lg-2 d-none d-md-block">
            </div>
        </div>
    </div>


    
    <script src="<?=base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.js') ?>"></script>
</body>

</html>