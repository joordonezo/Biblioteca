<?php
include '../scripts/librerias.php';
include '../scripts/db_conexion.php';
    $db_conexion = new db_conexion();
if (isset($_POST['id']) && $_POST['id'] != "") {
    $id = $_POST['id'];
    session_start();
    $db_conexion->insertar("bloqueo_persona", "fecha_inicio, estado, observacion, persona_id, persona_id1", "'" . date("Y-m-d") . "', " . 1 . ",'" . $_POST['observaciontext'] . "', " . $id . ", " . $_SESSION['id']);
    ?>
<div class="col-xs-4 col-xs-offset-4">
<div class="alert alert-warning"><b>Se ha bloqueado el usuario correctamente</b></div>

</div>
<?php
    
}else if (isset($_POST['id_l']) && $_POST['id_l'] != "") {
   $id = $_POST['id_l'];
    session_start();
    $db_conexion->insertar("bloqueo_libro", "fecha_inicio, estado, observacion, libro_id, persona_id", "'" . date("Y-m-d") . "', " . 1 . ",'" . $_POST['observaciontext'] . "', " . $id . ", " . $_SESSION['id']);
    ?>
<div class="col-xs-4 col-xs-offset-4">
<div class="alert alert-warning"><b>Se ha bloqueado el libro correctamente</b></div>

</div>
<?php 
}
?>