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
      unset($_POST);
      mysqli_free_result($resultado);
      $fecha_actual = getdate(time());
      $fecha_actual_day = $fecha_actual['mday'];
      $fecha_actual_mon = $fecha_actual['mon'];
      $fecha_actual_year = $fecha_actual['year'];
      $desconf = explode("-",$fila2['f_descon']);

      if(($fila2 == NULL)||($desconf[0] < $fecha_actual_year)||(($desconf[1] < $fecha_actual_mon)&&($desconf[0] == $fecha_actual_year))||(($desconf[2] < $fecha_actual_day)&&($desconf[0] == $fecha_actual_year)&&($desconf[1] == $fecha_actual_mon))){ #Esto indica que no esta confinado, o que no ha estado confinado en ningun momento
        if(($fila2 != NULL)&&($fila2['comentario']==NULL)){
          echo '<form method = "post"><label for="comentario">Comente su experiencia la experiencia del ultimo confinamiento </label><br><input type="text" id="comentario" name="comentario" style="width : 100px; heigth : 100px"><br><input type = "submit" value="Enviar Comentario"></form>';
          if(isset($_POST["comentario"])){
            echo "entradaaadadaadadaddadaaddaadadad";
            $coment = "comentario";
            $query	=	"UPDATE	test	SET id = '".$id."' WHERE comentario = '".$_POST[$coment]."'";
            $resultado	=	mysqli_query($bd,	$query);
          }
          unset($_POST);
        }
        echo '<form method = "post">
        <input type = "radio" name="pcr" value="Indicar positivo en COVID">Indicar positivo en COVID<br>
        <input type = "submit" value="Enviar"></form>';
        if(!empty($_POST)){
          if($_POST["pcr"] === "Indicar positivo en COVID"){
            unset($_POST);
            $pcr1=date("Y-n-j");
            $pcr2=date("Y-n-j", strtotime($pcr1."+ 10 days"));
            $des=date("Y-n-j", strtotime($pcr1."+ 15 days"));
            $user = "user";
            $query	=	"UPDATE INTO test(email, f_test1, f_test2, f_descon) VALUES ('".$_SESSION[$user]."','".$pcr1."','".$pcr2."','".$des."')";
            $resultado	=	mysqli_query($bd,	$query);
          }
        }else{
          echo 'No se ha indicado positivo todavia';
        }
      }
      else{
        $desconf = explode("-",$fila2['f_descon']);
        $segundaPCR = explode("-",$fila2['f_test2']);
        $primeraPCR = explode("-",$fila2['f_test1']);
        $a = $desconf[2]; #pongo las variables asi, porque las utilizao como super globales
        $b = $segundaPCR[2]; #y me estaba dando problemas usar los arrays!
        $c = $primeraPCR[2];
        include 'calendario.php';
        echo '<div class="contenedorPrincipal">
        </br> Naranja: fecha actual
        </br> Amarillo: dia que indicaste el positivo
        </br> Rojo: fecha de la segunda PCR
        </br>Verde: dia de desconfinamiento (Si el dia en verde está antes que el dia amarillo, indica que la fecha de desconfinamiento es del siguiente mes)</br></div>';
      }
      unset($fila,$fila2);
    }
    else if($fila2 == 0){
      echo '<form method = "post">
      <input type = "radio" name="pcr" value="Indicar positivo en COVID">Indicar positivo en COVID
      <input type = "submit" value="Enviar"></form>';
      if($_POST["pcr"] === "Indicar positivo en COVID"){
        $pcr1=date("Y-n-j");
        $pcr2=date("Y-n-j", strtotime($pcr1."+ 10 days"));
        $des=date("Y-n-j", strtotime($pcr1."+ 15 days"));
        $des_explode = explode("-",$des);
        $user = "user";
        $query	=	"INSERT INTO test(email, f_test1, f_test2, f_descon) VALUES ('".$_SESSION[$user]."','".$pcr1."','".$pcr2."','".$des."')";
        $resultado	=	mysqli_query($bd,	$query);
      }
  }
    unset($fila,$fila2);
    ?>
  </div>

  <div class="contenedorPrincipal">
    <?php #primero comprobaremos que no este ya confinado, luego listaremos las fechas en un calendario
    $query	=	"SELECT * FROM	per_asig";
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){
      echo	"Error:	No hay ningun elemento en la tabla	<br>";
      exit();
    }
    $contador = 0;
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila2 = mysqli_fetch_array($resultado);
      if ($fila2['email'] === $_SESSION["user"]){
        $arrayPos[$contador] = $fila2['codigo'];
        $contador++;
      }
    }
    unset($fila2);
    mysqli_free_result($resultado);

    $query	=	"SELECT * FROM	test";
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){
      echo	"Error:	No hay ningun elemento en la tabla	<br>";
      exit();
    }
    $cont_email = 0;
    $c = 0;
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila2 = mysqli_fetch_array($resultado);
      if($cont_email != 0){
        for ($j=0; $j < $cont_email; $j++) {
          if($arrayemail[$j] == $fila2['email']){
            $c++;
          }
        }
      }else if($c == 0){
        if($fila2['email']!=$_SESSION["user"]){
          $fecha_actual = getdate(time());
          $fecha_actual_day = $fecha_actual['mday'];
          $fecha_actual_mon = $fecha_actual['mon'];
          $fecha_actual_year = $fecha_actual['year'];
          $desconf = explode("-",$fila2['f_descon']);
          if(($desconf[0] < $fecha_actual_year)||(($desconf[1] < $fecha_actual_mon)&&($desconf[0] == $fecha_actual_year))||(($desconf[2] < $fecha_actual_day)&&($desconf[0] == $fecha_actual_year)&&($desconf[1] == $fecha_actual_mon))){
            $arrayemail[$cont_email] = $fila2['email']; # Esto lo hago para que no meta a la misma persona muchas veces
            $cont_email++;
          }
        }
      }
      $c = 0;
    }
    unset($fila2);
    mysqli_free_result($resultado);

    $query	=	"SELECT * FROM	per_asig";
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){
      echo	"Error:	No hay ningun elemento en la tabla	<br>";
      exit();
    }

    $positivos = 0;
    $c = 0;
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){ #primer for para recorrer toda la tabla
      $fila2 = mysqli_fetch_array($resultado);
      for($j = 0; $j < $cont_email;$j++){ # Segundo for para recorrer todo el vector de emails que son positivos
        for ($k=0; $k < $contador; $k++) { # Tercer for para ver si alguno de los positivos coincide en nuestras asignaturas
          if(($fila2['email'] == $arrayemail[$j])&&($arrayPos[$k] == $fila2['codigo'])){
            $arraycomp[$positivos] = $fila2['email']; # Lo utilizp para comprobar que la misma persona no afecta varias veces
            if($positivos != 0){
              for ($x=0; $x < $positivos; $x++) {
                if($arraycomp[$j] == $fila2['email']){
                  $c++;
                }
              }
            }else if(($positivos == 0)||($c == 0)){
              $positivos++; # aumento el caso de positivos si y solo si es el la primera entrada que cumple la condicion
            } # de estar en la misma clase y se positivo o si es la primera vez que compruebo a la misma persona (se hace variasa veces)
          }
          $c == 0; # Resestablezco el valor del contador porque cambiamos de entrada de la tabla
        }
      }
    }
    unset($fila2);
    mysqli_free_result($resultado);

    if($positivos == 0){
      echo 'No hay casos positivos de compañeros en sus asignaturas';
    }elseif(($positivos >= 1) && ($positivos < 3)){
      echo 'Riesgo bajo, hay '.$positivos.' casos positivos de compañeros en todas tus asignaturas, es recomendable hacerse la pcr cuanto antes.<br>';
    }else if(($positivos >= 3) && ($positivos < 5)){
      echo 'Riesgo Medio, hay '.$positivos.' casos positivos de compañeros en todas tus asignaturas, es recomendable hacerse la pcr cuanto antes.<br>';
    }else{
      echo 'Riesgo alto, hay '.$positivos.' casos positivos de compañeros en todas tus asignaturas, es recomendable hacerse la pcr cuanto antes.<br>';
    }
    ?>
  </div>
  <form method = "post" action = "./logout.php">
  <input type = "submit" value="Cerrar Sesión"></form>
  <?php
  include 'footer.php';
  ?>
</body>
</html>
