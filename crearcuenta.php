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

  .elem {
    margin-left: 20px;
    margin-top: 2.5px;
    margin-bottom:2.5px;
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
  include 'funcion_acentos.php';

  $nombreErr = $apellErr = $correouvaErr = $passwdErr = $reppasswdErr = $dniErr = $fnacimientoErr = $telefonoErr = $rolErr = $checkboxErr = $userErr = "";
  $nombre = $apell = $correouva = $passwd = $reppasswd = $dni = $fnacimiento = $telefono = $rol = "";
  $error=false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) { //Comprobamos si se ha rellenado el campo de nombre
      $nombreErr = "El campo de Nombre es obligatorio";
      $error=true;
    } else {
      $nombre = test_input($_POST["nombre"]);
      $nombre=remove_accents($nombre);
      if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre) || strlen($nombre)>50) {  //Aseguramos que se haya introducido un nombre valido
        $nombreErr = "Solo se permiten letras y espacios en blanco. Maximo 50 caracteres";
        $error=true;
      }
    }

    if (empty($_POST["apell"])) { //Comprobamos si se ha rellenado el campo de apellidos
      $apellErr = "El campo de Apellidos es obligatorio";
      $error=true;
    } else {
      $apell = test_input($_POST["apell"]);
      $apell=remove_accents($apell); //quitamos acentos o eñes para que no haya problemas en la base de datos
      if (!preg_match("/^[a-zA-Z-' ]*$/",$apell) || strlen($apell)>100) { //Aseguramos que se haya introducido un(os) apellido(s) valido(s)
        $apellErr = "Solo se permiten letras y espacios en blanco. Maximo 100 caracteres";
        $error=true;
      }
    }

    if (empty($_POST["correouva"])) { //Comprobamos si se ha rellenado el campo de correo
      $correouvaErr = "El campo de Correo de la UVa es obligatorio";
      $error=true;
    } else {
      $correouva= test_input($_POST["correouva"]);
      if (!preg_match("/^(.+@+([a-z]+\.)?uva\.es)$/",$correouva) || strlen($correouva)>100) { //Comprobamos que el correo introducido pertenezca a la uva
        $correouvaErr = "Formato de correo invalido, debe pertenecer a la uva";
        $error=true;
      }
    }

    if (empty($_POST["passwd"])) { //Comprobamos si se ha rellenado el campo de contrasena
      $passwdErr = "El campo de Cotrase&ntildea es obligatorio";
      $error=true;
    } else {
      $passwd = test_input($_POST["passwd"]);
      $passwd=remove_accents($passwd);
      if(!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/",$passwd) || strlen($correouva)>50) { //Comprobamos que la contrasena introducida siga unos criterios
        $passwdErr= "La contrase&ntildea tiene que tener como	mínimo 8	caracteres cualesquiera y al menos tiene que contener una mayuscula, una minuscula y un numero";
        $error=true;
      }
    }

    if (empty($_POST["reppasswd"])) { //Comprobamos si se ha rellenado el campo de repetir contrasena
      $reppasswdErr = "El campo de Repetir Contrase&ntildea es obligatorio";
      $error=true;
    } else {
      $reppasswd = test_input($_POST["reppasswd"]);
      $reppasswd=remove_accents($reppasswd);
      if($error==false) { //En caso de que no haya errores comprobamos que las contrasenas coincidan
        if($reppasswd != $passwd) {
          $reppasswdErr= "Las contrase&ntildeas no coinciden";
          $error=true;
        }
      }
    }

   if (empty($_POST["dni"])) { //Comprobamos si se ha rellenado el campo de dni
      $dniErr = "El campo de DNI o NIE es obligatorio";
      $error=true;
    } else {
      $dni = test_input($_POST["dni"]);
      if (!(preg_match("/^[0-9]{8}[a-zA-Z]{1}$/",$dni) || preg_match("/^[a-zA-Z]{1}[0-9]{7}[a-zA-Z]{1}$/", $dni))){ //Comprobamos que el dni/nie introducido tenga formato de dni o de nie
        $dniErr = "El valor introducido no coincide con el formato de un DNI o NIE";
        $error=true;
      }
    }

    if (empty($_POST["fnacimiento"])) { //Comprobamos si se ha rellenado el campo de fecha de nacimiento
      $fnacimientoErr = "El campo de Fecha de nacimiento es obligatorio";
      $error=true;
    } else {
      $fnacimiento = test_input($_POST["fnacimiento"]);
    }

    if (empty($_POST["telefono"])) { //Comprobamos si se ha rellenado el campo de telefono
      $telefonoErr = "El campo de Telefono es obligatorio";
      $error=true;
    } else {
      $telefono = test_input($_POST["telefono"]);
      if (!preg_match("/^[6-9]{1}[0-9]{8}/",$telefono)) { //Comprobamos que el telefono introducido corresponda a un telefono real
        $telefonoErr = "El valor introducido no pertenece a un numero de telefono";
        $error=true;
      }
    }

    if (empty($_POST["rol"])) { //Comprobamos si se ha seleccionado Profesor o Alumno
      $rolErr = "Es necesario indicar si se es profesor o alumno";
      $error=true;
    } else {
      $rol = test_input($_POST["rol"]);
    }

    if(count($_POST)<10){ //Comprobamos que se haya seleccionado al menos una asignatura (considerando que se han rellenado el resto de campos)
      $checkboxErr = "Es necesario estar matriculado en al menos una asignatura";
      $error=true;
    }

      if(!$error){ //Si no hay errores procedemos a introducir los datos introducidos en la base de datos
        print_r($_POST);
      if(crearUsuario($nombre,$apell,$correouva,$passwd,$dni,$fnacimiento,$telefono,$rol,$_POST["asignaturas"])){ //Si el correo introducido ya existe en la base de datos mostramos un error
        $userErr = "El email introducido ya existe";
      }
      else {
        echo '<script>window.location.href = "./sesion.php"</script>'; //Si la creacion de datos es exitosa redireccionamos a la ventana de iniciar sesion
      }
    }
  }

  function test_input($data) { //esta funcion se encarga de procesar los datos de entrada para meterlos en la base de datos
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function crearUsuario($nombre,$apell,$correouva,$passwd,$dni,$fnacimiento,$telefono,$rol,$asignaturas){ //funcion para creacion de usuario
    $nombre	=	addslashes($nombre);
    $apell	=	addslashes($apell);
    $correouva	=	addslashes($correouva);
    $passwd	=	addslashes($passwd);
    $dni=	addslashes($dni);
    $fnacimiento=	addslashes($fnacimiento);
    $telefono	=	addslashes($telefono);

    $db=mysqli_connect('localhost','root','','bd');
    if(!$db){
      echo "Error: No se pudo conectar a la base de datos.<br>";
      exit;
    }

    if(comprobarUsuario($correouva,$db)){  //si no hay nadie en las base de datos con ese correo (clave primaria) procedemos a introducir los datos en las tablas
      $query="INSERT INTO personas VALUES('".$correouva."', '".$nombre."', '".$apell."', '".$dni."', '".$fnacimiento."', '".$passwd."', '".$telefono."', '$rol')";
      $result=mysqli_query($db,$query);

      $query="INSERT INTO per_asig VALUES";

      foreach($asignaturas as $value){
        $aux=$query."('".$correouva."', ".$value.")";
        $result=mysqli_query($db,$aux);
        if($_POST["rol"]==2){ //si es alumno, incrementar el numero de n_matriculados
          $query2	=	"UPDATE	asignaturas SET n_matriculados=n_matriculados+1 WHERE codigo = ".$value;
          $result=mysqli_query($db,$query2);
        }
      }
      mysqli_close($db);
      return false;
    }
    else{
      mysqli_close($db);
      return true;
    }


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
    <?php //logica para mostrar las asignaturas a matricular a partir de la base de datos
       $db=mysqli_connect('localhost','root','','bd');
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
