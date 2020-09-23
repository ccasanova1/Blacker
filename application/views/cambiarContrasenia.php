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
    <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-mobile w3-hide-small w3-padding-large w3-hover-white">Login</a>
    <a href="<?php echo base_url('login/registrar') ?>" class="w3-bar-item w3-button w3-mobile w3-hide-small w3-padding-large w3-hover-white">Registrate</a>
</div>
<!-- Header -->


<!-- Page content -->
<div class="w3-content" style="max-width:1200px; height: 100%">

 	<div class="w3-container w3-margin-top w3-center" id="registro">
    <h2>Cambiar contraseña</h2>
  </div>
  

  <div class="w3-row-padding " id="about">
  	<?php if(!empty($estado)): ?>
      <div class="w3-col l4 12 texto" >
         <form method="POST" id="frm-cambioContraseña">
          <div class="w3-col w3-margin-top w3-hide" id="error">
            <div class="w3-panel w3-pale-red w3-border" role="alert">
            </div>
          </div>
      <div class="w3-col w3-margin-top" id="password">
        <label> Contraseña</label>
        <input class="w3-input w3-border" type="password" name="password" placeholder="Contraseña">
        <div class="invalido w3-text-red"><span></span></div>
      </div>
       <div class="w3-col w3-margin-top" id="rep_password">
        <label> Confirmar Contraseña</label>
        <input class="w3-input w3-border" type="password" name="rep_password" placeholder="Confirme contraseña">
        <div class="invalido w3-text-red"><span></span></div>
      </div>
      <div class="w3-col w3-margin-top">
        <button class="w3-button w3-block w3-theme-d2" type="submit">Confirmar</button>
      </div>
      </form>
      </div>
    <?php else: ?>
        <div class="w3-col l4 12 texto" >
         <form method="POST" id="frm-cambioContraseña">
          <div class="w3-col w3-margin-top w3-hide" id="error">
            <div class="w3-panel w3-pale-red w3-border" role="alert">
            </div>
          </div>
        <div class="w3-col w3-margin-top" id="email">
        <label> Ingrese un Email</label>
        <input class="w3-input w3-border" type="email" name="email" placeholder="ejemplo@ejemplo.com">
        <div class="invalido w3-text-red"><span></span></div>
        </div>
      <div class="w3-col w3-margin-top">
        <button class="w3-button w3-block w3-theme-d2" type="submit">Confirmar</button>
      </div>
      </form>
      </div>
    <?php endif; ?>

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
<script>
<?php if(!empty($estado)): ?>
  $(document).ready(function(){
    $("#frm-cambioContraseña").submit(function(ev){
      $.ajax({
        url: baseurl+'login/cambiarContraseniaSet',
        type: 'POST',
        data: $(this).serialize(),
        success: function(){
          window.location.replace(baseurl);
        },
        error: function(xhr){
          $("#error > div").html('');
          $("#rep_password > div").html('');
          $("#password > div").html('');
          $("#rep_password > input").removeClass('w3-border-red');
          $("#password > input").removeClass('w3-border-red');
          $("#error").addClass('w3-hide');
          if(xhr.status == 400){
            var json = JSON.parse(xhr.responseText);
            if (json.rep_password.length != 0){
              $("#rep_password > div").html(json.email);
              $("#rep_password > input").addClass('w3-border-red');
            }
            if (json.password.length != 0){
              $("#password > div").html(json.password);
              $("#password > input").addClass('w3-border-red');
            }
          }else if(xhr.status == 401){
            var json = JSON.parse(xhr.responseText);
            $("#error").removeClass('w3-hide');
            $("#error > div").html(json.msg);
          }
        }
      });
      ev.preventDefault();
    })
  })
<?php else: ?>
  $(document).ready(function(){
    $("#frm-cambioContraseña").submit(function(ev){
      $.ajax({
        url: baseurl+'login/cambiarContraseniaGet',
        type: 'POST',
        data: $(this).serialize(),
        success: function(){
          window.location.replace(baseurl);
        },
        error: function(xhr){;
          $("#error > div").html('');
          $("#email > div").html('');
          $("#email > input").removeClass('w3-border-red');
          $("#error").addClass('w3-hide');
          if(xhr.status == 400){
            var json = JSON.parse(xhr.responseText);
            if (json.email.length != 0){
              $("#email > div").html(json.email);
              $("#email > input").addClass('w3-border-red');
            }
          }else if(xhr.status == 401){
            var json = JSON.parse(xhr.responseText);
            $("#error").removeClass('w3-hide');
            $("#error > div").html(json.msg);
          }
        }
      });
      ev.preventDefault();
    })
  })
  <?php endif; ?>
</script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>


</html>
