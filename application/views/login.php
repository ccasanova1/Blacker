<!DOCTYPE html>
<html>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/W3CSS.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/W3CSSThemes.css'; ?>">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/estilos.css' ?>">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
html, body {
  height: 100%;
}
</style>
<body class="w3-theme-l5" style="">

<!-- Navigation Bar -->
<div class="w3-bar w3-left-align w3-large w3-theme-d2" >
    <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-theme-d4 w3-mobile w3-hide-small w3-padding-large">Blacker</a>
    <a href="#" class="w3-bar-item w3-button w3-mobile w3-theme-l5 w3-hide-small w3-padding-large w3-hover-white">Login</a>
    <a href="<?php echo base_url('login/registrar') ?>" class="w3-bar-item w3-button w3-mobile w3-hide-small w3-padding-large w3-hover-white">Registrate</a>
</div>
<!-- Header -->


<!-- Page content -->
<div class="w3-content" style="max-width:1200px; height: 100%">

 	<div class="w3-container w3-margin-top w3-center" id="registro">
    <h2>ENTRA A LA RED</h2>
  </div>
  

  <div class="w3-row-padding " id="about">
  	
    <div class="w3-col l4 12 texto" >
       <form action="<?php base_url('login/loguear');?>" method="POST" id="frm-login">
        <?php if($this->session->flashdata('estado') == 'activado'): ?>
          <div class="w3-col w3-margin-top" id="activado">
            <div class="w3-panel w3-pale-green w3-border" role="alert">
              <?php  echo $this->session->flashdata('info'); ?>
            </div>
          </div>
        <?php elseif($this->session->flashdata('estado')== 'activo'): ?>
          <div class="w3-col w3-margin-top" id="activo">
            <div class="w3-panel w3-pale-yellow w3-border" role="alert">
              <?php echo $this->session->flashdata('info'); ?>
            </div>
          </div>
        <?php elseif($this->session->flashdata('estado')== 'inactivo'): ?>
          <div class="w3-col w3-margin-top" id="no_existe">
            <div class="w3-panel w3-pale-red w3-border" role="alert">
              <?php echo $this->session->flashdata('info'); ?>
          </div>
        </div>
        <?php elseif($this->session->flashdata('estado')== 'esperando'): ?>
          <div class="w3-col w3-margin-top" id="no_existe">
            <div class="w3-panel w3-pale-red w3-border" role="alert">
              <?php echo $this->session->flashdata('info'); ?>
          </div>
        </div>
        <?php endif; ?>
        <div class="w3-col w3-margin-top w3-hide" id="error">
          <div class="w3-panel w3-pale-red w3-border" role="alert">
          </div>
        </div>
     <div class="w3-col w3-margin-top" id="email">
      <label> Email</label>
      <input class="w3-input w3-border" type="email" name="email" placeholder="ejemplo@ejemplo.com">
      <div class="invalido w3-text-red"><span></span></div>
    </div>
    <div class="w3-col w3-margin-top" id="password">
      <label> Contraseña</label>
      <input class="w3-input w3-border" type="password" name="password" placeholder="Contraseña">
      <div class="invalido w3-text-red"><span></span></div>
    </div>
    <span><a href="<?php echo base_url('login/cambiarContrasenia/1')?>">Olvidaste tu contrseña?</a></span>
    <div class="w3-col w3-margin-top">
      <button class="w3-button w3-block w3-theme-d2" type="submit">Ingresar</button>
    </div>
    </form>
    </div>
    
    <div class="w3-col l8 12 w3-border-left texto">

     <h3>About</h3>
      <h6>Our hotel is one of a kind. It is truely amazing. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</h6>

    </div>

  </div>

<!-- End page content -->
</div>

<!-- Footer -->
<div class=" w3-theme-d5 w3-center w3-container w3-teal w3-margin-top" >
  <h5>Blackers</h5>
  <p>Derechos recervados bla bla bla</p>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</div>
<script src="<?=base_url_assets.'assets/js/jquery.min.js' ?>"></script>
<script>
  var baseurl = "<?=base_url()?>";
</script>
<script src="<?=base_url_assets.'assets/js/login.js' ?>"></script>
<script>
  
</script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>


</html>
