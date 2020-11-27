<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name = "author" content="María Martínez Ordás, Rubén Serrano Rodríguez, Marco Villa Aparicio">
  <meta name = "organization" content="Escuela Técnica Superior de Ingenieros de Telecomunicación, Universidad de Valladolid">
  <title>TeleCovid</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <style>
  img {
    width: 60%;
  }
  #centro {
        font-size: 40px;
        text-align: center;
        margin-top: 10px;
        margin-bottom:40px;
  }

  .contenedorflex{
    display: flex;
    flex-flow: row;
    margin: auto;
    width: 99%;
    min-height: 500px;
  }

  .contenedorflex > div{
    margin: 2px;
    height: 500px;
    width: 100%;
    text-align: center;
  }
  .contenedorflex >div >img{
    border: 3px solid black;
    height: inherit;
    width: inherit;
  }
  .contenedorflex >div > iframe{
    border: 3px solid black;
    height: inherit;
    width: inherit;
  }
  .contenedorflex > #contenedorImagen{
    flex: 2 1 40%;;
  }

  .contenedorflex > #contenedorFrame{
    flex: 1 1 60%;
  }

  .contenedorgrid {
    display:grid;
    grid-template-columns: auto auto auto;
    margin-bottom: 50px;
    margin: 2px
  }
  .elemgrid {
    font-family: Verdana;
    background-color:rgb(240, 240, 240);
    padding: 20px;
    border:2px solid black;
    font-size: 20px;
    text-align: center;
    pointer-events: none; /*formazos que no se vea afectado al poner el cursor encima del elemento*/
  }
  .elemgrid > a {
    text-decoration: none;
    color:black;
    pointer-events: auto; /*dejamos que el hijo dentro se vea afectado*/
  }

  .elemgrid:hover{
    background: lightgrey; /*cuando el hijo se ve afectado, tambíen lo hace el padre*/
  }

  @media all and (max-width:640px){
    .contenedorgrid{
      grid-template-columns: 100%; /*forzamos a que se vea todo como una columna*/
    }

    .contenedorflex{
      flex-flow: column;
    }
  }
</style>

</head>
<script src="./scripts/mostrarEnlacesAJAX.js"></script>
<body>
    <?php
    include 'cabecera.php';
    ?>
    <div class="contenedorflex">
      <div id="contenedorImagen">
        <img src="./images/facultad.jpg" alt="Edificio ETSIT">
      </div>
      <div id="contenedorFrame">
        <iframe src="https://www.mscbs.gob.es" title="Pagina Web oficial de Ministerio de Sanidad, Consumo y Bienestar Social"></iframe>
      </div>
    </div>

    <div id="centro"><strong>Bienvenido, en esta pagina podrás encontrar medidas con el COVID-19 para el curso 2020-2021 en la Universidad de Valladolid.</strong></div>

    <div class="contenedorgrid">
      <script defer>
        loadEnlacesXML();
      </script>
    </div>

    <footer>
      <p><i>Autores: Marco Antonio Villa, María Martinez y Rubén Serrano<br/></br>
        Gran parte de los recursos utilizados (enlaces, imágenes, etc) en está página se han obtenido de diversos portales y/o páginas web de la UVA.
      </i></p>
    </footer>
</body>
</html>
