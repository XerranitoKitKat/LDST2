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
      height: 200px;
      overflow: auto; /*Similar a scrollbar pero solo muestra las barras necesariias*/
      border: 2px outset black;
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

  <div class="contenedor-Texto contenedor-Lista"> <!--Puede que haya una manera de hacer esto con javascript pero como esto no va a cambiar y el tiempo es limitado lo hago a pelo*/-->
    <div class="lista">
      <div>PLANO DE PLANTA BAJA</div>
      <div><a href="./pdfs/telecoinformatica-1.pdf" target="_blanck">PDF</a></div>
      <div>PLANO DE LA PRIMERA PLANTA</div>
      <div><a href="./pdfs/telecoinformatica-2.pdf" target="_blanck">PDF</a></div>
      <div>PLANO DE LA SEGUNDA PLANTA</div>
      <div><a href="./pdfs/telecoinformatica-3.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A001 Y A002</div>
      <div><a href="./pdfs/telecoinformatica-4.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A003, A004, A005 Y A006</div>
      <div><a href="./pdfs/telecoinformatica-5.pdf" target="_blanck">PDF</a></div>
      <div>AULA A007</div>
      <div><a href="./pdfs/telecoinformatica-6.pdf" target="_blanck">PDF</a></div>
      <div>AULA A008</div>
      <div><a href="./pdfs/telecoinformatica-7.pdf" target="_blanck">PDF</a></div>
      <div>AULA I+D</div>
      <div><a href="./pdfs/telecoinformatica-8.pdf" target="_blanck">PDF</a></div>
      <div>SALA DE LECTURA</div>
      <div><a href="./pdfs/telecoinformatica-9.pdf" target="_blanck">PDF</a></div>
      <div>AULA A101</div>
      <div><a href="./pdfs/telecoinformatica-10.pdf" target="_blanck">PDF</a></div>
      <div>AULA A102</div>
      <div><a href="./pdfs/telecoinformatica-11.pdf" target="_blanck">PDF</a></div>
      <div>AULA A102A</div>
      <div><a href="./pdfs/telecoinformatica-12.pdf" target="_blanck">PDF</a></div>
      <div>AULA A103</div>
      <div><a href="./pdfs/telecoinformatica-13.pdf" target="_blanck">PDF</a></div>
      <div>AULA A104</div>
      <div><a href="./pdfs/telecoinformatica-14.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 101</div>
      <div><a href="./pdfs/telecoinformatica-15.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 102</div>
      <div><a href="./pdfs/telecoinformatica-16.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 103</div>
      <div><a href="./pdfs/telecoinformatica-17.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 104</div>
      <div><a href="./pdfs/telecoinformatica-18.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 105</div>
      <div><a href="./pdfs/telecoinformatica-19.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 106</div>
      <div><a href="./pdfs/telecoinformatica-20.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 118</div>
      <div><a href="./pdfs/telecoinformatica-21.pdf" target="_blanck">PDF</a></div>
      <div>AULA HEDY LAMARR</div>
      <div><a href="./pdfs/telecoinformatica-22.pdf" target="_blanck">PDF</a></div>
      <div>SALA DE GRADOS</div>
      <div><a href="./pdfs/telecoinformatica-23.pdf" target="_blanck">PDF</a></div>
      <div>AULA A009</div>
      <div><a href="./pdfs/telecoinformatica-24.pdf" target="_blanck">PDF</a></div>
      <div>AULA A010</div>
      <div><a href="./pdfs/telecoinformatica-25.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A011, A012, A013 Y A014</div>
      <div><a href="./pdfs/telecoinformatica-26.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A015 Y A016</div>
      <div><a href="./pdfs/telecoinformatica-27.pdf" target="_blanck">PDF</a></div>
      <div>AULAS A105, A106, A107, A109 Y A110</div>
      <div><a href="./pdfs/telecoinformatica-28.pdf" target="_blanck">PDF</a></div>
      <div>AULA 108</div>
      <div><a href="./pdfs/telecoinformatica-29.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO DE ELECTRONICA</div>
      <div><a href="./pdfs/telecoinformatica-30.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIOS 1L019, 1L020, 2L001, 2L002, 2L003, 2L009 Y 2L010</div>
      <div><a href="./pdfs/telecoinformatica-31.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIOS 1L023, 2L004, 2L005, 2L006, 2L007 Y 2L008</div>
      <div><a href="./pdfs/telecoinformatica-32.pdf" target="_blanck">PDF</a></div>
      <div>LABORATORIO 013</div>
      <div><a href="./pdfs/telecoinformatica-33.pdf" target="_blanck">PDF</a></div>
    </div>
  </div>

  <?php
  include 'footer.php';
  ?>

</body>
</html>
