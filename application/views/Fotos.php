<!DOCTYPE html>
<html>
<title>Blacker</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/W3CSS.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/W3CSSThemes.css'; ?>">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/emojionearea.min.css'; ?>">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
.emojionearea{z-index: 0;}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top w3-mobile" style="position: relative">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">Blacker</a>
  <a href="<?php echo base_url('notificaciones'); ?>" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Notificaciones"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $notificaciones->CantNotificaciones; ?></span></a>  
  <?php if($seleccion == 'usuario'): ?>
    <form action="<?php echo base_url('inicio/buscar')?>" method="POST">
    <input class="w3-input w3-bar-item w3-mobile w3-padding-large w3-border " type="text" id="buscador" name="publicarBusqueda" placeholder="<?php echo $buscar ?>">
    </form>
  <?php endif; ?>
  <div class="w3-dropdown-hover w3-hide-small w3-hover-white w3-right">
    <button class="w3-button w3-padding-large" title="Notifications">
      <img src="<?php echo base_url_assets.'assets/'.$foto_perfil; ?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
    </button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px; right:0">
      <a href="<?php echo base_url('login/logout'); ?>" class="w3-bar-item w3-button">Salir</a>
      <a href="<?php echo base_url('inicio/configuracion'); ?>" class="w3-bar-item w3-button">Configuracion</a>
    </div>
  </div>
   <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large" >
    <button onclick="myFunction('Demo2')" class="w3-button w3-bar-item"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Mi Grupos</button>
     <div id="Demo2" class="w3-hide w3-container" style="padding: 0">
      <?php foreach ($grupos as $value) {
        echo "<a id='btn-grupo' class='w3-button w3-block w3-theme' href='".base_url('/Grupos/verGrupo/'.urlencode(strtr($this->encrypt->encode($value->id_grupo),array('+' => '.', '=' => '-', '/' => '~'))))."'>".$value->nombre."</a>";
      } ?>
    </div>
    <a href="#" class="w3-bar-item w3-button w3-padding-large" >Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large" >Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large" >Link 3</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large" >Mi Perfil</a>
  </div>
 </div>

</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;padding-top:20px">      
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?php if(empty($perfil->nombre)){
                                    echo $perfil->nombre_entidad;       
                                    }else{
                                echo "<a href='".base_url('inicio/perfil')."/".$perfil->id_cuenta."'>".$perfil->nombre.' '.$perfil->apellido."</a>";
                            }?></h4>
         <p class="w3-center"><img src="<?php echo base_url_assets.'assets/'.$cuenta->foto_perfil; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>Pais: <?php if(!empty($cuenta->pais)){ echo $cuenta->pais;} ?></p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>Fecha Nacimiento: <?php if(!empty($perfil->fecha_nacimiento)){ echo $perfil->fecha_nacimiento;} ?></p>
         <?php if ($amigo->estado == 'amigos' OR $amigoEstado->banderaPerfil != 'OK'): ?>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Telefono: <?php if(!empty($cuenta->telefono)){ echo $cuenta->telefono;}else{ echo "Sin telefono";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Genero: <?php if(!empty($perfil->genero)){ echo $perfil->genero;}else{ echo "Sin especificar genero";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Estado Sentimental: <?php if(!empty($perfil->estado_sentimental)){ echo $perfil->estado_sentimental;}else{ echo "Sin estado sentimental";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Ocupacion: <?php if(!empty($perfil->ocupacion)){ echo $perfil->ocupacion;}else{ echo "Sin ninguna ocupacion";} ?></p>
        <?php endif; ?>
        <?php if (empty($amigo->estado) and $amigoEstado->banderaPerfil == 'OK'): ?>
         
          <form method="POST" id="frm-amigo">
          <input class="" type="text" id="id-amigo" value="<?php echo $perfil->id_cuenta; ?>" name="amigo" hidden>
          <button class="w3-button w3-block w3-green" id="btn-amigo" title="Amigo">Agregar</button>
          </form>
          <?php elseif ($amigo->estado == 'pendiente'): ?>
            <p class="w3-blue w3-center" >Pendiente</p>
          <?php elseif ($amigo->estado == 'rechazado'): ?>
            <p class="w3-red w3-center" >Rechazado</p> 
          <?php elseif ($amigo->estado == 'amigos'): ?>
            <p class="w3-green w3-center" >Amigos</p> 
        <?php endif; ?>
            
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <?php if ($amigoEstado->banderaPerfil != 'OK'): ?>
            <button onclick="myFunction('GruposDrop')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Mis Grupos</button>
            <div id="GruposDrop" class="w3-hide w3-container" style="padding: 0">
              <?php foreach ($grupos as $value) {
                echo "<a id='btn-grupo' class='w3-button w3-block w3-theme' href='".base_url('/Grupos/verGrupo/'.urlencode(strtr($this->encrypt->encode($value->id_grupo),array('+' => '.', '=' => '-', '/' => '~'))))."'>".$value->nombre."</a>";
              } ?>
              <a id="btn-grupo" class="w3-button w3-block w3-theme" href="<?php echo base_url('Grupos/crearGrupo')?>">Crear Grupo</a>
            </div>
          <?php endif; ?>
            <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('Amigos')?>"><i class="fa fa-address-book fa-fw w3-margin-right"></i> Mis Amigos</a>
           <?php if ($amigoEstado->banderaPerfil != 'OK'): ?>
            <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('albums/vistaAlbums/'.$perfil->id_cuenta)?>"><i class="fa fa-users fa-fw w3-margin-right"></i>Mis Albums</a>
          <?php else: ?>
            <?php if ($amigo->estado == 'amigos'): ?>
              <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('albums/vistaAlbums/'.$perfil->id_cuenta)?>"><i class="fa fa-users fa-fw w3-margin-right"></i> Albums</a>
            <?php endif; ?>
          <?php endif; ?>
        </div>      
      </div>
      <br>
     
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
      <div id="cuerpoFotos">
        
      </div>
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2" style="overflow-y: auto;max-height: 768px;">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Visitas: a mi perfil:</p>
          <p><strong><?php echo $visitas ?></strong></p>
        </div>
      </div>
      <br>
      
      <?php if($seleccion == 'usuario'): ?>
      <div class="w3-card w3-round w3-white w3-center" style="padding-bottom: 8px">
        <div class="w3-container">
          <p>Solicitudes de amistad</p>
          <?php foreach ($amigoPendiente as $value2):?>
            <div class="mySlides">
              <img src="<?php echo base_url_assets.'assets/'.$value2->foto_perfil; ?>" alt="Avatar" style="width:50%"><br>
              <a href="<?php base_url('inicio/perfil').'/'.urlencode(strtr($this->encrypt->encode($value->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))?>"><span><?php echo $value2->nombre." ".$value2->apellido; ?></span></a>
              <div class="w3-row w3-opacity">
                <div class="w3-half">
                  <button class="w3-button w3-block w3-green w3-section" id="btn-aceptar" value="<?php echo urlencode(strtr($this->encrypt->encode($value2->id_cuenta),array('+' => '.', '=' => '-', '/' => '~'))) ?>" title="Aceptar" onclick="plusDivs(1)"><i class="fa fa-check"></i></button>
                </div>
                <div class="w3-half">
                  <button class="w3-button w3-block w3-red w3-section" id="btn-rechazar" value="<?php echo urlencode(strtr($this->encrypt->encode($value2->id_cuenta),array('+' => '.', '=' => '-', '/' => '~'))) ?>" title="Rechazar" onclick="plusDivs(1)"><i class="fa fa-remove"></i></button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <div class="mySlides">
            <span>Ninguna peticion pendiente</span>
          </div>
        </div>
      </div>
      <div class="w3-card w3-round w3-white w3-center" id="listaChat">
        <p>Chats Amigos:</p>
        <?php $i = 1; foreach ($amigos as $value): ?>
        <button class="w3-button w3-block" id="btn-amigo-chat" onclick="document.getElementById('id-<?php echo $i; ?>').style.display='block';id_usuarioChat=<?php echo $value->id_cuenta?>;id_chat='#id-<?php echo $i; ?>';" style="text-align: left;text-overflow: ellipsis;" title="<?php echo $value->nombre.' '.$value->apellido?>"><img src="<?php echo base_url_assets.'assets/'.$value->foto_perfil; ?>" class="w3-circle" style="height:20px;width:20px" alt="Avatar"> <?php echo $value->nombre.' '.$value->apellido?></button>
      <?php $i++; endforeach; ?>
        </div>
      <br>
      <?php endif; ?>

      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>
<?php if($seleccion == 'usuario'): ?>
  <?php $i = 1; foreach ($amigos as $value): ?>
    <div id='id-<?php echo $i; ?>' class="w3-modal">
      <div class="w3-modal-content" id="chat">

        <header class="w3-container w3-theme-d2">
          <span onclick="document.getElementById('id-<?php echo $i; ?>').style.display='none';id_chat='#chat';id_usuarioChat=0;"
          class="w3-button w3-display-topright"><i class="fa fa-times" aria-hidden="true"></i></span>
          <h4><?php echo $value->nombre.' '.$value->apellido?></h4>
        </header>

        <div class="w3-container" id='cuerpoChat' style="overflow-y: auto;min-height: 300px;max-height: 300px;height: 100%">
        </div>

        <footer class="w3-container w3-theme-d2 w3-padding">
          <textarea id="mandarChat" name="mandarChat" class="w3-border w3-padding" style="width: 100%" rows="3"></textarea>
          <button id="btn-chat<?php echo random_string('alnum', 11)?>" class="w3-button w3-theme" style="margin-top: 0.5rem"><i class="fa fa-pencil"></i> Enviar</button> 
        </footer>

      </div>
    </div>
  <?php $i++; endforeach; ?>
<?php endif; ?>


<script src="<?=base_url_assets.'assets/js/jquery.min.js' ?>"></script>
<script type="text/javascript" src="<?=base_url_assets.'assets/js/emojionearea.min.js'; ?>"></script>

<script>
  var baseurl = "<?=base_url()?>";
  var banderaPerfil = "<?php echo $amigoEstado->banderaPerfil ?>";
  var amigoEstado = "<?php echo $amigo->estado ?>";
  var id_cuenta = "<?php echo $perfil->id_cuenta ?>";
  var id_album = "<?php echo $album->id_album ?>";
  var id_chat = '#chat';
  var id_usuarioChat = 0;
// Accordion
  $("#contComentario").emojioneArea({
    pickerPosition: "right"
  });
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

</script>
<script src="<?=base_url_assets.'assets/js/fotos.js' ?>"></script>
<script src="<?=base_url_assets.'assets/js/amigo.js' ?>"></script>
<script type="text/javascript" src="<?=base_url_assets.'assets/js/chat.js' ?>"></script>
</body>
</html> 