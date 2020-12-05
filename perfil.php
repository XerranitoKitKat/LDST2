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
    $query	=	"SELECT * FROM	tabla_personas";
    $resultado	=	mysqli_query($bd,	$query);
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila = mysqli_fetch_array($resultado);
      if ($fila['email'] == $GLOBALS["arrayProyecto(0)"]){ #aqui comprobaremos que se escoge a la persona correcta
        break;                                #a mostrar
      }
    }
    ?>
    <b><big>Bienvenido <?php #incluir aqui la lista de cosas de las personas. Aqui en particular el nombre
    echo "".$fila['nombre']." ".$fila['apellidos']."";
    ?></big></b></br></br>
    Tus datos personales son:</br>
    Correo electronico de la UVa: <?php
    echo "".$fila['email']."";
    ?></br>
    Fecha de nacimiento: <?php
    echo "".$fila['nacimiento']."";
    ?></br>
    Número de telefono: <?php
    echo "".$fila['telefono']."";
    ?></br>
  </div>
  <div class="contenedorPrincipal">
    <?php
    $query	=	"SELECT * FROM	tabla_per_asig";
    $resultado	=	mysqli_query($bd,	$query);
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila2 = mysqli_fetch_array($resultado);
      if($fila2['email'] == $fila['email']){
        $arrayAsig[] = $fila2['codigo_asignatura']; #añade una entrada mas cada vez que entra en el if
      }
    }
    $query	=	"SELECT * FROM	tabla_asignaturas";
    $resultado	=	mysqli_query($bd,	$query);
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila = mysqli_fetch_array($resultado);
      for($k = 0; $k<count($arrayAsig);$k++){
        if($fila['codigo'] == $arrayAsig[$k]){
          $fila2[] = $fila;                       #añade una entrada mas cada vez que entra en el if al vector de filas (asiganaturas) a mostrar
        }
      }
    }
    for ($i = 0; $i < count($fila2);$i++){
      echo "Nombre de la asignatura: ".$fila2['nombre']." Profesores: ".$fila2['profesor']." Aulas de teoría: ".$fila2['aula']." Aulas de labs: ".$fila2['labs']." Curso: ".$fila2['curso']."</br>";
    } #En teoria así deberia listarse ya las asignaturas.
    ?>
  </div>
  <div class="contenedorPrincipal">
    <?php #primero comprobaremos que no este ya confinado, luego listaremos las fechas en un calendario
    $query	=	"SELECT * FROM	tabla_asignaturas";
    $resultado	=	mysqli_query($bd,	$query);
    $id = 0;
    for($i = 0; $i < mysqli_num_rows($resultado); $i++){
        $fila = mysqli_fetch_array($resultado); #aqui cojo la ultima entrada de la base de datos de una misma persona (por si ha estado mas de una vez confinado)
        if(($id < $fila['identificador'])&&($fila['email']==$GLOBALS["arrayProyecto(0)"])){
          $id = $filas['identificador'];
          $fila2 = $fila;
        }
    }
    $timestamp = time();
    $fecha_actual = getdate($timestamp); #OJO, MIRAR LO DE LAS FECHAS, PARA COGERLAS BIEN
    if(($fila2 == NULL)||($fila2['fecha_desconf'] < $fecha_actual)){ #Esto indica que no esta confinado, o que no ha estado confinado en ningun momento
      echo 'Por favor, indique si ha dado positivo o le han hecho el test, pero ha dado negativo y esta en cuarentena; </br></br>
      <input type = "radio" id = "Si" name = "positivo" value="1">
      <label for "Si"> He dado positivo o estoy confinado. </label></br></br>
      <input type = "submit" value = "Enviar">';
    }
    if(($fila2 != NULL)&&($fila2['fecha_desconf'] > $fecha_actual)){ #OJO COMPROBAR QUE COJO BIEN LAS FECHAS, O SI LAS COJO!
      
    }

    ?>
  </div>
  <?php
  include 'footer.php';
  ?>
</body>
</html>