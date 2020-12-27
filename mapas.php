<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mapas</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">

  <style>

    ul{
      list-style-type: none;
      margin: 0;
      padding: 0;
    }

    .contenedorImagenes{
      display: flex;
      flex-flow: row;

      width: 100%;
      height: 400px;
      margin-bottom: 50px;
    }

    .contenedorImagenes > div{
      flex: 1;
      margin: 2px;
      text-align: center;
    }

    .contenedorImagenes > div > img{
      width: 100%;
      height: 100%;
      margin: 0px;
    }

    .contenedor-Texto{
      font: 20px Verdana;
      width: 98%;
      margin: 20px 1%;
    }

    .contenedor-Lista{
      max-height: 200px;
      overflow: auto; /*Similar a scrollbar pero solo muestra las barras necesariias*/
      border: 2px outset black;
    }

    .contenedor-Buscador{
      min-height: 50px;
      margin: auto;
      font: x-small Verdana;
      padding: 0 30% 0 30%;
    }

    .lista{
      display: grid;
      width: 100%;
      grid-template-columns: 85% auto;
      grid-gap: 3px;
      background-color: white;
    }

    .lista > div{
      margin: 2px;
      text-align: center;
      font-size: 20px;
      border: 2px solid black;
    }

    #cambiador{
      text-align: center;
      min-height: 30px;
    }

    #buscador *{
      margin: auto;
      width: 100%;
      height: 100%;
    }

    #orden{
      min-width: 100px;
    }

    @media all and (max-width:640px){
      .contenedorImagenes{
        flex-flow: column;
        min-height: 1600px; /*para evitar que se monte encima del contenido del abajo*/
      }

      .contenedorImagenes > div{
        margin-top: 30px;
      }
    }
  </style>
</head>

<script src="./scripts/cambiarMapas.js"></script>

<body>
  <?php
  include 'cabecera.php';

  function mostrarBusqueda($aulas,$naulas,$labs,$URL_labs,$URL_aulas,$nURL_aulas){ //esta funcion se encarga de mostrar de forma bonita el resultado de la busqueda
    if(count($naulas)==1 && count($nURL_aulas)==1){ //numero de URLs y aulas coinciden
      echo '<div>AULA '.$aulas.'</div>
      <div><a href="'.$URL_aulas.'" target="_blanck">PDF</a></div>';
    }
    elseif (count($naulas)==2 && count($nURL_aulas)==1) {//varias aulas en un solo URL
      echo '<div>AULA '.$naulas[0].'</div>
      <div><a href="'.$URL_aulas.'" target="_blanck">PDF</a></div>
      <div>AULA '.$naulas[1].'</div>
      <div><a href="'.$URL_aulas.'" target="_blanck">PDF</a></div>';
    }
    elseif (count($naulas)==2 && count($nURL_aulas)==2) {//dos aulas en dos URLs
      echo '<div>AULA '.$naulas[0].'</div>
      <div><a href="'.$nURL_aulas[0].'" target="_blanck">PDF</a></div>
      <div>AULA '.$naulas[1].'</div>
      <div><a href="'.$nURL_aulas[1].'" target="_blanck">PDF</a></div>';
    }
    elseif (count($naulas)==3 && count($nURL_aulas)==2) {//tres aulas en dos URLs
      echo '<div>AULA '.$naulas[0].'</div>
      <div><a href="'.$nURL_aulas[0].'" target="_blanck">PDF</a></div>
      <div>AULA '.$naulas[1].'</div>
      <div><a href="'.$nURL_aulas[0].'" target="_blanck">PDF</a></div>
      <div>AULA '.$naulas[2].'</div>
      <div><a href="'.$nURL_aulas[1].'" target="_blanck">PDF</a></div>';
    }
    //no se da el caso de que tengamos 3 URL, tampoco el que tengamos mas de dos ficheros de lab
    if(strcmp($URL_labs,"ND")==0){
      '<div>LABORATORIO '.$labs.' Inf. No Disponible</div>
      <div>'.$URL_labs.'</div>';
    }
    elseif($labs!=NULL) {
      echo '<div>LABORATORIO(S) '.$labs.'</div>
      <div><a href="'.$URL_labs.'" target="_blanck">PDF</a></div>';
    }

    //los siguientes if son para mostrar el plano de la planta correspondientes a las aulas donde se imparte la asignatura
    if(preg_match("/A0/",$aulas)){
      echo '<div>PLANO DE LA PLANTA BAJA</div>
      <div><a href="./pdfs/PLANTA_BAJA.pdf" target="_blanck">PDF</a></div>';
    }

    if(preg_match("/A1/",$aulas) || preg_match("/1L/",$labs) || (strcmp("LABORATORIO DE ELECTRONICA",$labs)==0)){
      echo '<div>PLANO DE PRIMERA PLANTA</div>
      <div><a href="./pdfs/PRIMERA_PLANTA.pdf" target="_blanck">PDF</a></div>';
    }

    if(preg_match("/2L/",$labs)){
      echo '<div>PLANO DE LA SEGUNDA PLANTA</div>
      <div><a href="./pdfs/SEGUNDA_PLANTA.pdf" target="_blanck">PDF</a></div>';
    }
  }
  ?>
  <div class="contenedor-Texto"><h4>El edificio consta de 3 plantas y alberga a las escuelas de ingenieros de informática y telecomunicaciones tal como se muestra a continuación:</h4></div>

  <div id="cambiador">
    <span><button type="button" title="Cambiar a planos referentes a telecomunicaciones" onclick="mostrarPlanosTeleco()">Telecomunicaciones</button></span>
    <span><button type="button" title="Cambiar a planos referentes a informatica" onclick="mostrarPlanosInfo()">Informatica</button></span>
  </div>

  <div class="contenedorImagenes">
    <script defer>
      mostrarPlanosTeleco();
    </script>
  </div>

  <div class="contenedor-Texto">
    <p>A la hora de desplazarse por el dificio conviene saber de que forma los pasillos y aulas se han abilitado para hacer frente
      a la pandemia. Por ejemplo el como se han distribuido los dispensadores de desinfectante en el edificio, disposición de
      asientos en aulas, escaleras de subida o bajada.</br>Por ello se facilita a continuación una lista que incluye varios
      documentos con informormación sobre el edificio y aulas de este.
    </p>
  </div>

  <div class="contenedor-Texto">
    <p>A continuacion tienes a tu disposicion un buscador que te permitira encontrar los planos de las aulas correspondientes a tus
      asignaturas. Introduce su nombre completo. Puedes ver una lista de las asignaturas <a
      href="https://www.uva.es/export/sites/uva/2.docencia/2.01.grados/2.01.02.ofertaformativagrados/detalle/Grado-en-Ingenieria-de-Tecnologias-de-Telecomunicacion/">aquí</a>.</br>
      <b>IMPORTANTE:</b> Si deseas realizar más de una búsqueda a la vez, separa las diferentes asignaturas con el simbolo "-".
  </div>
  <form class ="contenedor-Buscador" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
    <table id="buscador">
      <tr>
        <td><input type="text" name="busq" value="<?php echo isset($_GET['busq']) ? $_GET['busq'] : ''; ?>" placeholder="Introduce una asignatura o aula a buscar" /></td>
        <!-- la funcion PHP isset determina si la variable introducida no es nula, devuelve un boleano que usamos para decidir que escribir en la linea -->
        <td><input type="submit" value="Buscar" /></td>
        <td>
          <span>
            Ordenar por orden:
            <select id="orden" name="selOrden">
              <option value="alf">Alfabetico</option>
              <option value="curso">Curso</option>
              <option value="nmat">Nº de matriculados</option>
            </select>
          </span>
        </td>
      </tr>
    </table>
  </form>
  <div class="contenedor-Texto contenedor-Lista">
  <div class="lista">
  <?php
    include 'funcion_acentos.php';

    if(isset($_GET['busq'])){//se esta haciendo una busqueda
      $busq=isset($_GET['busq']) ? $_GET['busq'] : ''; //Cadena vacia si no se ha introducido algo

      if (strlen($busq)==0) {//Verificamos que se haya introducido algo a buscar
        exit;
      }

      $busq=trim($busq);
      $busq=htmlspecialchars($busq);
      $busq=remove_accents($busq);

      $palabras_clave=explode('-',$busq);
      $sql_busq="SELECT nombre,aula,lab,img_a,img_l FROM asignaturas WHERE ";//preparamos nuestra peticion

      foreach ($palabras_clave as $palabra) {
        //Asegurar que todas son minusculas
        $palabra=strtolower($palabra);
        //Hacer primer caracter mayusculas
        $palabra=ucfirst($palabra);

        $sql_busq.="nombre LIKE '%".$palabra."%' OR ";//concatenamos con las palabras clave que busquemos
      }

      $sql_busq=substr($sql_busq,0,strlen($sql_busq)-4); //Eliminados el ultimo OR de la cadena de busqueda para evitar errores

      if($_GET['selOrden']==="alf"){//queremos ordenar por orden alfabetico
        $sql_busq.=" ORDER BY nombre ASC";
        echo '<div><u>Mostrandose resultados en orden alfabetico</u></div><div>INFO</div>';
      }
      elseif($_GET['selOrden']==="curso") {//queremos ordenar por orden de curso
        $sql_busq.="ORDER BY curso ASC";
        echo '<div><u>Mostrandose resultados por cursos (mas bajos primero)</u></div><div>INFO</div>';
      }
      elseif($_GET['selOrden']==="nmat"){//queremos ordenar por numero de alumnos
        $sql_busq.="ORDER BY n_matriculados DESC";
        echo '<div><u>Mostrandose resultados por numero de matriculados (mas matriculados primero)</u></div><div>INFO</div>';
      }

      $db=mysqli_connect('localhost','root','','bd');

      if(!$db){
        echo "Error: No se pudo conectar a la base de datos.<br>";
        exit;
      }

      $resultado=mysqli_query($db,$sql_busq);

      if (mysqli_num_rows($resultado)==0) {
        echo 'No se han encontrado coincidencias en su busqueda';
      }

      for ($i=0; $i < mysqli_num_rows($resultado) ; $i++) {
        $fila=mysqli_fetch_array($resultado);//vamos cogiendo filas de nuestra busqueda

        $aulas=$fila['aula'];
        $labs=$fila['lab'];
        $URL_aulas=$fila['img_a'];
        $URL_labs=$fila['img_l'];

        $naulas=explode(' ',$aulas);
        $nURL_aulas=explode(' ',$URL_aulas);

        echo '<div><u>Resultados para <b>'.strtoupper($fila['nombre']).'</b></u></div><div>INFO</div>';

        mostrarBusqueda($aulas,$naulas,$labs,$URL_labs,$URL_aulas,$nURL_aulas);
      }

      mysqli_free_result($resultado);
      mysqli_close($db);
    }
    elseif (isset($_SESSION["user"])) {//visualizacion de asignaturas por un usuario logeado, se muestra a las que esta matriculado
      $db=mysqli_connect('localhost','root','','bd');

      if(!$db){
        echo "Error: No se pudo conectar a la base de datos.<br>";
        exit;
      }

      $email=$_SESSION["user"];

      $queryNombre="SELECT nombre FROM personas WHERE email LIKE '".$email."'";//Busco el nombre a partir del email
      $resulNombre=mysqli_query($db,$queryNombre);
      $fila=mysqli_fetch_array($resulNombre);
      echo "<div><u>Bienvenido ".$fila['nombre'].", he aqui una lista con informacion de tus asignaturas</u></div><div>INFO</div>";

      $query="SELECT codigo FROM per_asig WHERE email LIKE '".$email."'";//busco codigo asignaturas en las que esta matriculado
      $resultados=mysqli_query($db,$query);

      $queryAsig="SELECT nombre,aula,lab,img_a,img_l FROM asignaturas WHERE ";//preparo query para buscar asignaturas con el codigo

      for($i=0; $i<mysqli_num_rows($resultados); $i++){
        $fila=mysqli_fetch_array($resultados);
        $queryAsig=$queryAsig."codigo=".$fila['codigo']." OR ";//concateno para buscar
      }
      $queryAsig=substr($queryAsig,0,strlen($queryAsig)-4);
      $queryAsig=$queryAsig." ORDER BY nombre ASC";//concateno para ordenar en orden alfabetico
      $resulAsig=mysqli_query($db,$queryAsig);


      for ($i=0; $i < mysqli_num_rows($resulAsig) ; $i++) {
        $fila=mysqli_fetch_array($resulAsig);

        $aulas=$fila['aula'];
        $labs=$fila['lab'];
        $URL_aulas=$fila['img_a'];
        $URL_labs=$fila['img_l'];

        $naulas=explode(' ',$aulas);
        $nURL_aulas=explode(' ',$URL_aulas);

        echo '<div><b><u>'.strtoupper($fila['nombre']).'</u></b></div><div>INFO</div>';

        mostrarBusqueda($aulas,$naulas,$labs,$URL_labs,$URL_aulas,$nURL_aulas);
      }
      mysqli_free_result($resultados);
      mysqli_free_result($resulAsig);
      mysqli_free_result($resulNombre);
      mysqli_close($db);
    }
    else {
      //inicialmente se muestran todas las aulas y pisos de la escuela, aunque en la tabla de asignaturas solo disponemos de los planos de teleco general. De ahi la necesidad de hacer un echo directamente
      echo '<div>PLANO DE PLANTA BAJA</div>
      <div><a href="./pdfs/PLANTA_BAJA.pdf" target="_blanck">PDF</a></div>
      <div>PLANO DE LA PRIMERA PLANTA</div>
      <div><a href="./pdfs/PRIMERA_PLANTA.pdf" target="_blanck">PDF</a></div>
      <div>PLANO DE LA SEGUNDA PLANTA</div>
      <div><a href="./pdfs/SEGUNDA_PLANTA.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A001 Y A002</div>
      <div><a href="./pdfs/A001-2.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A003, A004, A005 Y A006</div>
      <div><a href="./pdfs/A003-4-5-6.pdf" target="_blanck">PDF</a></div>
      <div>AULA A007</div>
      <div><a href="./pdfs/A007.pdf" target="_blanck">PDF</a></div>
      <div>AULA A008</div>
      <div><a href="./pdfs/A008.pdf" target="_blanck">PDF</a></div>
      <div>AULA I+D</div>
      <div><a href="./pdfs/I+D.pdf" target="_blanck">PDF</a></div>
      <div>SALA DE LECTURA</div>
      <div><a href="./pdfs/SALA_LECTURA.pdf" target="_blanck">PDF</a></div>
      <div>AULA A101</div>
      <div><a href="./pdfs/A101.pdf" target="_blanck">PDF</a></div>
      <div>AULA A102</div>
      <div><a href="./pdfs/A102.pdf" target="_blanck">PDF</a></div>
      <div>AULA A102A</div>
      <div><a href="./pdfs/A102A.pdf" target="_blanck">PDF</a></div>
      <div>AULA A103</div>
      <div><a href="./pdfs/A103.pdf" target="_blanck">PDF</a></div>
      <div>AULA A104</div>
      <div><a href="./pdfs/A104.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 101</div>
      <div><a href="./pdfs/1L001.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 102</div>
      <div><a href="./pdfs/1L002.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 103</div>
      <div><a href="./pdfs/1L003.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 104</div>
      <div><a href="./pdfs/1L004.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 105</div>
      <div><a href="./pdfs/1L005.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 106</div>
      <div><a href="./pdfs/1L006.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 118</div>
      <div><a href="./pdfs/1L018.pdf" target="_blanck">PDF</a></div>
      <div>AULA HEDY LAMARR</div>
      <div><a href="./pdfs/SALA_HEDY_LAMARR.pdf" target="_blanck">PDF</a></div>
      <div>SALON DE GRADOS</div>
      <div><a href="./pdfs/SALON_DE_GRADOS.pdf" target="_blanck">PDF</a></div>
      <div>AULA A009</div>
      <div><a href="./pdfs/A009.pdf" target="_blanck">PDF</a></div>
      <div>AULA A010</div>
      <div><a href="./pdfs/A010.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A011, A012, A013 Y A014</div>
      <div><a href="./pdfs/A011-12-13-14.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A015 Y A016</div>
      <div><a href="./pdfs/A015-16.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A105, A106, A107, A109 Y A110</div>
      <div><a href="./pdfs/A105-6-7-9-10.pdf" target="_blanck">PDF</a></div>
      <div>AULA 108</div>
      <div><a href="./pdfs/A108.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO DE ELECTRONICA</div>
      <div><a href="./pdfs/LABORATORIO_DE_ELECTRONICA.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIOS 2L001, 2L002, 2L003, 2L009 Y 2L010</div>
      <div><a href="./pdfs/2L001-2-3-9-10.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIOS 2L004, 2L005, 2L006, 2L007 Y 2L008</div>
      <div><a href="./pdfs/2L004-5-6-7-8.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 013</div>
      <div><a href="./pdfs/1L013.pdf" target="_blanck">PDF</a></div>';
    }
    ?>
  </div>
  </div>

  <?php
  include 'footer.php';
  ?>

</body>
</html>
