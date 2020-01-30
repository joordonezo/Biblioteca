<title>BRM - Error de session</title>
<?php
include '../scripts/librerias.php';
include '../scripts/db_conexion.php';
$db_conexion = new db_conexion();
session_start();
$db_conexion->consultar("nombres, apellidos", "persona", "id", "=", $_SESSION['id'], TRUE);
while ($row = mysqli_fetch_array($GLOBALS['consultar'])) {
    
    $nombres = $row[0];
}
?>
<div class = "jumbotron jumbotron-warning col-xs-4 col-xs-offset-4" >
    <p>El usuario <strong><?php echo $nombres.''; ?></strong>Tiene una sesion iniciada</p>

    <h1 id="main-logo"><p><a class="btn btn-primary btn-lg has btn-danger has col-xs-4 col-xs-offset-4" href="../index.php"><strong>OK</strong> <span >Volver</span></a></p></h1>
</div>
<?php
session_destroy();
