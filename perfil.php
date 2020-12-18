<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Perfil</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <style>
  .contenedorPrincipal {
    display: flex;
    justify-content: center;
    text-align: center;
    align-content: center;
    font-family: sans-serif;
    font-size: 15px;
    border: 2px outset black;
    background-color:rgb(240, 240, 240);
    padding: 40px;
    margin: 30px auto;
    width: 60%;
    height: auto;
    margin: 100px auto;
  }
  </style>
</head>
<body>
  <?php
  include 'cabecera.php';
  ?>
  <div class = "contenedorPrincipal">
    <?php #comprobamos que podamos acceder a la base de datos
    #session_start();
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
      if ($fila2['email'] === $_SESSION["user"]){ #aqui comprobaremos que se escoge a la persona correcta
        $fila = $fila2;                               #a mostrar
      }
    }
    mysqli_free_result($resultado);
    ?>
    Bienvenido <?php #incluir aqui la lista de cosas de las personas. Aqui en particular el nombre
    echo "".$fila['nombre']." ".$fila['apellidos']."";
    ?></br></br></br>
    Tus datos personales son:</br>
    Correo electronico de la UVa: <?php
    echo "".$fila['email']."";
    ?></br>
    Fecha de nacimiento: <?php
    echo "".$fila['f_nacimiento']."";
    ?></br>
    Número de telefono: <?php
    echo "".$fila['n_telefono']."";
    unset($fila2);
    ?></br>
  </div>
  <div class="contenedorPrincipal">
    <?php
    $query	=	"SELECT * FROM	per_asig";
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){
      echo	"Error:	en la base de datos, no tiene ninguna asignatura	<br>";
      exit();
    }
    $arrayAsig[0] = NULL;
    $contador = 0;
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila2 = mysqli_fetch_array($resultado);
      if($fila2['email'] == $fila['email']){
        $arrayAsig[$contador] = $fila2['codigo']; #añade una entrada mas cada vez que entra en el if
        $contador++;
      }
    }
    unset($contador);
    if($arrayAsig == NULL){
      echo	"No tiene ninguna asignatura	<br>";
      exit();
    }
    mysqli_free_result($resultado);
    $query	=	"SELECT * FROM	asignaturas";
    $resultado	=	mysqli_query($bd,	$query);
    echo "Las asiganturas a las que usted esta matriculado son las siguientes: </br></br>";
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila = mysqli_fetch_array($resultado);
      for($k = 0; $k<count($arrayAsig);$k++){
        if($fila['codigo'] == $arrayAsig[$k]){
          echo "".$fila['codigo']." ".$fila['nombre']."</br>";
        }
      }
    }
    if($fila2 == NULL){
      echo	"No tiene ninguna asignatura	<br>";
      exit();
    }
    unset($fila,$fila2);
    ?>
  </div>
  <div class="contenedorPrincipal">
    <?php #primero comprobaremos que no este ya confinado, luego listaremos las fechas en un calendario
    $query	=	"SELECT * FROM	test";
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){
      echo	"Error con la base de datos";
      exit();
    }
    $id = 0;
    $fila2 = NULL;
    for($i = 0; $i < mysqli_num_rows($resultado); $i++){
        $fila = mysqli_fetch_array($resultado); #aqui cojo la ultima entrada de la base de datos de una misma persona (por si ha estado mas de una vez confinado)
        if(($id < $fila['id'])&&($fila['email']== $_SESSION["user"])){
          $id = $fila['id'];
        }
        if(($id = $fila['id'])&&($fila['email']== $_SESSION["user"])){
          $fila2 = $fila;# AQUI TENDRE QUE MOSTRAR EL HISTORIAL
        }
    }
    if($fila2 != 0){
      mysqli_free_result($resultado);
      $fecha_actual = getdate(time()); #OJO, MIRAR LO DE LAS FECHAS, PARA COGERLAS BIEN
      $fecha_actual_day = $fecha_actual['mday'];
      $fecha_actual_mon = $fecha_actual['mon'];
      $fecha_actual_year = $fecha_actual['year'];
      $desconf = explode("-",$fila2['f_descon']);

      if(($fila2 == NULL)||($desconf[0] < $fecha_actual_year)||(($desconf[1] < $fecha_actual_mon)&&($desconf[0] == $fecha_actual_year))||(($desconf[2] < $fecha_actual_day)&&($desconf[0] == $fecha_actual_year)&&($desconf[1] == $fecha_actual_mon))){ #Esto indica que no esta confinado, o que no ha estado confinado en ningun momento
        if(($fila2 != NULL)&&($fila2['comentario']==NULL)){
          #ESTO PARA METER UN COMENTARIO QUE ME AYUDA MARIA A HACER EL CUADRO DEL TEXTO
        }
        echo '<form method = "post">
        <input type = "radio" name="pcr" value="Indicar positivo en COVID">Indicar positivo en COVID
        <input type = "Radio" name="pcr" value="Mostrar historial">Mostrar historial<br>
        <input type = "submit" value="Enviar"></form>';
        if($_POST["pcr"] === "Indicar positivo en COVID"){
          $pcr1=date("Y-n-j");
          $pcr2=date("Y-n-j", strtotime($pcr1."+ 10 days"));
          $des=date("Y-n-j", strtotime($pcr1."+ 15 days"));
          $user = "user";
          $query	=	"INSERT INTO test(email, f_test1, f_test2, f_descon) VALUES ('".$_SESSION[$user]."','".$pcr1."','".$pcr2."','".$des."')";
          $resultado	=	mysqli_query($bd,	$query);
        }
        else if($_POST["pcr"] === "Mostrar historial"){
          $query	=	"SELECT * FROM	test";
          $resultado	=	mysqli_query($bd,	$query);
          $id = 0;
          for($i = 0; $i < mysqli_num_rows($resultado); $i++){
              $fila = mysqli_fetch_array($resultado); #aqui cojo la ultima entrada de la base de datos de una misma persona (por si ha estado mas de una vez confinado)
              if(($id < $fila['id'])&&($fila['email']==$_SESSION["user"])){
                $id = $fila['id'];
              }
              if(($id = $fila['id'])&&($fila['email']==$_SESSION["user"])){
                $fila2 = $fila;# AQUI TENDRE QUE MOSTRAR EL HISTORIAL
                $desconf = explode("-",$fila2['f_descon']);
            		$segundaPCR = explode("-",$fila2['f_test2']);
            		$primeraPCR = explode("-",$fila2['f_test1']);
                $a = $desconf[2]; #pongo las variables asi, porque las utilizao como super globales
                $b = $segundaPCR[2]; #y me estaba dando problemas usar los arrays!
                $c = $primeraPCR[2];
                include 'calendario.php';
              }
          }
          mysqli_free_result($resultado);
          if($id == 0){echo'No tenemos constancia de que haya estado confinado';}
        }
      }
      else{ #OJO COMPROBAR QUE COJO BIEN LAS FECHAS, O SI LAS COJO!  ADEMAS DE HACERLAS GLOBALES PARA MOSTRARLAS EN EL CALENDARIO
        $desconf = explode("-",$fila2['f_descon']);
        $segundaPCR = explode("-",$fila2['f_test2']);
        $primeraPCR = explode("-",$fila2['f_test1']);
        $a = $desconf[2]; #pongo las variables asi, porque las utilizao como super globales
        $b = $segundaPCR[2]; #y me estaba dando problemas usar los arrays!
        $c = $primeraPCR[2];
        include 'calendario.php';
        echo '<div class="contenedorPrincipal"></br> Amarillo: dia que indicaste el positivo
        </br> Rojo: fecha de la segunda PCR
        </br> Verde: dia de desconfinamiento</br></div>';
      }
      unset($fila,$fila2);
    }
    else if($fila2 == 0){
      echo '<form method = "post">
      <input type = "radio" name="pcr" value="Indicar positivo en COVID">Indicar positivo en COVID
      <input type = "Radio" name="pcr" value="Mostrar historial">Mostrar historial<br>
      <input type = "submit" value="Enviar"></form>';
      if($_POST["pcr"] === "Indicar positivo en COVID"){
        $pcr1=date("Y-n-j");
        $pcr2=date("Y-n-j", strtotime($pcr1."+ 10 days"));
        $des=date("Y-n-j", strtotime($pcr1."+ 15 days"));
        $user = "user";
        $query	=	"INSERT INTO test(email, f_test1, f_test2, f_descon) VALUES ('".$_SESSION[$user]."','".$pcr1."','".$pcr2."','".$des."')";
        $resultado	=	mysqli_query($bd,	$query);
      }
      else if($_POST["pcr"] === "Mostrar historial"){
        $query	=	"SELECT * FROM	test";
        $resultado	=	mysqli_query($bd,	$query);
        $id = 0;
        for($i = 0; $i < mysqli_num_rows($resultado); $i++){
            $fila = mysqli_fetch_array($resultado); #aqui cojo la ultima entrada de la base de datos de una misma persona (por si ha estado mas de una vez confinado)
            if(($id < $fila['id'])&&($fila['email']==$_SESSION["user"])){
              $id = $fila['id'];
            }
            else if(($id = $fila['id'])&&($fila['email']==$_SESSION["user"])){
              $fila2 = $fila;# AQUI TENDRE QUE MOSTRAR EL HISTORIAL
              $desconf = explode("-",$fila2['f_descon']);
              $segundaPCR = explode("-",$fila2['f_test2']);
              $primeraPCR = explode("-",$fila2['f_test1']);
              $a = $desconf[2]; #pongo las variables asi, porque las utilizao como super globales
              $b = $segundaPCR[2]; #y me estaba dando problemas usar los arrays!
              $c = $primeraPCR[2];
              include 'calendario.php';
            }
            else if($fila2 == NULL){
              echo	"Usted no ha estado confinado nunca";
              exit();
            }
        }
    }
  }
    unset($fila,$fila2);
    ?>
  </div class="contenedorPrincipal"> #hacer esto
  <div>
  </div>
  <form method = "post" action = "./logout.php">
  <input type = "submit" value="Cerrar Sesión"></form>
  <?php
  include 'footer.php';
  ?>
</body>
</html>
