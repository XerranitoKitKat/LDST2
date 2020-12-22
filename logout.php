<?php # lo hacemos para cerrar la sesion
session_start();
session_destroy();
header('Location: sesion.php');
?>
