<?php # lo hacemos para cerrar la sesion
session_start();//cogemos datos de la sesion
session_destroy();//destruimos la sesion
header('Location: sesion.php');//salimos de perfil.php
?>
