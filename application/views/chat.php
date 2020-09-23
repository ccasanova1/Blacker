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
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top w3-mobile" style="position: relative">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">Blacker</a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
  <a href="<?php echo base_url('notificaciones'); ?>" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Notificaciones"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $notificaciones->CantNotificaciones; ?></span></a>  
  <?php if($seleccion == 'usuario'): ?>
    <form action="<?php echo base_url('inicio/buscar')?>" method="POST">
    <input class="w3-input w3-bar-item w3-mobile w3-padding-large w3-border " type="text" id="buscador" name="publicarBusqueda" placeholder="<?php echo $buscar ?>">
    </form>
  <?php endif; ?>
  <div class="w3-dropdown-hover w3-hide-small w3-hover-white w3-right">
    <button class="w3-button w3-padding-large" title="Notifications">
      <img src="<?php echo 'assets/'.$foto_perfil; ?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
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
            <?php foreach ($grupos as $value) {
                echo "<a id='btn-grupo' class='w3-button w3-block w3-theme' href='".base_url('/Grupos/verGrupo/'.urlencode(strtr($this->encrypt->encode($value->id_grupo),array('+' => '.', '=' => '-', '/' => '~'))))."'>".$value->nombre."</a>";
              } ?>
            <a id="btn-grupo" class="w3-button w3-block w3-theme" href="<?php echo base_url('Grupos/crearGrupo')?>">Crear Grupo</a>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
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
    
      <div id="cuerpoChat">
        
      <!-- End Middle Column -->
      </div>
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2" style="overflow-y: auto;max-height: 768px;">
      <div class="w3-card w3-round w3-white w3-center" id="listaChat">
        <p>Lista Amigos:</p>
        <?php foreach ($amigos as $value): ?>
        <button class="w3-button w3-block" id="btn-amigo<?php echo random_string('alnum', 11)?>" style="text-align: left;text-overflow: ellipsis;" title="<?php echo $value->nombre.' '.$value->apellido?>"><img src="<?php echo base_url_assets.'assets/'.$value->foto_perfil; ?>" class="w3-circle" style="height:20px;width:20px" alt="Avatar"> <?php echo $value->nombre.' '.$value->apellido?></button>
      <?php endforeach; ?>
        </div>
      </div>
      <br>     
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>


<script type="text/javascript" src="<?=base_url_assets.'assets/js/jquery.min.js' ?>"></script>
<script>
// Accordion
var baseurl = "<?=base_url()?>";
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
<script type="text/javascript" src="<?=base_url_assets.'assets/js/buscar.js' ?>"></script>
<script type="text/javascript" src="<?=base_url_assets.'assets/js/amigo.js' ?>"></script>


</body>
</html> 
