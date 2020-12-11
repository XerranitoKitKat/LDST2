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
      max-height: 230px;
      overflow: auto;
  }

  h2{
    text-align: center;
  }
  .contenedor{

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

<script src="./scripts/formularios.js" defer></script>

<body>
<?php
  include 'cabecera.php';

  $nombreErr = $apellErr = $correouvaErr = $passwdErr = $reppasswdErr = $dniErr = $fnacimientoErr = $telefonoErr = $checkboxErr = "";
  $nombre = $apell = $correouva = $passwd = $reppasswd = $dni = $fnacimiento = $telefono = "";
  $error=false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
      $nombreErr = "El campo de Nombre es obligatorio";
      $error=true;
    } else {
      $nombre = test_input($_POST["nombre"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre)) {
        $nombreErr = "Solo se permiten letras y espacios en blanco";
        $error=true;
      }
    }

    if (empty($_POST["apell"])) {
      $apellErr = "El campo de Apellidos es obligatorio";
      $error=true;
    } else {
      $apell = test_input($_POST["apell"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/",$apell)) {
        $apellErr = "Solo se permiten letras y espacios en blanco";
        $error=true;
      }
    }

    if (empty($_POST["correouva"])) {
      $correouvaErr = "El campo de Correo de la UVa es obligatorio";
      $error=true;
    } else {
      $correouva= test_input($_POST["correouva"]);
      if (!preg_match("/^(.+@+([a-z]+\.)?uva\.es)$/",$correouva)) {
        $correouvaErr = "Formato de correo invalido";
        $error=true;
      }
    }

    if (empty($_POST["passwd"])) {
      $passwdErr = "El campo de Cotrase&ntildea es obligatorio";
      $error=true;
    } else {
      $passwd = test_input($_POST["passwd"]);
      if( strlen($passwd ) < 8 ) {
        $passwdErr= "La contrase&ntildea es muy corta (al menos 8 caracteres)";
        $error=true;
      }
    }

    if (empty($_POST["reppasswd"])) {
      $reppasswdErr = "El campo de Repetir Contrase&ntildea es obligatorio";
      $error=true;
    } else {
      $reppasswd = test_input($_POST["reppasswd"]);
      if( strlen($passwd ) > 7 ) {
        if($reppasswd != $passwd) {
          $reppasswdErr= "Las contrase&ntildeas no coinciden";
          $error=true;
        }
      }
    }

   if (empty($_POST["dni"])) {
      $dniErr = "El campo de DNI o NIE es obligatorio";
      $error=true;
    } else {
      $dni = test_input($_POST["dni"]);
      if (!(preg_match("/^[0-9]{8}[a-zA-Z]{1}$/",$dni) || preg_match("/^[a-zA-Z]{1}[0-9]{7}[a-zA-Z]{1}$/", $dni))){
        $dniErr = "El valor introducido no coincide con el formato de un DNI o NIE";
        $error=true;
      }
    }

    if (empty($_POST["fnacimiento"])) {
      $fnacimientoErr = "El campo de Fecha de nacimiento es obligatorio";
      $error=true;
    } else {
      $fnacimiento = test_input($_POST["fnacimiento"]);
      /*  if (!preg_match("/([0-9]{4})\/([0-9]{2})\/([0-9]{2})/i",$fnacimiento)) {
      $fnacimientoErr = "El formato introducido no es el correcto (YYYY-MM-DD)";
      }*/
    }

    if (empty($_POST["telefono"])) {
      $telefonoErr = "El campo de Telefono es obligatorio";
      $error=true;
    } else {
      $telefono = test_input($_POST["telefono"]);
      if (!preg_match("/^[6-9]{1}[0-9]{8}/",$telefono)) {
        $telefonoErr = "El valor introducido no pertenece a un numero de telefono";
        $error=true;
      }
    }

    /*$opcionSeleccionada = $_POST['curso'];
    if($opcionSeleccionada==''){
      $checkboxErr = "Tiene que cursarse al menos una asignatura";
      $error=true;
    }*/

    if($error==false && count($_POST)<=8){/*No hay error pero no se han seleccionado asignatura*/
      $checkboxErr = "Es necesario que seleccione al menos una de las asignaturas";
      $error=true;
    }
    /*$isOneSelected=false;
    $checkboxArray = $_POST;
    echo print_r(checkbox);

      foreach($checkboxArray as $checkbox){
      if(isset($checkbox)){
      $isOneSelected = true;
    }
  }
  if($isOneSelected==false){
  $checkboxErr = "Es necesario que curse al menos una de las asignaturas";
  }*/
  redireccion($error);
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function redireccion($error){
    if($error==false){

      echo '<script>window.location.href = "./perfil.php"</script>';
    }

  }
?>

<form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
    </div><br>
    <div class="elem" id="contenedor_asig">
      <i>Asignaturas de Curso 1</i><br>
      <label><input type="checkbox" name="Algebra Lineal">Algebra Lineal</label><br>
      <label><input type="checkbox" name="Calculo">Calculo</label><br>
      <label><input type="checkbox" name="Circuitos electricos">Circuitos electricos</label><br>
      <label><input type="checkbox" name="Programacion">Programacion</label><br>
      <label><input type="checkbox" name="Economia">Economia</label><br>
      <label><input type="checkbox" name="Fundamentos de Electronica">Fundamentos de Electronica</label><br>
      <label><input type="checkbox" name="Senales Aleatorias y Ruido">Señales Aleatorias y Ruido</label><br>
      <label><input type="checkbox" name="Sistemas Lineales">Sistemas Lineales</label><br>
      <label><input type="checkbox" name="Fisica">Fisica</label><br>
      <label><input type="checkbox" name="Fundamentos de Ordenadores y Sistemas Operativos">Fundamentos de Ordenadores y Sistemas Operativos</label><br><br>

      <i>Asignaturas de Curso 2</i><br>
      <label><input type="checkbox" name="Ampliacion de Matematicas">Ampliacion de Matematicas</label><br>
      <label><input type="checkbox" name="Teoria de la Comunicacion">Teoria de la Comunicacion</label><br>
      <label><input type="checkbox" name="Circuitos Electronicos Analogicos">Circuitos Electronicos Analogicos</label><br>
      <label><input type="checkbox" name="Circuitos Electronicos Digitales">Circuitos Electronicos Digitales</label><br>
      <label><input type="checkbox" name="Arquitectura de Redes, Sistemas y Servicios">Arquitectura de Redes, Sistemas y Servicios</label><br>
      <label><input type="checkbox" name="Campos Electromagneticos">Campos Electromagneticos</label><br>
      <label><input type="checkbox" name="Sistemas de Comunicacion">Sistemas de Comunicacion</label><br>
      <label><input type="checkbox" name="Ingenieria de Sistemas Software">Ingenieria de Sistemas Software</label><br>
      <label><input type="checkbox" name="Redes y Servicios Telematicos">Redes y Servicios Telematicos</label><br>
      <label><input type="checkbox" name="Sistemas Electronicos Basados en Microprocesador">Sistemas Electronicos Basados en Microprocesador</label><br><br>

      <i>Asignaturas de Curso 3</i><br>
      <label><input type="checkbox" name="Teoria de Campos Guiados">Teoria de Campos Guiados</label><br>
      <label><input type="checkbox" name="Ingenieria de Protocolos en Redes Telematicas">Ingenieria de Protocolos en Redes Telematicas</label><br>
      <label><input type="checkbox" name="Desarrollo de Aplicaciones Distribuidas">Desarrollo de Aplicaciones Distribuidas</label><br>
      <label><input type="checkbox" name="Subsistemas Electronicos de Comunicaciones">Subsistemas Electronicos de Comunicaciones</label><br>
      <label><input type="checkbox" name="Fundamentos de Transmision por radio">Fundamentos de Transmision por radio</label><br>
      <label><input type="checkbox" name="Tratamiento Digital de la Senal">Tratamiento Digital de la Señal</label><br>
      <label><input type="checkbox" name="Sistemas de Comunicaciones Guiadas">Sistemas de Comunicaciones Guiadas</label><br>
      <label><input type="checkbox" name="Microelectronica de Radio Frecuencia">Microelectronica de Radio Frecuencia</label><br>
      <label><input type="checkbox" name="Diseneo de Circuitos Digitales para Comunicaciones">Diseño de Circuitos Digitales para Comunicaciones</label><br>
      <label><input type="checkbox" name="Administracion y Gestion de Redes y Servicios Telematicos">Administracion y Gestion de Redes y Servicios Telematicos</label><br><br>

      <i>Asignaturas de Curso 4</i><br>
      <label><input type="checkbox" name="Metodos Numericos en Telecomunicacion">Metodos Numericos en Telecomunicacion</label><br>
      <label><input type="checkbox" name="Instrumentacion y Equipos Electronicos">Instrumentacion y Equipos Electronicos</label><br>
      <label><input type="checkbox" name="Fundamentos de Sonido e Imagen">Fundamentos de Sonido e Imagen</label><br>
      <label><input type="checkbox" name="Diseno de Circuitos Integrados para Comunicaciones">Diseño de Circuitos Integrados para Comunicaciones</label><br>
      <label><input type="checkbox" name="Laboratorio de Desarrollo de Sistemas Telematicos">Laboratorio de Desarrollo de Sistemas Telematicos</label><br>
      <label><input type="checkbox" name="Ingenieria de Trafico en Redes Telematicas">Ingenieria de Trafico en Redes Telematicas</label><br>
      <label><input type="checkbox" name="Teoria de la Deteccion y la Estimacion">Teoria de la Deteccion y la Estimacion</label><br>
      <label><input type="checkbox" name="Sistemas de Comunicaciones Opticas">Sistemas de Comunicaciones Opticas</label><br>
      <label><input type="checkbox" name="Sistemas de Telecomunicación por Radio">Sistemas de Telecomunicación por Radio</label><br>
      <label><input type="checkbox" name="Desarrollo Practico de Sistemas Electronicos">Desarrollo Practico de Sistemas Electronicos</label><br><br>
    </div><br>
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
