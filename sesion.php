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
  <form method="post" enctype="multipart/form-data">
  <label for="user">Nombre de usuario:</label><br>
  <input type="text" id="user" name="user" value=""><br>
  <label for="passwd">Contraseña:</label><br>
  <input type="password" id="passwd" name="passwd" value=""><br><br>
  <input type="submit" value="Iniciar sesión">
  </form> <br>
  <p> ¿No tienes cuenta? <a href="./crearcuenta.php" style="color:DodgerBlue"> Registrate en Telecovid </a></p>
  <?php #comprobamos que podamos acceder a la base de datos
  $bd	=	mysqli_connect("localhost",	"root",	"");
  mysqli_select_db($bd,	"bd");
  if	(mysqli_connect_errno())	{
      echo	"Error:	"	.	mysqli_connect_error()	.	".	<br>";
      exit();
  }
  $query	=	"SELECT * FROM	personas";
  $resultado	=	mysqli_query($bd,	$query);
  if(!$resultado){
    echo	"Error:	No hay ningun elemento en la tabla	<br>";
    exit();
  }
  for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
    $fila2 = mysqli_fetch_array($resultado);
    if (($fila2['email'] === $_POST["user"])&&($fila2['passwd'] === $_POST["passwd"])){ #aqui comprobaremos que se escoge a la persona correcta a mostrar
      session_start();
      $_SESSION["user"] = $_POST["user"];
      header('Location: perfil.php');
    }
  }
  unset($_POST);
  mysqli_free_result($resultado);
  ?>
</div>

<?php
include 'footer.php';
?>

</body>
</html>
