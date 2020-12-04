<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Inicio Sesion</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">

  <style>
  .formulario {

	text-align: center;
  font-family: sans-serif;
  font-size: 15px;
 	border: 2px outset black;
  background-color: white;
  padding: 40px;
	margin: 30px auto;
  width: 320px;
  height: 400px;
  margin: 100px auto;
	}
</style>
</head>

<body>
  <?php
  include 'cabecera.php';
  ?>


<div class="formulario">
  <form>
  <label for="user">Nombre de usuario:</label><br>
  <input type="text" id="user" name="user"><br>
  <label for="passwd">Contraseña:</label><br>
  <input type="password" id="passwd" name="passwd"><br><br>
  <label><input type="checkbox" name="recordar">Recordarme</label><br><br>
  <input type="submit" value="Iniciar sesión">
  </form> <br>
  <p> ¿No tienes cuenta? <a href="./crearcuenta.php" style="color:DodgerBlue"> Registrate en Telecovid </a></p>
</div>

<?php
include 'footer.php';
?>

</body>
</html>
