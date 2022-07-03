<!DOCTYPE html>
<html>
<head>
<title>Panel de Control | CTPSFPC</title>
<base href="<?php echo current_url(); ?>"/>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/sistema/assets/css/login.css">
<link rel="stylesheet" href="/sistema/assets/css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="login-page">
  <div class="top-div">
    <!--
    <div class="header">
      <div class="row">
        <div class="col-lg-5 col-xs-12 logo">
          <img src="/admin/resources/images/logo-login.png" alt="Auven">
        </div>
        <div class="col-lg-7 col-xs-12">
          <div class="linea-2">
            <div class="dtc">
              <span>¿Todavía no tenes cuenta en Auven?</span>          
            </div>
            <div class="dtc vat">
              <a href="login/registro/" class="button-registrate">REGISTRATE GRATIS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    -->
    <div class="form-top">
      <h1><img style="width: 50%;" src="/sistema/assets/img/traductores.png"></h1>
    </div>
  </div>
  <div class="bot-div">
    <div class="form-bot container">
      <form onsubmit="return enviar()">
        <label for="email">Correo electrónico</label><br>
        <input type="text" id="email" value="<?php echo isset($_GET["email"]) ? $_GET["email"] : "" ?>" placeholder="Ingresa tu email"><br>

        <label for="password">Contraseña</label><br>
        <input type="password" id="password" placeholder="Ingresa tu contraseña"><br>

        <input type="submit" class="button-submit" value="Ingresar"><br>
      </form>
    </div>
  </div>

    <script src="/sistema/assets/js/jquery.js"></script>
    <script src="/sistema/assets/js/jquery-ui.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
  $("#nombre").focus();
  $(".input").keypress(function(e){
    if (e.keyCode == 13) enviar();
  });
});
var flag = 0;
function enviar() {

  var email = $("#email").val();
  var password = $("#password").val();

  if (email == "") {
    alert ("Por favor ingrese su email");
    return false;
  }

  if (password == "") {
    alert ("Por favor ingrese su contraseña");
    return false;
  }

  password = unescape(password); // Problema con passwords que contenian $ 
 

  console.log("flag");

  if (flag == 1) return;
  flag = 1;
  console.log("llega");
  $.ajax({
    url: '/sistema/welcome/check',
    type: 'POST',
    dataType: 'json',
    data: {nombre: email, 'password': password },
    success: function(data, textStatus, xhr) {
      flag = 0;
      if (data.error == 1) {
        alert (data.mensaje);
        return false;
      } else if (data.error == 0) {
        location.href = "/sistema/entradas/listado/";
      }
    },
  });
  return false;
}
</script>

</body>
</html>