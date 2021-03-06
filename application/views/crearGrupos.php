<!DOCTYPE html>
<html>
<title>Blacker</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">-->
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/W3CSS.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/W3CSSThemes.css'; ?>">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/emojionearea.min.css'; ?>">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
#cuerpoPiblicaciones a{text-decoration:none;}
#cuerpoPiblicaciones a:hover{text-decoration:underline;}
.emojionearea{z-index: 0;}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">Blacker</a>
  <a href="<?php echo base_url('notificaciones'); ?>" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Notificaciones"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $notificaciones->CantNotificaciones; ?></span></a> 
  <form action="<?php echo base_url('inicio/buscar')?>" method="POST">
  <input class="w3-input w3-bar-item w3-padding-large w3-border" type="text" id="buscador" name="publicarBusqueda" placeholder="<?php echo $buscar ?>">
  </form>
  <div class="w3-dropdown-hover w3-hide-small w3-hover-white w3-right">
    <button class="w3-button w3-padding-large" title="Notifications">
      <img src="<?php echo base_url_assets.'assets/'.$foto_perfil; ?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
    </button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px; right:0">
      <a href="<?php echo base_url('login/logout'); ?>" class="w3-bar-item w3-button">Salir</a>
      <a href="<?php echo base_url('inicio/configuracion'); ?>" class="w3-bar-item w3-button">Configuracion</a>
    </div>
  </div>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Mi Perfil</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
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
                               echo "<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~')))."'>".$perfil->nombre.' '.$perfil->apellido."</a>";
                            }?></h4>
         <p class="w3-center"><img src="<?php echo base_url_assets.'assets/'.$foto_perfil; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>Pais: <?php if(!empty($cuenta->pais)){ echo $cuenta->pais;} ?></p>
          <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>Fecha Nacimiento: <?php if(!empty($perfil->fecha_nacimiento)){ echo $perfil->fecha_nacimiento;} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Telefono: <?php if(!empty($cuenta->telefono)){ echo $cuenta->telefono;}else{ echo "Sin telefono";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Genero: <?php if(!empty($perfil->genero)){ echo $perfil->genero;}else{ echo "Sin especificar genero";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Estado Sentimental: <?php if(!empty($perfil->estado_sentimental)){ echo $perfil->estado_sentimental;}else{ echo "Sin estado sentimental";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Ocupacion: <?php if(!empty($perfil->ocupacion)){ echo $perfil->ocupacion;}else{ echo "Sin ninguna ocupacion";} ?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('GruposDrop')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Mis Grupos</button>
          <div id="GruposDrop" class="w3-hide w3-container" style="padding: 0">
            <button id="btn-grupo" class="w3-button w3-block w3-theme" href="<?php echo base_url('Grupos/crearGrupo')?>">Crear Grupo</button>
          </div>
          <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('Amigos')?>"><i class="fa fa-address-book fa-fw w3-margin-right"></i> Mis Amigos</a>
          <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('albums/vistaAlbums/'.$id_cuenta)?>"><i class="fa fa-users fa-fw w3-margin-right"></i> Mis Albums</a>
        </div>      
      </div>
      <br>
  
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Crear un grupo</h6>
              <form id="frm-grupo" action="<?php echo base_url('Grupos/ingresarGrupo')?>" method="POST">
                <div id="nombreGrupoID" class="w3-padding">
                  <label> Nombre del grupo</label>
                  <input type="text" id="nombreGrupo" class="w3-border" style="width: 100%; margin-top: 0.5rem" name="nombreGrupo">
                  <div class="invalido w3-text-red"><span></span></div>
                </div>
                <div id="descripcion" class="w3-padding">
                  <label> Descripcion del grupo</label>
                  <textarea id="descripcionGrupo" name="descripcionGrupo" class="w3-border" style="width: 100%" rows="3" placeholder="Ingrese una descripcion del grupo"></textarea>
                  <div class="invalido w3-text-red"><span></span></div> 
                </div>
                <div id="fotoGrupo" class="w3-padding">
                  <label> Foto del grupo</label>
                  <input type="file" class="custom-file-input w3-border" id="customFileLang" lang="es" name="foto" style="width: 100%">
                  <div class="invalido w3-text-red"><span></span></div>
                </div>
                <button type="submit" id="btn-crear" class="w3-button w3-theme" style="margin-top: 0.5rem"><i class="fa fa-pencil"></i> Crear</button> 
              </form>
            </div>
          </div>
        </div>
      </div>
      <div id="cuerpoPiblicaciones">
        
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
       <div class="w3-card w3-round w3-white w3-center" id="listaChat">
        <p>Chats Amigos:</p>
        <?php $i = 1; foreach ($amigos as $value): ?>
        <button class="w3-button w3-block" id="btn-amigo-chat" onclick="document.getElementById('id-<?php echo $i; ?>').style.display='block';id_usuarioChat=<?php echo $value->id_cuenta?>;id_chat='#id-<?php echo $i; ?>';" style="text-align: left;text-overflow: ellipsis;" title="<?php echo $value->nombre.' '.$value->apellido?>"><img src="<?php echo base_url_assets.'assets/'.$value->foto_perfil; ?>" class="w3-circle" style="height:20px;width:20px" alt="Avatar"> <?php echo $value->nombre.' '.$value->apellido?></button>
      <?php $i++; endforeach; ?>
        </div>
      <br>
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>
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

<script type="text/javascript" src="<?=base_url_assets.'assets/js/jquery.min.js' ?>"></script>
<script type="text/javascript" src="<?=base_url_assets.'assets/js/emojionearea.min.js'; ?>"></script>

<script>
  var baseurl = "<?=base_url()?>";
  var id_chat = '#chat';
  var id_usuarioChat = 0;
// Accordion
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
<script type="text/javascript" src="<?=base_url_assets.'assets/js/grupos.js' ?>"></script>
<script type="text/javascript" src="<?=base_url_assets.'assets/js/chat.js' ?>"></script>
</body>
</html> 