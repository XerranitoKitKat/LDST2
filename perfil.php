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
    <?php # Contendor que mostrara nuesttros datos personales
    $bd	=	mysqli_connect("localhost",	"root",	""); # Nos conectamos ala base de datos
	  mysqli_select_db($bd,	"bd"); # Seleccionamos la base
    if	(mysqli_connect_errno())	{  # Comprobamos que nos hayamos conectado bien
        echo	"Error:	"	.	mysqli_connect_error()	.	".	<br>"; # Si no devuelve un error y sale
        exit();
    }
    $query	=	"SELECT * FROM	personas";  # Hacemos la consulta a la tabla de personas
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){ # Si esta es nula, quiere decir que no hay personas, por lo que habria un error
      echo	"Error:	No hay ningun elemento en la tabla	<br>";
      exit();
    }
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){ # Por cada entrada de la tabla de personas hacemos una iteracion
      $fila2 = mysqli_fetch_array($resultado); # guardamos la entrada en una variable para trabajar con ella
      if ($fila2['email'] === $_SESSION["user"]){ #aqui comprobaremos que se escoge a la persona correcta
        $fila = $fila2;                               # con el email de la sesion
      }
    }
    mysqli_free_result($resultado); # liberamos la variable de resultado para utilizarla posteriormente
    ?>
    Bienvenido <?php # Mostramos la informacion relevante de la persona
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
    <?php # En este contendor listaremos las asignaturas de la persona
    $query	=	"SELECT * FROM	per_asig"; # hacemos la consulta
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){ # Si no hay ninguna es que ha habido un error y sale de la ejecucion
      echo	"Error:	en la base de datos, no tiene ninguna asignatura	<br>";
      exit();
    }
    $arrayAsig[0] = NULL; # definimos dos variables, una un array del codigo de las asignaturas
    $contador = 0; # y la otra un entero que cuenta el numero de las asiganturas que tensmo
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){ # una entrada por iteracion
      $fila2 = mysqli_fetch_array($resultado); # igualamos a una variable para utilizar la entrada
      if($fila2['email'] == $fila['email']){ # si el email de la persona coincide con el de la entrada entra en el if
        $arrayAsig[$contador] = $fila2['codigo']; #añade una entrada mas cada vez que entra en el if
        $contador++;
      }
    }
    unset($contador); # eliminamos la vcariable de contador
    if($arrayAsig == NULL){ # Si no se ha encontrado ninguna se le dice que no esta matriculado en ninguna asignatura
      echo	"No tiene ninguna asignatura	<br>";
      exit();
    }
    mysqli_free_result($resultado); # liberamos la variable para utilizarla posteriormente
    $query	=	"SELECT * FROM	asignaturas"; # Creamos una consulta nueva.
    $resultado	=	mysqli_query($bd,	$query); # Mostramos la informacion de las asiganturas que tiene la persona
    echo "Las asiganturas a las que usted esta matriculado son las siguientes: </br></br>
    codigo      Nombre      Aulas     Labs     Profesores      Curso<br></br>";
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila = mysqli_fetch_array($resultado);
      for($k = 0; $k<count($arrayAsig);$k++){ # Por cada iteracion se busca en todo el array de asignaturas parra ver si alguna coincide
        if($fila['codigo'] == $arrayAsig[$k]){ # Si coincide se muestra la info
          echo "".$fila['codigo']." ".$fila['nombre'].", ".$fila['aula']." ".$fila['lab']." ".$fila['profesor']." ".$fila['curso']."</br></br>";
        }
      }
    }
    if($fila2 == NULL){ # Si no ha encontrado nada se imprime por pantalla que no encontro nada
      echo	"No tiene ninguna asignatura	<br>";
      exit();
    }
    unset($fila,$fila2); # liberamos variables
    ?>
  </div>
  <div class="contenedorPrincipal">
    <?php # En este div, presentaremos un calendario que muestre unos dias especificos, o que indique si ha dado positivo
    $query	=	"SELECT * FROM	test"; # se realiza la consulta
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){ # Se comprueba si ha habido algun error
      echo	"Error con la base de datos";
      exit();
    }
    $id = 0; # Creamos una varriable identificador que nos servira para comprobar y una de fila para que no de errores
    $fila2 = NULL;
    for($i = 0; $i < mysqli_num_rows($resultado); $i++){
        $fila = mysqli_fetch_array($resultado); #aqui cojo la ultima entrada de la base de datos de una misma persona (por si ha estado mas de una vez confinado)
        if(($id < $fila['id'])&&($fila['email']== $_SESSION["user"])){ # Si se cumple la condicion de que se encuentran entradas de la persona y el id es menor que el de la entrada
          $id = $fila['id']; # se mete en el if y se actualiza el valor de la entrada
        }
        if(($id = $fila['id'])&&($fila['email']== $_SESSION["user"])){
          $fila2 = $fila;# # Si el id es el mismo quiere decir que se ha encontrado el valor mas alto, por lo que nos quedamos con esa entrada
        }
    }
    if($fila2 != 0){ # en caso de que no se encuentre nada, lo que hacemos es directamente ponerle un radio boton para que indique si ha dado positivo
      mysqli_free_result($resultado);
      $fecha_actual = getdate(time());
      $fecha_actual_day = $fecha_actual['mday'];
      $fecha_actual_mon = $fecha_actual['mon'];
      $fecha_actual_year = $fecha_actual['year'];
      $desconf = explode("-",$fila2['f_descon']); # en estas variables cogemos la fecha actual para utilizarlas despues

      # En es elguiente if se comprueba que la fecha actual sea despues que la del ultimo confinamiento que haya tenido la persona para que asi pueda añadir un comentario de la experiencia obtenida al ultimo confinamiento
      # es decir, que ponga valoracion o lo que quiera introducir. Esto ocurre siuempre y cuando no se haya introducido ya el comentario

      #ERES UN PSICOPATA, pero se te quiere igual amorcito. Pd: no has usado un puto foreach,tus ifs los has debido de hacer mientras te marcarbas un temon satanico, la profe se va a cagar en tus muertos, a mi personalmente me hace gracia. Att con amor, Jenny.

      if(($fila2 == NULL)||($desconf[0] < $fecha_actual_year)||(($desconf[1] < $fecha_actual_mon)&&($desconf[0] == $fecha_actual_year))||(($desconf[2] < $fecha_actual_day)&&($desconf[0] == $fecha_actual_year)&&($desconf[1] == $fecha_actual_mon))){ #Esto indica que no esta confinado, o que no ha estado confinado en ningun momento
        if(($fila2 != NULL)&&($fila2['comentario']==NULL)){
          echo '<form method = "post"><label for="comentario">Comente su experiencia la experiencia del ultimo confinamiento </label><br><input type="text" id="comentario" name="comentario" style="width : 100px; heigth : 100px"><br><input type = "submit" value="Enviar Comentario"></form>';
          if(isset($_POST["comentario"])){
            $coment = "comentario";
            $query	=	"UPDATE	test SET comentario = '".$_POST[$coment]."' WHERE id = $id"; # actualizamos el valor del comentario en la tabla
            $resultado	=	mysqli_query($bd,	$query);
            unset($_POST);
          }
        }
        echo '<form id="formulario" method = "post" action="">
        <input type = "radio" name="pcr" value="Indicar positivo en COVID">Indicar positivo en COVID<br>
        <input type = "submit" value="Enviar" form="formulario"></form>'; # Aqui ponemos el formulario para que indique si ha dado positivo
        if($_SERVER["REQUEST_METHOD"] == "POST"){ # Si lo indica hacemos lo siguiente
          if($_POST["pcr"] === "Indicar positivo en COVID"){
            $pcr1=date("Y-n-j"); #cogemos el dfia actual, el de dentro de 10 dias (segundo test) y la fecha de desconfinamiento (dentro de 15 dias)
            $pcr2=date("Y-n-j", strtotime($pcr1."+ 10 days"));
            $des=date("Y-n-j", strtotime($pcr1."+ 15 days"));
            $user = "user";
            $query	=	"INSERT INTO test(email, f_test1, f_test2, f_descon) VALUES ('".$_SESSION[$user]."','".$pcr1."','".$pcr2."','".$des."')";
            $resultado	=	mysqli_query($bd,	$query); # Introducimos una nueva entrada a la tabla de test de la persona
            echo '<script>window.location.href = "./sesion.php"</script>';#NO funciona, mecago en todo
            #Voy a comentar el problema, creo que las variables guardan su estado en el fichero, creo que pasa algo muy raro con los if o con alguna variable que anda por ahi purulando
            #me puedo estar equivocando tho, pero me huele a eso. Importa el orden en el que pongas el codigo php (mira sesion.php), sinceramente esto es una locura.
            unset($_POST);
            unset($_SERVER);
          }
        }
        else
        {
          echo 'No se ha indicado positivo todavia';
        }
      }
      #el problema es que cuando das a enviar, todo el codigo dentro de este else se lo salta porque ya ha evaluado el if de la linea 140
      #UNA SOLUCION: recargar pagina (linea 161)
      else{ # Por el contrario si esta confinado actualmente, es decir, si la fecha de desconfinamiento es mayor que la actual se le muestra un calendario
        $desconf = explode("-",$fila2['f_descon']);
        $segundaPCR = explode("-",$fila2['f_test2']);
        $primeraPCR = explode("-",$fila2['f_test1']); # Realizamos un explode de las variables para "enviarselas" a calendario.php
        $a = $desconf[2]; # estas variables se definen asi porque las utilizo como superglobales
        $b = $segundaPCR[2];
        $c = $primeraPCR[2];
        include 'calendario.php'; # Mostramos el calendario con los dias señalados y ponemos una breve leyenda
        echo '<div class="contenedorPrincipal">
        </br> Naranja: fecha actual
        </br> Amarillo: dia que indicaste el positivo
        </br> Rojo: fecha de la segunda PCR
        </br>Verde: dia de desconfinamiento (Si el dia en verde está antes que el dia amarillo, indica que la fecha de desconfinamiento es del siguiente mes)</br></div>';
      }
      unset($fila,$fila2);
    }
    else if($fila2 == 0){ # Si no hay entradas anteriormente lo que se hace es lo mismo que cuando las hay, pero no se esta confinado, es decir, se muestra un formulario para indicar el positivo
      echo '<form method = "post">
      <input type = "radio" name="pcr" value="Indicar positivo en COVID">Indicar positivo en COVID
      <input type = "submit" value="Enviar"></form>';
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["pcr"] === "Indicar positivo en COVID"){
          $pcr1=date("Y-n-j");
          $pcr2=date("Y-n-j", strtotime($pcr1."+ 10 days"));
          $des=date("Y-n-j", strtotime($pcr1."+ 15 days"));
          $des_explode = explode("-",$des);
          $user = "user";
          $query	=	"INSERT INTO test(email, f_test1, f_test2, f_descon) VALUES ('".$_SESSION[$user]."','".$pcr1."','".$pcr2."','".$des."')";
          $resultado	=	mysqli_query($bd,	$query);
          unset($_POST);
        }
      }
    }
    unset($fila,$fila2);
    ?>
  </div>

  <div class="contenedorPrincipal">
    <?php # En este div lo que se va a buscar es la cantidad de alumnos que hay positivos en las asiganturas que tiene la persona
    $query	=	"SELECT * FROM	per_asig"; # para ello buscamos las asignaturas que tenga la persona
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){
      echo	"Error:	No hay ningun elemento en la tabla	<br>"; # si no tiene entradas es que hay error
      exit();
    }
    $contador = 0; # variable contador que contara el numero de asignaturas que tiene la persona
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila2 = mysqli_fetch_array($resultado);
      if ($fila2['email'] === $_SESSION["user"]){ # si la persona coincide con la entrada se añade el codigo de la asignatura a un array
        $arrayPos[$contador] = $fila2['codigo']; # ademas de ello se incrementa el contador de asignaturas
        $contador++;
      }
    }
    unset($fila2); # se liberan variables
    mysqli_free_result($resultado);

    $query	=	"SELECT * FROM	test"; # seguidamente tendremos que buscar en la tabla de test las personas que estan confinadas
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){
      echo	"Error:	No hay ningun elemento en la tabla	<br>";
      exit();
    }
    $cont_email = 0; # varibles que cuentan la cantidad de peronas confinadas
    $c = 0; # variable que uso para que sihay varias entradas de una peronas, solo se la añada una vez al array
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){
      $fila2 = mysqli_fetch_array($resultado);
      if($cont_email != 0){ # esto se hace cuando ya nosea la primera entrada/iteracion
        for ($j=0; $j < $cont_email; $j++) {
          if($arrayemail[$j] == $fila2['email']){ # se comprueba si la persona ya ha sido añadida o no al array
            $c++;
          }
        }
      }else if($c == 0){ # en caso de que no haya sido añadida se hace lo siguiente
        if($fila2['email']!=$_SESSION["user"]){ # se comprueba que las peronas de la tabla no sean la persona, para no contar a esta como positivo (pues ya lo sabe y queremos indicar positivos de compañeros)
          $fecha_actual = getdate(time()); # obtenemos las fechas relevantes
          $fecha_actual_day = $fecha_actual['mday'];
          $fecha_actual_mon = $fecha_actual['mon'];
          $fecha_actual_year = $fecha_actual['year'];
          $desconf = explode("-",$fila2['f_descon']);
          # se comprueba que la entrada de la persona este confinada actualmente
          if(($desconf[0] < $fecha_actual_year)||(($desconf[1] < $fecha_actual_mon)&&($desconf[0] == $fecha_actual_year))||(($desconf[2] < $fecha_actual_day)&&($desconf[0] == $fecha_actual_year)&&($desconf[1] == $fecha_actual_mon))){
            $arrayemail[$cont_email] = $fila2['email']; # Si estaconfinada se introduce en un array
            $cont_email++; # se cuenta la cantidad de personas que hay confinadas actualmente
          }
        }
      }
      $c = 0; # para otra iteracion se vuelve a poner el valor a cero para meter a una nueva persona
    }
    unset($fila2);
    mysqli_free_result($resultado);

    $query	=	"SELECT * FROM	per_asig";
    $resultado	=	mysqli_query($bd,	$query);
    if(!$resultado){
      echo	"Error:	No hay ningun elemento en la tabla	<br>";
      exit();
    }

    $positivos = 0; # definimos variables que serviran para ver el numero de positivoss que hay en algunade nuestras asignaturas
    $c = 0; # La usamos para lo mismo que antes, parta no mostrar/contar a la misma persona mas de una vez
    for ($i = 0; $i < mysqli_num_rows($resultado);$i++){ #primer for para recorrer toda la tabla
      $fila2 = mysqli_fetch_array($resultado);
      for($j = 0; $j < $cont_email;$j++){ # Segundo for para recorrer todo el vector de emails que son positivos
        for ($k=0; $k < $contador; $k++) { # Tercer for para ver si alguno de los positivos coincide en nuestras asignaturas
          if(($fila2['email'] == $arrayemail[$j])&&($arrayPos[$k] == $fila2['codigo'])){
            $arraycomp[$positivos] = $fila2['email']; # Lo utilizp para comprobar que la misma persona no afecta varias veces
            if($positivos != 0){
              for ($x=0; $x < $positivos; $x++) {
                if($arraycomp[$j] == $fila2['email']){ # si al persona ya esta en el array, no se vuelve a meter
                  $c++;
                }
              }
            }else if(($positivos == 0)||($c == 0)){
              $positivos++; # aumento el caso de positivos si y solo si es el la primera entrada que cumple la condicion
            } # de estar en la misma clase y se positivo o si es la primera vez que compruebo a la misma persona (se hace variasa veces)
          }
          $c = 0; # Resestablezco el valor del contador porque cambiamos de entrada de la tabla
        }
      }
    }
    unset($fila2);
    mysqli_free_result($resultado);
    # Ahora mostramos el factor de riesgo que tiene la persona, es decir, le indicamos el numero de positivos que ha tenido cerca
    if($positivos == 0){
      echo 'No hay casos positivos de compañeros en sus asignaturas';
    }elseif(($positivos >= 1) && ($positivos < 3)){
      echo 'Riesgo bajo, hay '.$positivos.' casos positivos de compañeros en todas tus asignaturas, es recomendable hacerse la pcr cuanto antes.<br>';
    }else if(($positivos >= 3) && ($positivos < 5)){
      echo 'Riesgo Medio, hay '.$positivos.' casos positivos de compañeros en todas tus asignaturas, es recomendable hacerse la pcr cuanto antes.<br>';
    }else{
      echo 'Riesgo alto, hay '.$positivos.' casos positivos de compañeros en todas tus asignaturas, es recomendable hacerse la pcr cuanto antes.<br>';
    } # el siguiente div lo hacemos para cerrar la sesion
    ?>
  </div>
  <form method = "post" action = "./logout.php">
  <input type = "submit" value="Cerrar Sesión"></form>
  <?php
  include 'footer.php';
  ?>
</body>
</html>
