<title>Biblioteca - Inicio</title>
<?php
include '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
session_start();
$db_conexion->consultar("perfil, nombres", "persona", "id", "=", $_SESSION['id'], TRUE);
while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
    $perfil = $row[0];
    $nombres = $row[1];
}

include '../scripts/librerias.php';
if (isset($perfil) && $perfil == 1) {
    include '../dir_/admin_cabeza.php';
} else if (isset($perfil) && $perfil == 2) {
    include '../dir_/estudiante_cabeza.php';
} else if (isset($perfil) && $perfil == 3) {
    include '../dir_/docente_cabeza.php';
} else if (isset($perfil) && $perfil == 4) {
    include '../dir_/acudiente_cabeza.php';
} else {
    header("Location: ../dir_errores/error_perfil.php");
    

}
?>
<iframe name="contenedor" src="" width="100%" 
height="600" frameborder="0"></iframe>  
<?php
include '../dir_/pie.php';
?>
</html>
