
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
                        <?php foreach ($publicacion as $valor):?>
                        <div class="parte1 col-12 d-flex flex-row align-items-center mt-3 p-3">
                            <a class="mr-2" href="">
                            <img class="img-fluid" src="<?php echo base_url('assets/imagenes/'.$cuenta->foto_perfil); ?>" alt="">
                        </a>
                            <a href="<?php echo base_url('inicio/perfil')."/".$perfil->id_cuenta; ?>"> 
                                <p class="h6"><?php if(empty($perfil->nombre)){
                                    echo $perfil->nombre_entidad;       
                                    }else{
                                echo $perfil->nombre.' '.$perfil->apellido;
                            }?>
                            </p>
                            </a>
                        </div>
                        <div class="parte1 col-12">
                            <p class="py-2"><?php if(empty($perfil->nombre)){
                                    echo $perfil->nombre_entidad;       
                                    }else{
                                echo $perfil->nombre;
                            }?>
                             a publicado <?php echo $valor->fecha; ?></p>
                        </div>
                        <div class="parte1 col-12">
                            <p class="py-2"><?php echo $valor->contenido; ?></p>
                        </div>
                        <?php foreach($foto_publicacion as $valor2): ?>
                        <?php if($valor->id_publicacion == $valor2->id_publicacion): ?>
                        <div class="col-12">
                            <div class="parte2 p-3">
                                
                                <img class="img-fluid" src="<?php echo base_url('assets/albumes/'.$valor2->nombre_album.'/'.$valor2->ruta_album.'/'.$valor2->ruta_foto); ?>" alt="">
                            
                            </div>
                        </div>
                        <?php endif ?>
                        <?php endforeach; ?>
                        <?php if(!empty($valor->ruta_video) or $valor->ruta_video != NULL): ?>
                        <div class="embed-responsive embed-responsive-16by9 parte2 p-3">
                            <iframe class="embed-responsive-item" src="<?php echo $valor->ruta_video ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>
                        <div class="col-12">
                            <div class="parte3 px-2 py-1">
                                <p class="h5">Comentarios...</p>
                                <div class="comentarios d-flex flex-row align-items-stretch px-3">
                                    <div class="align-self-center">
                                        <p class="h6">Cristian Casanova</p>
                                    </div>
                                    <div class="comentario pl-2">
                                        <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php endforeach; ?> 
                    </div>
                </div>
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
