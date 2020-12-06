<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registro</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <style>

  #formulario{
      background-color: white;
      font-family: sans-serif;
      font-size: 16px;
      padding: 40px;
      padding-top: 25px;
      margin: 30px 30%;
      border: 2px outset black;
      min-width:200px;
  }

  #contenedor_asig{
      margin-left: 35px;
  }

  h2{
    text-align: center;
  }
  .contenedor{
  display: none;
  }

  .elem {
    margin-left: 20px;
    margin-top: 2.5px;
    margin-bottom:2.5px;
  }
  input {
  padding:2px;
  font-size: 14px;
  font-family: sans-serif;
  border: 1px solid #aaaaaa;
}
  select {
    margin-top:10px;
    margin-bottom:10px;
    font-size: 14px;
    font-family: sans-serif;
  }

 .error {
   color: #FF0000;
   font-size: 13px;
   font-family: sans-serif;
 }

  </style>
</head>

<script src="./scripts/pasarPaginaCuenta.js"></script>
<script src="./scripts/asignaturasCurso.js" defer></script>

<body onload="mostrarTab(0)">
  <?php
  include 'cabecera.php';

$nombreErr = $apellErr = $correouvaErr = $passwdErr = $reppasswdErr = $dniErr = $fnacimientoErr = $telefonoErr = $checkboxErr = "";
$nombre = $apell = $correouva = $passwd = $reppasswd = $dni = $fnacimiento = $telefono = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["nombre"])) {
    $nombreErr = "El campo de Nombre es obligatorio";
  } else {
    $nombre = test_input($_POST["nombre"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre)) {
      $nombreErr = "Solo se permiten letras y espacios en blanco";
    }
  }

  if (empty($_POST["apell"])) {
    $apellErr = "El campo de Apellidos es obligatorio";
  } else {
    $apell = test_input($_POST["apell"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$apell)) {
      $apellErr = "Solo se permiten letras y espacios en blanco";
    }
  }

  if (empty($_POST["correouva"])) {
    $correouvaErr = "El campo de Correo de la UVa es obligatorio";
  } else {
    $correouva= test_input($_POST["email"]);
    if (!filter_var($correouva, FILTER_VALIDATE_EMAIL)) {
      $correouvaErr = "Formato de correo invalido";
    }
  }

    if (empty($_POST["passwd"])) {
      $passwdErr = "El campo de Cotrase&ntildea es obligatorio";
    } else {
      $passwd = test_input($_POST["passwd"]);
      if( strlen($passwd ) < 8 ) {
      $passwdErr= "La contrase&ntildea es muy corta (al menos 8 caracteres)";
      }
    }

    if (empty($_POST["reppasswd"])) {
      $reppasswdErr = "El campo de Repetir Contrase&ntildea es obligatorio";
    } else {
      $reppasswd = test_input($_POST["reppasswd"]);
      if( strlen($passwd ) > 7 ) {
      if($reppasswd != $passwd) {
      $reppasswdErr= "Las contrase&ntildeas no coinciden";
       }
      }
    }

    if (empty($_POST["dni"])) {
      $dniErr = "El campo de DNI o NIE es obligatorio";
    } else {
      $dni = test_input($_POST["dni"]);
      if (preg_match("/^[0-9]{8}[a-zA-Z]{1}$/",$dni)) {}
      elseif (preg_match("/^[a-zA-Z]{1}[0-9]{7}[a-zA-Z]{1}$/", $dni)){}
      else {
        $dniErr = "El valor introducido no coincide con el formato de un DNI o NIE";
      }
    }

      if (empty($_POST["fnacimiento"])) {
        $fnacimientoErr = "El campo de Fecha de nacimiento es obligatorio";
      } else {
        $fnacimiento = test_input($_POST["fnacimiento"]);
      /*  if (!preg_match("/([0-9]{4})\/([0-9]{2})\/([0-9]{2})/i",$fnacimiento)) {
          $fnacimientoErr = "El formato introducido no es el correcto (YYYY-MM-DD)";
      }*/
    }

      if (empty($_POST["telefono"])) {
        $telefonoErr = "El campo de Telefono es obligatorio";
      } else {
        $telefono = test_input($_POST["telefono"]);
        if (!preg_match("/^[6-9]{1}[0-9]{8}/",$telefono)) {
          $telefonoErr = "El valor introducido no pertenece a un numero de telefono";
        }
      }

      $opcionSeleccionada = $_POST['curso'];
      if($opcionSeleccionada==''){
        $checkboxErr = "Tiene que cursarse al menos una asignatura";
      }


/*  $isOneSelected=false;
  $checkboxArray = $_POST['checkbox'];
  foreach($checkboxArray as $checkbox){
   if(isset($checkbox)){
    $isOneSelected = true;
   }
  }
  if($isOneSelected==false){
    $checkboxErr = "Es necesario que curse al menos una de las asignaturas";
  }*/


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  ?>

  <form id="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
  <h2>Introduzca los datos</h2>
  <div class="contenedor">
    <div class="elem">
    <label for="nombre">Nombre </label><br>
    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>"><br>
        <span class="error"> <?php echo $nombreErr;?></span><br>
    </div>
    <div class="elem">
    <label for="apell">Apellidos </label><br>
    <input type="text" id="apell" name="apell" value="<?php echo $apell;?>"><br>
    <span class="error"> <?php echo $apellErr;?></span><br>
    </div>
     <div class="elem">
     <label for="correouva">Correo de la UVA </label><br>
     <input type="text" id="correouva" name="correouva"  value="<?php echo $correouva;?>"><br>
     <span class="error"> <?php echo $correouvaErr;?></span><br>
      </div>
      <div class="elem">
      <label for="passwd">Contrase&ntildea </label><br>
      <input type="password" id="passwd" name="passwd"><br>
      <span class="error"> <?php echo $passwdErr;?></span><br>
      </div>
      <div class="elem">
      <label for="reppasswd">Repetir Contrase&ntildea </label><br>
      <input type="password" id="reppasswd" name="reppasswd"><br>
      <span class="error"> <?php echo $reppasswdErr;?></span><br>
      </div>
      <div class="elem">
      <label for="dni">DNI o NIE </label><br>
      <input type="text" id="dni" name="dni" value="<?php echo $dni;?>"><br>
      <span class="error"> <?php echo $dniErr;?></span><br>
      </div>
      <div class="elem">
      <label for="fnacimiento">Fecha de nacimiento </label><br>
      <input type="date" id="fnacimiento" name="fnacimiento" value="<?php echo $fnacimiento;?>" min="1900-01-01" max="2021-01-01">
      <span class="error"> <?php echo $fnacimientoErr;?></span><br>
    </div><br>
      <div class="elem">
      <label for="telefono">Numero de telefono </label><br>
      <input type="text" id="telefono" name="telefono" value="<?php echo $telefono;?>"><br>
      <span class="error"> <?php echo $telefonoErr;?></span>
    </div>
      <div class="elem">
      <label for="curso">Curso </label>
      <select id="curso" name="curso" onchange="mostrarAsignaturas(this);">
     		  <option value="" selected> </option>
          <option value="1">1º</option>
          <option value="2">2º</option>
          <option value="3">3º</option>
          <option value="4">4º</option>
      </select>
      </div>
      <div class="elem" id="contenedor_asig"></div><br>
      <span class="error"> <?php echo $checkboxErr;?></span>
  </div><br>
  <div id="botonpeq" style="float:right;">
    <button type="submit" form="formulario" value="crear" style="font-family:sans-serif;font-size:14px;">Crear Cuenta</button>
  </div>
</form>
<?php
include 'footer.php';
?>
</body>
</html>
