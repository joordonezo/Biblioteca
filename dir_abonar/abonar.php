<?php
include '../scripts/librerias.php';
require_once '../scripts/db_conexion.php';
$db_conexion = new db_conexion();

if (isset($_POST['val_mul']) && $_POST['val_mul'] != "" && isset($_POST['val_abo']) && $_POST['val_abo'] != "" && isset($_POST['id_mul']) && $_POST['id_mul'] != "") {
    echo $fecha = date("Y-m-d");

    $db_conexion->actualizar("bloqueo_persona", "estado", "2", "persona_id", "=", $_POST['id_per'], TRUE);

    $db_conexion->actualizar("multa", "estado", "2", "id", "=", $_POST['id_mul'], TRUE);

    $db_conexion->actualizar("abono", "estado", 2, "multa_id", "=", $_POST['id_mul'], TRUE);

    $db_conexion->insertar("abono", "valor, estado, multa_id", $_POST['val_abo'] . ", " . 2 . "," . $_POST['id_mul']);
  
    ?>
    <div class="alert alert-warning col-xs-4 col-xs-offset-4">
        Se ha generado el abono <b>!!!exitosamente!!!</b>
    </div>
    <?php
}
?>
