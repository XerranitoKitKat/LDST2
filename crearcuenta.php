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
      margin: 30px 30%;
      border: 2px outset black;
      min-width:200px;
  }
  h2{
    text-align: center;
  }
  .contenedor{
  display: none;
  }

  .elem {
    margin-left: 20px;
    margin-top: 3px;
    margin-bottom:3px;
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
  input.invalid {
  background-color: #FFC989;
 }

  </style>
</head>

<script src="./scripts/pasarPaginaCuenta.js"></script>

<body onload="mostrarTab(0)">
  <?php
  include 'cabecera.php';
  ?>

<form id="formulario">
<h2>Introduzca los datos</h2>
<div class="contenedor">
    <div class="elem">
    <label for="user">Usuario</label><br>
    <input type="text" id="user" name="user"><br>
    </div>
    <div class="elem">
    <label for="passwd">Contrase&ntildea:</label><br>
    <input type="password" id="passwd" name="passwd"><br>
    </div>
    <div class="elem">
    <label for="reppasswd">Repetir Contrase&ntildea:</label><br>
    <input type="password" id="reppasswd" name="reppasswd"><br>
    </div>
    <div class="elem">
    <label for="nombre">Nombre </label><br>
    <input type="text" id="nombre" name="nombre"><br>
    </div>
    <div class="elem">
    <label for="apell">Apellidos </label><br>
    <input type="text" id="apell" name="apell"><br>
    </div>
    <div class="elem">
    <label for="genero">Genero:</label>
    <select id="genero" name="genero">
        <option value="hombre" selected>Hombre</option>
        <option value="mujer">Mujer</option>
        <option value="nobinario">No binario </option>
    </select><br>
    </div>
    <div class="elem">
    <label for="fnacimiento">Fecha de nacimiento</label><br>
    <input type="date" id="fnacimiento" name="fnacimiento">
    </div>
    <div class="elem">
    <label for="telefono">Numero de telefono</label><br>
    <input type="text" id="telefono" name="telefono"><br>
    </div>
</div>
<div class="contenedor">
  <div class="elem">
  <label for="correouva">Correo de la UVA</label><br>
  <input type="text" id="correouva" name="correouva"><br>
  </div>
    <div class="elem">
    <label for="grado">Grado</label><br>
    <input type="text" id="grado" name="grado"><br>
  </div>
    <div class="elem">
    <label for="curso">Curso:</label>
    <select id="curso" name="curso">
        <option value="primero" selected>1º</option>
        <option value="segundo">2º</option>
        <option value="tercero">3º</option>
        <option value="cuarto">4º</option>
        <option value="quinto">5º</option>
    </select>
    </div>
    <div class="elem">
    <label for="metodo">Metodo de docencia</label>
    <select id="metodo" name="metodo">
        <option value="presencial" selected>Presencial</option>
        <option value="nopresencial">No presencial</option>
        <option value="mixta">Mixta</option>
    </select>
    </div>
    <div class="elem">
    <label for="horario">Horario</label>
    <select id="horario" name="horario">
        <option value="manana" selected>Ma&ntildeana</option>
        <option value="tarde">Tarde</option>
        <option value="ambos">Ambos</option>
    </select><br>
    </div>
    <div class="elem">
    <label for="aulas">Aulas atendidas*</label><br>
    <input type="aulas" id="aulas" name="aulas"><br>
  </div><br>
      <div class="elem" style="color:red;">*Poner un 0 en caso de no presencial</div><br>
    <div class="elem">
    <label><input type="checkbox" name="terms" checked="true">He leído y acepto los <u>términos y condiciones de uso</u></label><br>
  </div><br>
</div><br>
<div>
  <div id="botonpeq" style="float:right;">
    <button type="button" id="prevBtn" onclick="siguienteAnterior(-1)" style="font-family:sans-serif;font-size:14px;">Anterior</button>
    <button type="button" id="nextBtn" onclick="siguienteAnterior(1)" style="font-family:sans-serif;font-size:14px;">Siguiente</button>
  </div>
</body>
</html>
