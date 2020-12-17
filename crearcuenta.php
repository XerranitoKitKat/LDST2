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
      max-height: 215px;
      overflow: auto;
  }

  h2{
    text-align: center;
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

  $nombreErr = $apellErr = $correouvaErr = $passwdErr = $reppasswdErr = $dniErr = $fnacimientoErr = $telefonoErr = $rolErr = $checkboxErr = $userErr = "";
  $nombre = $apell = $correouva = $passwd = $reppasswd = $dni = $fnacimiento = $telefono = $rol = "";
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
    if (empty($_POST["rol"])) {
      $rolErr = "Es necesario indicar si se es profesor o alumno";
      $error=true;
    } else {
      $rol = test_input($_POST["rol"]);
    }

    if($error==false && count($_POST)<=8){/*No hay error pero no se han seleccionado asignatura*/
      $checkboxErr = "Es necesario que seleccione al menos una de las asignaturas";
      $error=true;
    }

    if(count($_POST)<10){
      $checkboxErr = "Es necesario estar matriculado en al menos una asignatura";
      $error=true;
    }
    print_r($_POST);
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
/*  if	($_POST)	{
  				echo	'<pre>';
  				echo	print_r($_POST,	true);
  				echo	'</pre>';
  }*/
    if(!$error){
      if(crearUsuario($nombre,$apell,$correouva,$passwd,$dni,$fnacimiento,$telefono,$rol,$_POST["asignaturas"])){
        $userErr = "El email introducido ya existe";
      }
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function crearUsuario($nombre,$apell,$correouva,$passwd,$dni,$fnacimiento,$telefono,$rol,$asignaturas){
    $nombre	=	addslashes($nombre);
    $apell	=	addslashes($apell);
    $correouva	=	addslashes($correouva);
    $passwd	=	addslashes($passwd);
    $dni=	addslashes($dni);
    $fnacimiento=	addslashes($fnacimiento);
    $telefono	=	addslashes($telefono);

    $db=mysqli_connect('localhost','root','','base');
    if(!$db){
      echo "Error: No se pudo conectar a la base de datos.<br>";
      exit;
    }

    if(comprobarUsuario($correouva,$db)){
      $query="INSERT INTO personas VALUES('".$correouva."', '".$nombre."', '".$apell."', '".$dni."', '".$fnacimiento."', '".$passwd."', '".$telefono."', '$rol')";
      $results=mysqli_query($db,$query);

      $query="INSERT INTO per_asig VALUES";

      foreach($asignaturas as $value){
        $aux=$query."('".$correouva."', '$value')";
        $results=mysqli_query($db,$aux);
      }
      @mysqli_free_result($results);
      mysqli_close($db);
      return false;
    }
    else{
      mysqli_close($db);
      return true;
    }

    //introducir asignaturas en la tabla de personas-asignautas

    //echo '<script>window.location.href = "./perfil.php"</script>';
  }

  function comprobarUsuario($correouva,$db){
    $query="SELECT email FROM personas";
    $results=mysqli_query($db,$query);

    foreach($results as $email){
      if(strcmp($email['email'],$correouva)==0){ //miro si ya hay un usuario registrado con esa clave primaria (email)
        @mysqli_free_result($results);
        return false;//false si lo hay
      }
    }
    @mysqli_free_result($results);
    return true;//true si no
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
    <div class="elem">
      <label for="telefono">Soy: </label>
      <input type="radio" id="profesor" name="rol" value="1">
      <label for="profesor">Profesor</label>
      <input type="radio" id="alumno" name="rol" value="2">
      <label for="alumno">Alumno</label><br>
      <span class="error"> <?php echo $rolErr;?></span>
    </div><br>
    <div class="elem" id="contenedor_asig">
    <?php
       $db=mysqli_connect('localhost','root','','base');
       if(!$db){
          echo "Error: No se pudo conectar a la base de datos.<br>";
          exit;
        }
        $query=" SELECT codigo, nombre, curso from asignaturas";
        $results=mysqli_query($db,$query);

        if (mysqli_num_rows($results)==0) {
          echo 'No se han encontrado coincidencias en su busqueda';
        }
        $cont=1;
        for ($i=0; $i < mysqli_num_rows($results) ; $i++) {
          $fila=mysqli_fetch_array($results);

          $codigo=$fila['codigo'];
          $asig=$fila['nombre'];
          $curso=$fila['curso'];

          if($curso==1){
            if($cont==1){
            echo '<i>Asignaturas de Curso 1</i><br>';
            $cont=$cont+1;
            }
            echo ' <label><input type="checkbox" name="asignaturas[]" value="'.$codigo.'">'.$asig.'</label><br>';

          }
          elseif($curso==2){
            if($cont==2){
            echo '<i>Asignaturas de Curso 2</i><br>';
            $cont=$cont+1;
            }
            echo ' <label><input type="checkbox" name="asignaturas[]" value="'.$codigo.'">'.$asig.'</label><br>';

          }
          elseif($curso==3){
            if($cont==3){
            echo '<i>Asignaturas de Curso 3</i><br>';
            $cont=$cont+1;
            }
            echo ' <label><input type="checkbox" name="asignaturas[]" value="'.$codigo.'">'.$asig.'</label><br>';

          }
          elseif($curso==4){
            if($cont==4){
            echo '<i>Asignaturas de Curso 4</i><br>';
            $cont=$cont+1;
            }
            echo ' <label><input type="checkbox" name="asignaturas[]" value="'.$codigo.'">'.$asig.'</label><br>';

          }
        }
        mysqli_free_result($results);
        mysqli_close($db);
        ?>
        </div><br>
    <span class="error"> <?php echo $checkboxErr;?></span>
    <span class="error"> <?php echo $userErr;?></span>
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
