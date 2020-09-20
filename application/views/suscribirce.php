<!DOCTYPE html>
<html>
<title>Blacker</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url('assets/css/W3CSS.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/W3CSSThemes.css'); ?>">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/emojionearea.min.css'); ?>">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
#cuerpoPiblicaciones a{text-decoration:none;}
#cuerpoPiblicaciones a:hover{text-decoration:underline;}
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
      <img src="<?php echo base_url('assets/'.$foto_perfil); ?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
    </button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px; right:0">
      <a href="<?php echo base_url('login/logout'); ?>" class="w3-bar-item w3-button">Salir</a>
      <a href="<?php echo base_url('inicio/configuracion'); ?>" class="w3-bar-item w3-button">Configuracion</a>
      <a href="#" class="w3-bar-item w3-button">no se que</a>
    </div>
  </div>
   <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large" >
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
         <h4 class="w3-center"><?php if($seleccion == 'pagina'){
                                    echo $perfil->nombre_entidad;       
                                    }else{
                                echo "<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~')))."'>".$perfil->nombre.' '.$perfil->apellido."</a>";
                            }?></h4>
         <p class="w3-center"><img src="<?php echo base_url('assets/'.$foto_perfil); ?>" class="w3-circle" style="width:106px;height:106px" alt="Avatar"></p>
         <hr>
          <?php if($premium === TRUE){echo "<p><i class='fa fa-pencil fa-fw w3-margin-right w3-text-theme'></i>Pagina Premium </p> ";} ?>
           <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php if(!empty($calle)){ echo $calle;}else{ echo "Sin calle registrada";} ?></p>
           <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php if(!empty($numero)){ echo $numero;}else{ echo "Sin numero de puerta";} ?></p>
           <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php if(!empty($esquina)){ echo $esquina;}else{ echo "Sin esquina registrada";}  ?></p>
           <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>Pais: <?php if(!empty($pais)){ echo $pais;} ?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <?php if($seleccion == 'pagina'): ?>
            <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('Inicio/suscribirce')?>"><i class="fa fa-picture-o fa-fw w3-margin-right"></i> Suscribirce</a>
          <?php endif; ?>
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
              <h6 class="w3-opacity">Comprar suscripcion</h6>
              <form id="frm-suscribir" class="w3-container" method="POST">
                <p>Duracion:</p>
                <p><input type="radio" id="checkUnaSemana" value="7" class="w3-radio" style="margin-top: 0.5rem;margin-right: 1rem" name="duracion"><label>7 Dias Costo: U$S<?php echo $duracion['7'] ?></label></br>
                <input type="radio" id="checkUnMes" value="31" class="w3-radio" style="margin-top: 0.5rem;margin-right: 1rem" name="duracion"><label>1 Mes Costo: U$S<?php echo $duracion['31'] ?></label></br>
                <input type="radio" id="checkUnAño" value="365" class="w3-radio" style="margin-top: 0.5rem;margin-right: 1rem" name="duracion"><label>1 Año Costo: U$S<?php echo $duracion['365'] ?></label></p>
                <div id="numeroTarjeta"><p><label>Numero de tarjeta: </label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="numeroTarjeta" maxlength="16" size="16"></p><div class="invalido w3-text-red"><span></span></div></div>
                <div id="vencimientoAño"><p><label>Vencimiento: </label><input class="" style="margin-top: 0.5rem; " name="vencimientoMes" maxlength="2" size="2">/<input class="" style="margin-top: 0.5rem;margin-right: 1rem" name="vencimientoAño" maxlength="2" size="2"></p><div class="invalido w3-text-red"><span></span></div></div>
                <div id="CVC"><p><label>Codigo de seguridad: </label><input class="" style="margin-top: 0.5rem;margin-right: 1rem" name="CVC" maxlength="4" size="4"></p><div class="invalido w3-text-red"><span></span></div></div>
                <button type="submit" id="btn-suscribir" class="w3-button w3-theme" style="margin-top: 0.5rem"><i class="fa fa-pencil"></i>Suscribir</button> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Upcoming Events:</p>
          <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
        </div>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>ADS</p>
      </div>
      <br>

      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>


<script src="<?=base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/emojionearea.min.js'); ?>"></script>

<script>
  var baseurl = "<?=base_url()?>";
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
<script src="<?=base_url('assets/js/suscribirce.js') ?>"></script>
</body>
</html> 
