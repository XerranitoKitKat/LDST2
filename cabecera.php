<?php
echo '<script src=./scripts/navegacion.js>
</script>
<div class= "flexInicio">
<div id="cabecera" onclick="goPrincipal()" title="Vuelve a la pagina principal"><h1><i>TeleCovid</i></h1></div>
  <div id="boton1">
    <button class="botoninicio" type="button" onClick="goInfo()" title="Informacion sobre el Covid en la escuela">
      <h2>Informacion</h2>
    </button>
  </div>

  <div id="boton2">
    <button class="botoninicio" type="button" onClick="goMapas()" title="Mapas de la escuela">
      <h2>Mapas</h2>
    </button>
  </div>

  <div id="boton3">
    <button class="botoninicio" type="button" onClick="goSesion()" title="Inicio de sesion o registro">
      <h2>Inicio de sesion</h2>
    </button>
  </div>
</div>';
?>
