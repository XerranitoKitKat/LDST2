<?php
session_start();
if(isset($_SESSION["user"])){
  $user = "Perfil";//uno de los botones tiene que ir a perfil
}else{
  $user = "Inicio de Sesion / Registro";//otro lleva al inicio de sesion
}
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

  <div id="boton3">';
  if($user == "Perfil"){
    echo '<button class="botoninicio" type="button" onClick="goPerfil()" title="Perfil">
      <h2>'.$user.'</h2>
    </button>
    </div>
  </div>';
}else{
  echo '<button class="botoninicio" type="button" onClick="goSesion()" title="Inicio de sesion o registro">
    <h2>'.$user.'</h2>
  </button>
</div>
</div>';
}
?>
