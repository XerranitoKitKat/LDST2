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
      if ($fila2['email'] === 'josdie@tel.uva.es'){ #aqui comprobaremos que se escoge a la persona correcta
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
      echo	"Usted no ha tenido ningun positivo todavia	<br>";
      exit();
    }
    $id = 0;
    for($i = 0; $i < mysqli_num_rows($resultado); $i++){
        $fila = mysqli_fetch_array($resultado); #aqui cojo la ultima entrada de la base de datos de una misma persona (por si ha estado mas de una vez confinado)
        if(($id < $fila['identificador'])&&($fila['email']=="josdie@tel.uva.es")){
          $id = $fila['identificador'];
        }
        if(($id = $fila['identificador'])&&($fila['email']=="josdie@tel.uva.es")){
          $fila2 = $fila;
        }
    }
    mysqli_free_result($resultado);
    $fecha_actual = getdate(time()); #OJO, MIRAR LO DE LAS FECHAS, PARA COGERLAS BIEN
    $fecha_actual_day = $fecha_actual['mday'];
    $fecha_actual_mon = $fecha_actual['mon'];
    $fecha_actual_year = $fecha_actual['year'];
    echo $fecha_actual_day.$fecha_actual_mon.$fecha_actual_year;
    if(($fila2 == NULL)||($fila2['fecha_desconf'] < $fecha_actual)){ #Esto indica que no esta confinado, o que no ha estado confinado en ningun momento

    }
    if(($fila2 != NULL)&&($fila2['fecha_desconf'] > $fecha_actual)){ #OJO COMPROBAR QUE COJO BIEN LAS FECHAS, O SI LAS COJO!  ADEMAS DE HACERLAS GLOBALES PARA MOSTRARLAS EN EL CALENDARIO
      include 'calendario.php';
    }
    unset($fila,$fila2);
    ?>
  </div>
  <?php
  include 'footer.php';
  ?>
</body>
</html>
